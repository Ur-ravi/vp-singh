<?php

namespace App\Controllers\Admin;

use App\Models\PaymentModel;
use App\Models\PaymentMethodModel;
use App\Models\ConsultationModel;
use App\Libraries\Settings;
use App\Libraries\MailService;

class Payments extends BaseController
{
    protected $paymentModel;
    protected $methodModel;

    public function __construct()
    {
        parent::__construct();
        $this->paymentModel = new PaymentModel();
        $this->methodModel = new PaymentMethodModel();
    }

    public function index()
    {
        $filters = [
            'status' => $this->request->getGet('status'),
            'search' => $this->request->getGet('search'),
        ];
        $result = $this->paymentModel->getPaginated(20, $filters);

        $extraData = [
            'page_title' => 'Payments',
            'payments' => $result['data'],
            'total' => $result['total'],
            'pager' => $result['pager'],
            'filters' => $filters,
        ];
        return $this->adminView('payments/index', $extraData);
    }

    public function view(int $id)
    {
        $payment = $this->paymentModel->find($id);
        if (!$payment) {
            return redirect()->to('/admin/payments')->with('error', 'Payment not found.');
        }

        $consultationModel = new \App\Models\ConsultationModel();
        $extraData = [
            'page_title' => 'Payment #' . $id,
            'payment' => $payment,
            'consultation' => $consultationModel->find($payment->consultation_id),
        ];
        return $this->adminView('payments/view', $extraData);
    }

    public function update(int $id)
    {
        $oldPayment = $this->paymentModel->find($id);
        $oldStatus = $oldPayment->status ?? '';

        $data = [
            'status' => $this->request->getPost('status'),
            'admin_notes' => $this->request->getPost('admin_notes'),
        ];

        if ($this->request->getPost('status') === 'verified') {
            $data['verified_at'] = date('Y-m-d H:i:s');
        }

        if ($this->paymentModel->update($id, $data)) {
            $payment = $this->paymentModel->find($id);
            $consultationModel = new ConsultationModel();

            if ($payment) {
                $consultationModel->update($payment->consultation_id, [
                    'payment_status' => $data['status'],
                ]);

                // Send client payment receipt when status changes to verified
                if ($data['status'] !== $oldStatus && $data['status'] === 'verified') {
                    $consultation = $consultationModel->find($payment->consultation_id);
                    if ($consultation) {
                        try {
                            MailService::sendClientPaymentReceipt($consultation, $payment);
                        } catch (\Throwable $e) {
                            log_message('error', 'Client payment receipt email failed: ' . $e->getMessage());
                        }
                    }
                }
            }

            return redirect()->back()->with('success', 'Payment updated.');
        }
        return redirect()->back()->with('error', 'Failed to update.');
    }

    public function settings()
    {
        $extraData = [
            'page_title' => 'Payment Settings',
        ];
        return $this->adminView('payments/settings', $extraData);
    }

    public function saveSettings()
    {
        $model = new \App\Models\SettingModel();
        $model->setSetting('consultation_fee', $this->request->getPost('consultation_fee'));
        Settings::clear();
        return redirect()->back()->with('success', 'Payment settings saved.');
    }

    public function saveRazorpay()
    {
        $model = new \App\Models\SettingModel();
        $model->setSetting('razorpay_enabled', $this->request->getPost('razorpay_enabled') ? '1' : '0', 'payments');
        $model->setSetting('razorpay_key_id', $this->request->getPost('razorpay_key_id'), 'payments');
        $model->setSetting('razorpay_key_secret', $this->request->getPost('razorpay_key_secret'), 'payments');
        $model->setSetting('razorpay_button_label', $this->request->getPost('razorpay_button_label') ?: 'Pay Online Now', 'payments');
        Settings::clear();
        return redirect()->back()->with('success', 'Razorpay settings saved.');
    }

    public function qr()
    {
        $extraData = [
            'page_title' => 'QR Code Settings',
            'qr_methods' => $this->methodModel->where('method_type', 'qr')->orderBy('sort_order', 'ASC')->findAll(),
        ];
        return $this->adminView('payments/qr', $extraData);
    }

