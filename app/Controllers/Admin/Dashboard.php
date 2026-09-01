<?php

namespace App\Controllers\Admin;

class Dashboard extends BaseController
{
    public function index()
    {
        return $this->adminView('dashboard/index');
    }
}
