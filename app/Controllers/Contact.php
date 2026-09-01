<?php

namespace App\Controllers;

use App\Models\EnquiryModel;
use App\Models\LocationModel;
use App\Libraries\Settings;
use App\Libraries\MailService;

class Contact extends BaseController
{
    public function index()
    {
        $locationModel = new LocationModel();

        $extraData = [
            'page_title' => 'Contact | V P Singh Advocate',
            'meta_description' => 'Contact V P Singh Advocate for legal consultation in Lakhimpur Kheri, Uttar Pradesh.',
            'locations' => $locationModel->getActive(),
        ];
        return $this->frontendView('contact/index', $extraData);
    }

    public function submit()
    {
        $rules = [
            'name' => 'required|max_length[255]',
            'phone' => 'permit_empty|max_length[20]',
            'email' => 'permit_empty|valid_email',
            'city' => 'permit_empty|max_length[100]',
            'subject' => 'permit_empty|max_length[255]',
            'legal_matter' => 'permit_empty|max_length[255]',
            'message' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Please fill in all required fields correctly.');
        }

        $model = new EnquiryModel();

        // Prevent duplicate submissions within 5 minutes
        $recentEnquiry = $model->where('name', $this->request->getPost('name'))
            ->where('created_at >=', date('Y-m-d H:i:s', strtotime('-5 minutes')))
            ->first();

        if ($recentEnquiry) {
            return redirect()->to('/contact')->with('success', 'Your enquiry was already submitted. We will get back to you shortly.');
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'phone' => $this->request->getPost('phone'),
            'email' => $this->request->getPost('email'),
            'city' => $this->request->getPost('city'),
            'subject' => $this->request->getPost('subject'),
            'legal_matter' => $this->request->getPost('legal_matter'),
            'message' => $this->request->getPost('message'),
            'source_page' => $this->request->getServer('HTTP_REFERER') ?? '/contact',
            'ip_address' => $this->request->getIPAddress(),
        ];

        if ($model->insert($data)) {
            $newEnquiry = $model->orderBy('id', 'DESC')->first();
            if ($newEnquiry) {
                // Notify admin (fire-and-forget)
                try { MailService::notifyAdminNewEnquiry($newEnquiry); } catch (\Throwable $e) {
                    log_message('error', 'Admin enquiry email failed: ' . $e->getMessage());
                }
                // Send client acknowledgement (fire-and-forget)
                try { MailService::sendClientEnquiryAcknowledgement($newEnquiry); } catch (\Throwable $e) {
                    log_message('error', 'Client enquiry email failed: ' . $e->getMessage());
                }
            }

            return redirect()->to('/contact')->with('success', 'Thank you for your enquiry. We will get back to you shortly.');
        }

        return redirect()->back()->withInput()->with('error', 'Failed to submit enquiry. Please try again.');
    }
}
