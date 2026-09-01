<?php

namespace App\Controllers\Admin;

use App\Libraries\Auth;
use App\Libraries\Settings;

class BaseController extends \CodeIgniter\Controller
{
    protected $auth;
    protected $data = [];

    public function __construct()
    {
        helper(['form', 'url', 'html']);
        $this->auth = new Auth();
        Settings::load();
    }

    /**
     * Set common admin data
     */
    protected function setAdminData(): self
    {
        $user = $this->auth->user();
        $enquiryModel = new \App\Models\EnquiryModel();
        $consultationModel = new \App\Models\ConsultationModel();
        $paymentModel = new \App\Models\PaymentModel();
        $blogModel = new \App\Models\BlogPostModel();

        $this->data['auth_user'] = $user;
        $this->data['is_super_admin'] = $this->auth->isSuperAdmin();
        $this->data['site_name'] = Settings::get('site_name', 'V P Singh Advocate');

        // Dashboard stats
        $this->data['new_enquiries'] = $enquiryModel->where('status', 'new')->countAllResults();
        $this->data['pending_consultations'] = $consultationModel->where('booking_status', 'pending')->countAllResults();
        $this->data['pending_payments'] = $paymentModel->where('status', 'submitted')->countAllResults();
        $this->data['published_posts'] = $blogModel->where('status', 'published')->countAllResults();
        $this->data['draft_posts'] = $blogModel->where('status', 'draft')->countAllResults();

        return $this;
    }

    /**
     * Render an admin view
     */
    protected function adminView(string $view, array $extraData = []): string
    {
        $this->setAdminData();
        $data = array_merge($this->data, $extraData);

        return view('admin/layouts/main', $data + [
            'content' => view("admin/{$view}", $data),
        ]);
    }

    /**
     * Set flash message
     */
    protected function setFlash(string $type, string $message): void
    {
        session()->setFlashdata($type, $message);
    }
}
