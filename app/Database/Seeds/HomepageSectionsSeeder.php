<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class HomepageSectionsSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        // Get the homepage page (or create one)
        $this->db->table('pages')->insert([
            'title' => 'Homepage',
            'slug' => 'home',
            'template' => 'home',
            'is_published' => 1,
            'sort_order' => 0,
            'seo_title' => 'V P Singh Advocate | Legal Consultation & Representation | Lakhimpur Kheri',
            'seo_description' => 'Professional legal consultation and representation by V P Singh Advocate in Mohammadi Kheri, Lakhimpur Kheri, Uttar Pradesh.',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $sections = [
            [
                'section_key' => 'featured_practice_area',
                'section_title' => 'Featured Practice Area',
                'section_content' => json_encode([
                    'practice_area_id' => 1,
                    'description' => 'Expert criminal law services including bail applications, FIR matters, criminal defence, trials, and appeals.',
                ]),
                'sort_order' => 1,
                'is_visible' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'section_key' => 'why_choose',
                'section_title' => 'Why Choose V P Singh',
                'section_content' => null,
                'sort_order' => 2,
                'is_visible' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'section_key' => 'how_it_works',
                'section_title' => 'How It Works',
                'section_content' => null,
                'sort_order' => 3,
                'is_visible' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'section_key' => 'testimonials',
                'section_title' => 'What Clients Say',
                'section_content' => null,
                'sort_order' => 4,
                'is_visible' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'section_key' => 'cta_banner',
                'section_title' => 'Need Legal Assistance?',
                'section_content' => json_encode([
                    'heading' => 'Schedule a Legal Consultation',
                    'description' => 'Professional legal guidance for your specific matter.',
                    'cta_label' => 'Book Consultation',
                    'cta_url' => '/book-consultation',
                ]),
                'sort_order' => 5,
                'is_visible' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        $pageId = $this->db->table('pages')->where('slug', 'home')->get()->getRow()->id;

        foreach ($sections as &$section) {
            $section['page_id'] = $pageId;
        }

        $this->db->table('page_sections')->insertBatch($sections);
    }
}
