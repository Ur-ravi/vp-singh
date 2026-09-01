<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PracticeAreasSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');
        $areas = [
            [
                'title' => 'Criminal Law',
                'slug' => 'criminal-lawyer-lakhimpur-kheri',
                'short_description' => 'Bail, FIR matters, criminal defence, trials, appeals and related proceedings.',
                'description' => '<p>Our criminal law practice covers bail applications, FIR matters, criminal defence, trials, appeals, and related proceedings. We provide dedicated legal representation to protect your rights throughout the criminal justice process.</p>',
                'icon' => 'shield',
                'image' => '',
                'cta_label' => 'Explore This Practice',
                'is_featured' => 1,
                'is_published' => 1,
                'sort_order' => 1,
                'seo_title' => 'Criminal Lawyer in Lakhimpur Kheri | V P Singh Advocate',
                'seo_description' => 'Expert criminal law services in Lakhimpur Kheri. Bail, FIR matters, criminal defence, trials and appeals by V P Singh Advocate.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Family Law',
                'slug' => 'family-lawyer-lakhimpur-kheri',
                'short_description' => 'Divorce, matrimonial disputes, maintenance, domestic violence, child custody and related matters.',
                'description' => '<p>Family law matters require sensitivity and professional guidance. Our practice covers divorce, matrimonial disputes, maintenance, domestic violence, child custody, and related matters.</p>',
                'icon' => 'heart',
                'image' => '',
                'cta_label' => 'Explore This Practice',
                'is_featured' => 0,
                'is_published' => 1,
                'sort_order' => 2,
                'seo_title' => 'Family Lawyer in Lakhimpur Kheri | V P Singh Advocate',
                'seo_description' => 'Professional family law services in Lakhimpur Kheri. Divorce, custody, maintenance and domestic violence matters.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Civil Law',
                'slug' => 'civil-lawyer-lakhimpur-kheri',
                'short_description' => 'Property disputes, recovery, injunctions, possession, contracts and civil proceedings.',
                'description' => '<p>Our civil law practice handles property disputes, recovery suits, injunctions, possession matters, contract disputes, and various civil proceedings.</p>',
                'icon' => 'book-open',
                'image' => '',
                'cta_label' => 'Explore This Practice',
                'is_featured' => 0,
                'is_published' => 1,
                'sort_order' => 3,
                'seo_title' => 'Civil Lawyer in Lakhimpur Kheri | V P Singh Advocate',
                'seo_description' => 'Civil law services in Lakhimpur Kheri. Property disputes, recovery, injunctions and civil proceedings.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Cyber Law',
                'slug' => 'cyber-lawyer-lakhimpur-kheri',
                'short_description' => 'Online fraud, cybercrime, digital offences, identity theft and technology-related disputes.',
                'description' => '<p>Our cyber law practice addresses online fraud, cybercrime, digital offences, identity theft, and technology-related disputes in the digital age.</p>',
                'icon' => 'monitor',
                'image' => '',
                'cta_label' => 'Explore This Practice',
                'is_featured' => 0,
                'is_published' => 1,
                'sort_order' => 4,
                'seo_title' => 'Cyber Lawyer in Lakhimpur Kheri | V P Singh Advocate',
                'seo_description' => 'Cyber law services in Lakhimpur Kheri. Online fraud, cybercrime, digital offences and technology disputes.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Corporate & Commercial Law',
                'slug' => 'corporate-lawyer-lakhimpur-kheri',
                'short_description' => 'Contracts, business disputes, commercial matters, legal notices and corporate legal support.',
                'description' => '<p>Our corporate and commercial law practice covers contracts, business disputes, commercial matters, legal notices, and comprehensive corporate legal support.</p>',
                'icon' => 'briefcase',
                'image' => '',
                'cta_label' => 'Explore This Practice',
                'is_featured' => 0,
                'is_published' => 1,
                'sort_order' => 5,
                'seo_title' => 'Corporate Lawyer in Lakhimpur Kheri | V P Singh Advocate',
                'seo_description' => 'Corporate and commercial law services in Lakhimpur Kheri. Contracts, business disputes and legal support.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Drugs & Cosmetics Law',
                'slug' => 'drugs-cosmetics-lawyer-lakhimpur-kheri',
                'short_description' => 'Regulatory matters, licensing and proceedings under applicable legislation.',
                'description' => '<p>Our drugs and cosmetics law practice handles regulatory matters, licensing, and proceedings under applicable legislation governing pharmaceutical and cosmetic products.</p>',
                'icon' => 'activity',
                'image' => '',
                'cta_label' => 'Explore This Practice',
                'is_featured' => 0,
                'is_published' => 1,
                'sort_order' => 6,
                'seo_title' => 'Drugs & Cosmetics Lawyer in Lakhimpur Kheri | V P Singh Advocate',
                'seo_description' => 'Drugs and cosmetics law services in Lakhimpur Kheri. Regulatory matters, licensing and proceedings.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        $this->db->table('practice_areas')->insertBatch($areas);
    }
}
