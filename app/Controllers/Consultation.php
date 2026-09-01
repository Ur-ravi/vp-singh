<?php

namespace App\Controllers;

use App\Models\ConsultationModel;
use App\Models\PaymentMethodModel;
use App\Models\PaymentModel;
use App\Libraries\Settings;
use App\Libraries\MailService;

class Consultation extends BaseController
{
    public function index()
    {
        $extraData = [
            'page_title' => 'Online Legal Consultation | V P Singh Advocate',
            'meta_description' => 'Book an online or offline legal consultation with V P Singh Advocate in Lakhimpur Kheri.',
        ];
        return $this->frontendView('consultation/index', $extraData);
    }

    public function book()
    {
        $extraData = [
            'page_title' => 'Book Consultation | V P Singh Advocate',
            'consultation_fee' => Settings::get('consultation_fee', '2100'),
        ];
        return $this->frontendView('consultation/book', $extraData);
    }

    public function store()
    {
        $rules = [
            'full_name' => 'required|max_length[255]',
            'mobile' => 'required|max_length[20]',
            'email' => 'permit_empty|valid_email',
            'city' => 'permit_empty|max_length[100]',
            'legal_matter' => 'permit_empty|max_length[255]',
            'consultation_mode' => 'required|in_list[online,offline]',
            'preferred_date' => 'permit_empty',
            'preferred_time' => 'permit_empty|max_length[20]',
            'description' => 'permit_empty',
            'agree_terms' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Please fill in all required fields and agree to the Terms & Conditions.');
        }

        $model = new ConsultationModel();

        // Prevent duplicate submissions within 5 minutes
        $recentBooking = $model->where('mobile', $this->request->getPost('mobile'))
            ->where('created_at >=', date('Y-m-d H:i:s', strtotime('-5 minutes')))
            ->first();

        if ($recentBooking) {
            return redirect()->to('/payment/' . $recentBooking->booking_id)
                ->with('success', 'You already have a recent booking. Redirecting to payment.');
        }

        $bookingId = $model->generateBookingId();
        $fee = Settings::get('consultation_fee', '2100');

        $data = [
            'booking_id' => $bookingId,
            'full_name' => $this->request->getPost('full_name'),
            'mobile' => $this->request->getPost('mobile'),
            'email' => $this->request->getPost('email'),
            'city' => $this->request->getPost('city'),
            'legal_matter' => $this->request->getPost('legal_matter'),
            'consultation_mode' => $this->request->getPost('consultation_mode'),
            'preferred_date' => $this->request->getPost('preferred_date') ?: null,
            'preferred_time' => $this->request->getPost('preferred_time'),
            'description' => $this->request->getPost('description'),
            'amount' => $fee,
            'ip_address' => $this->request->getIPAddress(),
        ];

        if ($model->insert($data)) {
            $newBooking = $model->where('booking_id', $bookingId)->first();
            if ($newBooking) {
                // Notify admin (fire-and-forget)
                try { MailService::notifyAdminNewBooking($newBooking); } catch (\Throwable $e) {
                    log_message('error', 'Admin booking email failed: ' . $e->getMessage());
                }
                // Send client confirmation email (fire-and-forget)
                try { MailService::sendClientBookingConfirmation($newBooking); } catch (\Throwable $e) {
                    log_message('error', 'Client booking email failed: ' . $e->getMessage());
                }
            }

            return redirect()->to('/payment/' . $bookingId)->with('success', 'Consultation booked! Please proceed to payment.');
        }

        return redirect()->back()->withInput()->with('error', 'Failed to book consultation. Please try again.');
    }

    public function payment(string $bookingId)
    {
        $model = new ConsultationModel();
        $consultation = $model->where('booking_id', $bookingId)->first();

        if (!$consultation) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Booking not found');
        }

        $paymentMethodModel = new PaymentMethodModel();

        $extraData = [
            'page_title' => 'Payment | V P Singh Advocate',
            'consultation' => $consultation,
            'qr_methods' => $paymentMethodModel->getEnabledQR(),
            'bank_methods' => $paymentMethodModel->getEnabledBank(),
        ];
        return $this->frontendView('consultation/payment', $extraData);
    }

    public function confirmPayment()
    {
        $rules = [
            'booking_id' => 'required',
            'client_name' => 'required',
            'mobile' => 'required',
            'utr_number' => 'permit_empty',
            'payment_method' => 'required|in_list[upi,bank_transfer]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Please fill in all required fields.');
        }

        $consultationModel = new ConsultationModel();
        $paymentModel = new PaymentModel();

        $consultation = $consultationModel->where('booking_id', $this->request->getPost('booking_id'))->first();

        if (!$consultation) {
            return redirect()->back()->with('error', 'Booking not found.');
        }

        // Handle screenshot upload
        $screenshot = null;
        $file = $this->request->getFile('screenshot');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $uploadDir = ROOTPATH . 'public/uploads/images';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $newName = 'payment_' . time() . '_' . bin2hex(random_bytes(8)) . '.' . $file->getExtension();
            if ($file->move($uploadDir, $newName, true)) {
                $screenshot = 'uploads/images/' . $newName;
            }
        }

        $paymentData = [
            'consultation_id' => $consultation->id,
            'client_name' => $this->request->getPost('client_name'),
            'mobile' => $this->request->getPost('mobile'),
            'amount' => $consultation->amount,
            'payment_method' => $this->request->getPost('payment_method'),
            'utr_number' => $this->request->getPost('utr_number'),
            'screenshot' => $screenshot,
            'status' => 'submitted',
        ];

        if ($paymentModel->insert($paymentData)) {
            $consultationModel->update($consultation->id, ['payment_status' => 'submitted']);

            $newPayment = $paymentModel->orderBy('id', 'DESC')->first();
            if ($newPayment) {
                // Notify admin about payment (fire-and-forget)
                try { MailService::notifyAdminPaymentReceived($consultation, $newPayment); } catch (\Throwable $e) {
                    log_message('error', 'Admin payment email failed: ' . $e->getMessage());
                }
                // Send client payment receipt (fire-and-forget)
                try { MailService::sendClientPaymentReceipt($consultation, $newPayment); } catch (\Throwable $e) {
                    log_message('error', 'Client payment receipt email failed: ' . $e->getMessage());
                }
            }

            return redirect()->to('/payment/' . $consultation->booking_id)
                ->with('success', 'Payment confirmation submitted. We will verify your payment shortly.');
        }

        return redirect()->back()->with('error', 'Failed to submit payment confirmation.');
    }
}
