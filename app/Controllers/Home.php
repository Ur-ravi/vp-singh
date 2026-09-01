<?php

namespace App\Controllers;

use App\Libraries\Settings;

class Home extends BaseController
{
    public function index()
    {
        $practiceAreaModel = new \App\Models\PracticeAreaModel();
        $testimonialModel = new \App\Models\TestimonialModel();
        $advocateModel = new \App\Models\AdvocateProfileModel();

        $extraData = [
            'page_title' => Settings::get('site_name', 'V P Singh Advocate'),
            'practice_areas' => $practiceAreaModel->getPublished(),
            'featured_practice_area' => $practiceAreaModel->getFeatured(),
            'testimonials' => $testimonialModel->getPublished(),
            'advocate' => $advocateModel->getProfile(),

            // Hero settings
            'hero_eyebrow' => Settings::get('hero_eyebrow'),
            'hero_heading' => Settings::get('hero_heading'),
            'hero_description' => Settings::get('hero_description'),
            'hero_image' => Settings::get('hero_image'),
            'hero_image_position' => Settings::get('hero_image_position'),
            'hero_cta_label' => Settings::get('hero_cta_label', 'Book Consultation'),
            'hero_cta_url' => Settings::get('hero_cta_url', '/book-consultation'),
            'hero_secondary_cta_label' => Settings::get('hero_secondary_cta_label', 'Talk on WhatsApp'),
            'hero_secondary_cta_url' => Settings::get('hero_secondary_cta_url', ''),
            'hero_location' => Settings::get('hero_location'),
            'hero_visible' => Settings::get('hero_visible', '1'),

            // Trust
            'trust_items' => json_decode(Settings::get('trust_items', '[]'), true),

            // Intro
            'intro_heading' => Settings::get('intro_heading'),
            'intro_content' => Settings::get('intro_content'),
            'intro_cta_label' => Settings::get('intro_cta_label', 'About V P Singh'),
            'intro_cta_url' => Settings::get('intro_cta_url', '/about'),
            'intro_visible' => Settings::get('intro_visible', '1'),

            // Why Choose
            'why_items' => json_decode(Settings::get('why_items', '[]'), true),

            // How It Works
            'how_it_works' => json_decode(Settings::get('how_it_works', '[]'), true),
        ];

        return $this->frontendView('home/index', $extraData);
    }
}
