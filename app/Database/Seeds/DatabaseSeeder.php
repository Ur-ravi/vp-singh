<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('UsersSeeder');
        $this->call('SettingsSeeder');
        $this->call('MenusSeeder');
        $this->call('AdvocateProfileSeeder');
        $this->call('LocationsSeeder');
        $this->call('PracticeAreasSeeder');
        $this->call('PagesSeeder');
        $this->call('HomepageSectionsSeeder');
    }
}
