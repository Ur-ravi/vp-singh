<?php

namespace App\Controllers;

use App\Models\FaqModel;
use App\Models\ConsultationModel;
use App\Models\PaymentModel;
use App\Libraries\Settings;
use App\Libraries\MailService;

class Api extends BaseController
{
    public function getFaqs(string $type, int $id)
    {
        $model = new FaqModel();
        $faqs = $model->getForEntity($type, $id);
        return $this->response->setJSON($faqs);
    }

    public function getGlobalFaqs()
    {
        $model = new FaqModel();
        $faqs = $model->getGlobal();
        return $this->response->setJSON($faqs);
    }

    // ============================================================
    // Razorpay Integration
    // ============================================================

    /**
     * Create a Razorpay order via API.
     * POST /api/razorpay/create-order
     * Body: { booking_id: string }
     */
    public function createRazorpayOrder()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['error' => 'Invalid request']);
        }

        $bookingId = $this->request->getPost('booking_id');
        if (empty($bookingId)) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Booking ID is required']);
        }

        $consultationModel = new ConsultationModel();
        $consultation = $consultationModel->where('booking_id', $bookingId)->first();

        if (!$consultation) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Booking not found']);
        }

        if ($consultation->payment_status !== 'awaiting') {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Payment already submitted for this booking']);
        }

        $keyId     = Settings::get('razorpay_key_id', '');
        $keySecret = Settings::get('razorpay_key_secret', '');

        if (empty($keyId) || empty($keySecret)) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Razorpay is not configured. Please contact admin.']);
        }

        // Create order via Razorpay API
        $amount = (int) round((float) $consultation->amount * 100); // Razorpay uses paise
        $receipt = 'VP-' . $consultation->id . '-' . time();

        $ch = curl_init('https://api.razorpay.com/v1/orders');
        curl_setopt_array($ch, [
            CURLOPT_USERPWD        => $keyId . ':' . $keySecret,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => json_encode([
                'amount'   => $amount,
                'currency' => 'INR',
                'receipt'  => $receipt,
                'notes'    => [
                    'booking_id' => $bookingId,
                    'client_name' => $consultation->full_name,
                    'mobile' => $consultation->mobile,
                ],
            ]),
            CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
            CURLOPT_TIMEOUT        => 30,
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 200 || empty($response)) {
            log_message('error', 'Razorpay order creation failed: ' . ($response ?: 'No response'));
            return $this->response->setStatusCode(500)->setJSON(['error' => 'Failed to create Razorpay order. Please try again.']);
        }

        $order = json_decode($response, true);

        if (empty($order['id'])) {
            return $this->response->setStatusCode(500)->setJSON(['error' => 'Invalid response from Razorpay']);
        }

        return $this->response->setJSON([
            'order_id' => $order['id'],
            'amount'   => $amount,
            'currency' => 'INR',
            'key_id'   => $keyId,
            'name'     => Settings::get('site_name', 'V P Singh Advocate'),
            'description' => 'Consultation Fee - ' . $bookingId,
            'prefill'  => [
                'name'    => $consultation->full_name,
                'contact' => $consultation->mobile,
                'email'   => $consultation->email ?? '',
            ],
        ]);
    }

    /**
     * Verify Razorpay payment and record it.
     * POST /api/razorpay/verify
     * Body: { razorpay_order_id, razorpay_payment_id, razorpay_signature, booking_id, client_name, mobile, payment_method, utr_number }
     */
    public function verifyRazorpayPayment()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['error' => 'Invalid request']);
        }

        $razorpayOrderId   = $this->request->getPost('razorpay_order_id');
        $razorpayPaymentId = $this->request->getPost('razorpay_payment_id');
        $razorpaySignature = $this->request->getPost('razorpay_signature');
        $bookingId         = $this->request->getPost('booking_id');
        $clientName        = $this->request->getPost('client_name');
        $mobile            = $this->request->getPost('mobile');

        if (empty($razorpayOrderId) || empty($razorpayPaymentId) || empty($razorpaySignature) || empty($bookingId)) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Missing payment verification data']);
        }

        $keySecret = Settings::get('razorpay_key_secret', '');
        if (empty($keySecret)) {
            return $this->response->setStatusCode(500)->setJSON(['error' => 'Razorpay not configured']);
        }

        // Verify signature
        $expectedSignature = hash_hmac('sha256', $razorpayOrderId . '|' . $razorpayPaymentId, $keySecret);

        if (!hash_equals($expectedSignature, $razorpaySignature)) {
            log_message('warning', 'Razorpay signature mismatch for booking: ' . $bookingId);
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Payment verification failed. Invalid signature.']);
        }

        // Signature is valid — record payment
        $consultationModel = new ConsultationModel();
        $paymentModel      = new PaymentModel();

        $consultation = $consultationModel->where('booking_id', $bookingId)->first();
        if (!$consultation) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Booking not found']);
        }

        $paymentData = [
            'consultation_id' => $consultation->id,
            'client_name'     => $clientName ?: $consultation->full_name,
            'mobile'          => $mobile ?: $consultation->mobile,
            'amount'          => $consultation->amount,
            'payment_method'  => 'upi', // Razorpay online
            'utr_number'      => $razorpayPaymentId,
            'screenshot'      => null,
            'status'          => 'verified',
            'admin_notes'     => 'Razorpay Order: ' . $razorpayOrderId . ' | Payment ID: ' . $razorpayPaymentId,
        ];

        if ($paymentModel->insert($paymentData)) {
            $consultationModel->update($consultation->id, ['payment_status' => 'verified']);

            $newPayment = $paymentModel->orderBy('id', 'DESC')->first();

            // Notify admin about verified payment (fire-and-forget)
            try {
                MailService::notifyAdminPaymentReceived($consultation, $newPayment);
            } catch (\Throwable $e) {
                log_message('error', 'Razorpay admin email failed: ' . $e->getMessage());
            }

            // Send client payment receipt (fire-and-forget)
            try {
                MailService::sendClientPaymentReceipt($consultation, $newPayment);
            } catch (\Throwable $e) {
                log_message('error', 'Razorpay client receipt email failed: ' . $e->getMessage());
            }

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Payment verified successfully!',
                'redirect' => '/payment/' . $bookingId . '?paid=1',
            ]);
        }

        return $this->response->setStatusCode(500)->setJSON(['error' => 'Failed to record payment. Please contact admin.']);
    }
}