    public function storeQR()
    {
        $data = [
            'method_type' => 'qr',
            'label' => $this->request->getPost('label'),
            'upi_id' => $this->request->getPost('upi_id'),
            'instructions' => $this->request->getPost('instructions'),
            'is_enabled' => $this->request->getPost('is_enabled') ? 1 : 0,
            'sort_order' => $this->request->getPost('sort_order') ?: 0,
        ];

        $file = $this->request->getFile('qr_image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $uploadDir = ROOTPATH . 'public/uploads/qr';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $newName = 'qr_' . time() . '.' . $file->getExtension();
            $file->move($uploadDir, $newName, true);
            $data['qr_image'] = 'uploads/qr/' . $newName;
        }

        $this->methodModel->insert($data);
        return redirect()->to('/admin/payments/qr')->with('success', 'QR method added.');
    }

    public function updateQR(int $id)
    {
        $data = [
            'label' => $this->request->getPost('label'),
            'upi_id' => $this->request->getPost('upi_id'),
            'instructions' => $this->request->getPost('instructions'),
            'is_enabled' => $this->request->getPost('is_enabled') ? 1 : 0,
            'sort_order' => $this->request->getPost('sort_order') ?: 0,
        ];

        $file = $this->request->getFile('qr_image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $uploadDir = ROOTPATH . 'public/uploads/qr';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $newName = 'qr_' . time() . '.' . $file->getExtension();
            $file->move($uploadDir, $newName, true);
            $data['qr_image'] = 'uploads/qr/' . $newName;
        }

        $this->methodModel->update($id, $data);
        return redirect()->to('/admin/payments/qr')->with('success', 'QR method updated.');
    }

    public function deleteQR(int $id)
    {
        $this->methodModel->delete($id);
        return redirect()->to('/admin/payments/qr')->with('success', 'QR method deleted.');
    }

    public function bank()
    {
        $extraData = [
            'page_title' => 'Bank Details',
            'bank_methods' => $this->methodModel->where('method_type', 'bank')->orderBy('sort_order', 'ASC')->findAll(),
        ];
        return $this->adminView('payments/bank', $extraData);
    }

    public function storeBank()
    {
        $data = [
            'method_type' => 'bank',
            'label' => $this->request->getPost('label'),
            'account_holder' => $this->request->getPost('account_holder'),
            'bank_name' => $this->request->getPost('bank_name'),
            'account_number' => $this->request->getPost('account_number'),
            'ifsc' => $this->request->getPost('ifsc'),
            'branch' => $this->request->getPost('branch'),
            'account_type' => $this->request->getPost('account_type'),
            'instructions' => $this->request->getPost('instructions'),
            'is_enabled' => $this->request->getPost('is_enabled') ? 1 : 0,
            'sort_order' => $this->request->getPost('sort_order') ?: 0,
        ];

        $this->methodModel->insert($data);
        return redirect()->to('/admin/payments/bank')->with('success', 'Bank details added.');
    }

    public function updateBank(int $id)
    {
        $data = [
            'label' => $this->request->getPost('label'),
            'account_holder' => $this->request->getPost('account_holder'),
            'bank_name' => $this->request->getPost('bank_name'),
            'account_number' => $this->request->getPost('account_number'),
            'ifsc' => $this->request->getPost('ifsc'),
            'branch' => $this->request->getPost('branch'),
            'account_type' => $this->request->getPost('account_type'),
            'instructions' => $this->request->getPost('instructions'),
            'is_enabled' => $this->request->getPost('is_enabled') ? 1 : 0,
            'sort_order' => $this->request->getPost('sort_order') ?: 0,
        ];

        $this->methodModel->update($id, $data);
        return redirect()->to('/admin/payments/bank')->with('success', 'Bank details updated.');
    }

    public function deleteBank(int $id)
    {
        $this->methodModel->delete($id);
        return redirect()->to('/admin/payments/bank')->with('success', 'Bank details deleted.');
    }
}
