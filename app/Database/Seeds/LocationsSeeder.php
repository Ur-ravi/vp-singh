<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LocationsSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');
        $data = [
            'office_name' => 'V P Singh Advocate Office',
            'address' => 'Mohammadi Kheri',
            'city' => 'Lakhimpur Kheri',
            'state' => 'Uttar Pradesh',
            'pin' => '',
            'phone' => '',
            'whatsapp' => '',
            'email' => '',
            'google_maps_url' => '',
            'latitude' => null,
            'longitude' => null,
            'office_hours' => 'Monday - Saturday: 9:00 AM - 6:00 PM',
            'image' => '',
            'is_active' => 1,
            'sort_order' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $this->db->table('locations')->insert($data);
    }
}
