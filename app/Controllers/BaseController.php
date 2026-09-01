<?php

namespace App\Controllers;

use App\Libraries\Settings;

class BaseController extends \CodeIgniter\Controller
{
    protected $settings;
    protected $data = [];

    public function __construct()
    {
        helper(['form', 'url', 'html']);
        Settings::load();
        $this->settings = Settings::all();
    }

    /**
     * Set common view data for all frontend pages
     */
    protected function setCommonData(): self
    {
        $menuModel = new \App\Models\MenuModel();
        $announcementModel = new \App\Models\AnnouncementModel();

        $this->data['settings'] = $this->settings;
        $this->data['site_name'] = Settings::get('site_name', 'V P Singh Advocate');
        $this->data['tagline'] = Settings::get('tagline', '');
        $this->data['logo'] = Settings::get('logo', '');
        $this->data['favicon'] = Settings::get('favicon', '');
        $this->data['phone'] = Settings::get('phone', '');
        $this->data['whatsapp'] = Settings::get('whatsapp', '');
        $this->data['email'] = Settings::get('email', '');
        $this->data['address'] = Settings::get('address', '');
        $this->data['copyright'] = Settings::get('copyright', '');
        $this->data['consultation_fee'] = Settings::get('consultation_fee', '2100');
        $this->data['disclaimer'] = Settings::get('disclaimer', '');
        $this->data['business_hours'] = Settings::get('business_hours', '');

        // Social media
        $this->data['social'] = [
            'instagram' => Settings::get('social_instagram', ''),
            'facebook' => Settings::get('social_facebook', ''),
            'linkedin' => Settings::get('social_linkedin', ''),
            'youtube' => Settings::get('social_youtube', ''),
        ];

        // Navigation
        $headerMenu = $menuModel->getMenuWithItems('header');
        $footerMenu = $menuModel->getMenuWithItems('footer');
        $this->data['header_menu'] = $headerMenu ? $headerMenu->items : [];
        $this->data['footer_menu'] = $footerMenu ? $footerMenu->items : [];

        // Announcement
        $this->data['announcement'] = $announcementModel->getActive();

        return $this;
    }

    /**
     * Render a frontend view with common data
     */
    protected function frontendView(string $view, array $extraData = []): string
    {
        $this->setCommonData();
        $data = array_merge($this->data, $extraData);
        return view('frontend/layouts/main', $data + ['content' => view("frontend/{$view}", $data)]);
    }
}
