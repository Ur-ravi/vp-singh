<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'email' => 'admin@vpsinghadvocate.com',
                'username' => 'admin',
                'password_hash' => password_hash('Admin@123', PASSWORD_DEFAULT),
                'role' => 'super_admin',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'email' => 'editor@vpsinghadvocate.com',
                'username' => 'editor',
                'password_hash' => password_hash('Editor@123', PASSWORD_DEFAULT),
                'role' => 'editor',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
