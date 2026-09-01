<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');
        $settings = [
            // General
            ['setting_key' => 'site_name', 'setting_value' => 'V P Singh Advocate', 'setting_group' => 'general', 'created_at' => $now, 'updated_at' => $now],
            ['setting_key' => 'tagline', 'setting_value' => 'Professional Legal Counsel & Representation', 'setting_group' => 'general', 'created_at' => $now, 'updated_at' => $now],
            ['setting_key' => 'logo', 'setting_value' => '', 'setting_group' => 'general', 'created_at' => $now, 'updated_at' => $now],
            ['setting_key' => 'favicon', 'setting_value' => '', 'setting_group' => 'general', 'created_at' => $now, 'updated_at' => $now],
            ['setting_key' => 'phone', 'setting_value' => '', 'setting_group' => 'general', 'created_at' => $now, 'updated_at' => $now],
            ['setting_key' => 'whatsapp', 'setting_value' => '', 'setting_group' => 'general', 'created_at' => $now, 'updated_at' => $now],
            ['setting_key' => 'email', 'setting_value' => '', 'setting_group' => 'general', 'created_at' => $now, 'updated_at' => $now],
            ['setting_key' => 'address', 'setting_value' => 'Mohammadi Kheri, Lakhimpur Kheri, Uttar Pradesh, India', 'setting_group' => 'general', 'created_at' => $now, 'updated_at' => $now],
            ['setting_key' => 'consultation_fee', 'setting_value' => '2100', 'setting_group' => 'general', 'created_at' => $now, 'updated_at' => $now],
            ['setting_key' => 'business_hours', 'setting_value' => 'Monday - Saturday: 9:00 AM - 6:00 PM', 'setting_group' => 'general', 'created_at' => $now, 'updated_at' => $now],
            ['setting_key' => 'disclaimer', 'setting_value' => 'The information provided on this website is for general informational purposes only and should not be treated as legal advice. Viewing this website or contacting the office does not by itself create an advocate-client relationship.', 'setting_group' => 'general', 'created_at' => $now, 'updated_at' => $now],
            ['setting_key' => 'copyright', 'setting_value' => '© ' . date('Y') . ' V P Singh Advocate. All rights reserved.', 'setting_group' => 'general', 'created_at' => $now, 'updated_at' => $now],

            // Social Media
            ['setting_key' => 'social_instagram', 'setting_value' => '', 'setting_group' => 'social', 'created_at' => $now, 'updated_at' => $now],
            ['setting_key' => 'social_facebook', 'setting_value' => '', 'setting_group' => 'social', 'created_at' => $now, 'updated_at' => $now],
            ['setting_key' => 'social_linkedin', 'setting_value' => '', 'setting_group' => 'social', 'created_at' => $now, 'updated_at' => $now],
            ['setting_key' => 'social_youtube', 'setting_value' => '', 'setting_group' => 'social', 'created_at' => $now, 'updated_at' => $now],

            // Homepage Hero
            ['setting_key' => 'hero_eyebrow', 'setting_value' => 'ADVOCATE • LEGAL CONSULTATION • REPRESENTATION', 'setting_group' => 'hero', 'created_at' => $now, 'updated_at' => $now],
            ['setting_key' => 'hero_heading', 'setting_value' => 'Clear legal guidance. Strategic representation.', 'setting_group' => 'hero', 'created_at' => $now, 'updated_at' => $now],
            ['setting_key' => 'hero_description', 'setting_value' => 'Professional legal consultation and representation for individuals, families and businesses in Mohammadi Kheri, Lakhimpur Kheri and surrounding areas.', 'setting_group' => 'hero', 'created_at' => $now, 'updated_at' => $now],
            ['setting_key' => 'hero_image', 'setting_value' => '', 'setting_group' => 'hero', 'created_at' => $now, 'updated_at' => $now],
            ['setting_key' => 'hero_image_position', 'setting_value' => 'right', 'setting_group' => 'hero', 'created_at' => $now, 'updated_at' => $now],
            ['setting_key' => 'hero_cta_label', 'setting_value' => 'Book Consultation', 'setting_group' => 'hero', 'created_at' => $now, 'updated_at' => $now],
            ['setting_key' => 'hero_cta_url', 'setting_value' => '/book-consultation', 'setting_group' => 'hero', 'created_at' => $now, 'updated_at' => $now],
            ['setting_key' => 'hero_secondary_cta_label', 'setting_value' => 'Talk on WhatsApp', 'setting_group' => 'hero', 'created_at' => $now, 'updated_at' => $now],
            ['setting_key' => 'hero_secondary_cta_url', 'setting_value' => '', 'setting_group' => 'hero', 'created_at' => $now, 'updated_at' => $now],
            ['setting_key' => 'hero_location', 'setting_value' => 'Mohammadi Kheri · Lakhimpur Kheri · Uttar Pradesh', 'setting_group' => 'hero', 'created_at' => $now, 'updated_at' => $now],
            ['setting_key' => 'hero_visible', 'setting_value' => '1', 'setting_group' => 'hero', 'created_at' => $now, 'updated_at' => $now],

            // Trust Strip
            ['setting_key' => 'trust_items', 'setting_value' => json_encode([
                ['icon' => 'scale', 'text' => 'Professional Legal Counsel'],
                ['icon' => 'users', 'text' => 'Personal Consultation'],
                ['icon' => 'map-pin', 'text' => 'Local Legal Representation'],
                ['icon' => 'monitor', 'text' => 'Online & Offline Consultation'],
            ]), 'setting_group' => 'trust', 'created_at' => $now, 'updated_at' => $now],

            // Introduction
            ['setting_key' => 'intro_heading', 'setting_value' => 'A considered approach to every legal matter.', 'setting_group' => 'intro', 'created_at' => $now, 'updated_at' => $now],
            ['setting_key' => 'intro_content', 'setting_value' => '<p>Every legal matter deserves careful attention and a clear understanding of the facts. We take the time to understand your situation, explain your legal options, and develop an appropriate strategy.</p><p>Professional representation begins with clear communication. We ensure you understand each step of the process and remain informed throughout.</p><p>Confidentiality is fundamental to the attorney-client relationship. Your information is handled with the utmost care and discretion.</p>', 'setting_group' => 'intro', 'created_at' => $now, 'updated_at' => $now],
            ['setting_key' => 'intro_cta_label', 'setting_value' => 'About V P Singh', 'setting_group' => 'intro', 'created_at' => $now, 'updated_at' => $now],
            ['setting_key' => 'intro_cta_url', 'setting_value' => '/about', 'setting_group' => 'intro', 'created_at' => $now, 'updated_at' => $now],
            ['setting_key' => 'intro_visible', 'setting_value' => '1', 'setting_group' => 'intro', 'created_at' => $now, 'updated_at' => $now],

            // Why Choose
            ['setting_key' => 'why_items', 'setting_value' => json_encode([
                [
                    'icon' => 'message-circle',
                    'title' => 'Clear Communication',
                    'description' => 'Explain legal matters in straightforward language so you can make informed decisions.',
                ],
                [
                    'icon' => 'target',
                    'title' => 'Strategic Approach',
                    'description' => 'Understand facts and available legal options before determining the appropriate course of action.',
                ],
                [
                    'icon' => 'heart',
                    'title' => 'Personal Attention',
                    'description' => 'Client-focused consultation and representation tailored to your specific needs.',
                ],
                [
                    'icon' => 'shield',
                    'title' => 'Professional Confidentiality',
                    'description' => 'Handle client information with appropriate care and discretion.',
                ],
            ]), 'setting_group' => 'why_choose', 'created_at' => $now, 'updated_at' => $now],

            // How It Works
            ['setting_key' => 'how_it_works', 'setting_value' => json_encode([
                ['number' => '01', 'title' => 'Share Your Legal Matter', 'description' => 'Tell us about your legal situation through our consultation form or direct contact.', 'icon' => 'file-text'],
                ['number' => '02', 'title' => 'Book a Consultation', 'description' => 'Schedule an online or offline consultation at a time that works for you.', 'icon' => 'calendar'],
                ['number' => '03', 'title' => 'Understand Your Options', 'description' => 'Receive clear explanation of your legal position and available options.', 'icon' => 'lightbulb'],
                ['number' => '04', 'title' => 'Decide the Next Step', 'description' => 'Make an informed decision about how to proceed with your legal matter.', 'icon' => 'arrow-right'],
            ]), 'setting_group' => 'how_it_works', 'created_at' => $now, 'updated_at' => $now],
        ];

        $this->db->table('site_settings')->insertBatch($settings);
    }
}
