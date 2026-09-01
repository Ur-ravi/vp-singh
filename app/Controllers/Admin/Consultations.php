<?php

namespace App\Controllers\Admin;

use App\Models\ConsultationModel;
use App\Libraries\MailService;

class Consultations extends BaseController
{
    protected $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new ConsultationModel();
    }

    public function index()
    {
        $filters = [
            'status' => $this->request->getGet('status'),
            'payment_status' => $this->request->getGet('payment_status'),
            'search' => $this->request->getGet('search'),
        ];

        $result = $this->model->getPaginated(20, $filters);

        $extraData = [
            'page_title' => 'Consultations',
            'consultations' => $result['data'],
            'total' => $result['total'],
            'pager' => $result['pager'],
            'filters' => $filters,
        ];
        return $this->adminView('consultations/index', $extraData);
    }

    public function view(int $id)
    {
        $consultation = $this->model->find($id);
        if (!$consultation) {
            return redirect()->to('/admin/consultations')->with('error', 'Consultation not found.');
        }

        $paymentModel = new \App\Models\PaymentModel();
        $extraData = [
            'page_title' => 'Consultation: ' . $consultation->booking_id,
            'consultation' => $consultation,
            'payment' => $paymentModel->getByConsultation($id),
        ];
        return $this->adminView('consultations/view', $extraData);
    }

    public function update(int $id)
    {
        $consultation = $this->model->find($id);
        if (!$consultation) {
            return redirect()->back()->with('error', 'Consultation not found.');
        }

        $oldBookingStatus = $consultation->booking_status;
        $oldPaymentStatus = $consultation->payment_status;

        $data = [
            'booking_status' => $this->request->getPost('booking_status'),
            'payment_status' => $this->request->getPost('payment_status'),
            'notes' => $this->request->getPost('notes'),
        ];

        if ($this->model->update($id, $data)) {
            $newConsultation = $this->model->find($id);

            // Send client notification if booking status changed
            if ($newConsultation && $data['booking_status'] !== $oldBookingStatus) {
                try {
                    MailService::sendClientBookingStatusUpdate($newConsultation, $oldBookingStatus, $data['booking_status']);
                } catch (\Throwable $e) {
                    log_message('error', 'Client status update email failed: ' . $e->getMessage());
                }
            }

            // Send client notification if payment status changed to verified
            if ($newConsultation && $data['payment_status'] !== $oldPaymentStatus && $data['payment_status'] === 'verified') {
                $paymentModel = new \App\Models\PaymentModel();
                $payment = $paymentModel->getByConsultation($id);
                if ($payment) {
                    try {
                        MailService::sendClientPaymentReceipt($newConsultation, $payment);
                    } catch (\Throwable $e) {
                        log_message('error', 'Client payment receipt email failed: ' . $e->getMessage());
                    }
                }
            }

            return redirect()->back()->with('success', 'Consultation updated.');
        }
        return redirect()->back()->with('error', 'Failed to update.');
    }
}
