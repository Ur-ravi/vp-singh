<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdvocateProfileSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');
        $data = [
            'name' => 'V P Singh',
            'designation' => 'Advocate',
            'biography' => '<p>V P Singh is a legal professional based in Mohammadi Kheri, Lakhimpur Kheri, Uttar Pradesh, providing legal consultation and representation across multiple areas of law.</p><p>With a commitment to clear communication and client-focused service, V P Singh assists individuals, families, and businesses with their legal matters.</p>',
            'profile_image' => '',
            'education' => '',
            'experience' => '',
            'court_info' => '',
            'practice_area_ids' => json_encode([]),
            'memberships' => '',
            'credentials' => '',
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $this->db->table('advocate_profile')->insert($data);
    }
}
