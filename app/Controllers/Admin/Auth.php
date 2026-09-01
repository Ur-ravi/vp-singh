<?php

namespace App\Controllers\Admin;

use App\Libraries\Auth as AuthLib;

class Auth extends \CodeIgniter\Controller
{
    protected $auth;

    public function __construct()
    {
        $this->auth = new AuthLib();
    }

    /**
     * Show login form
     */
    public function login()
    {
        if ($this->auth->check()) {
            return redirect()->to('/admin/dashboard');
        }
        return view('admin/auth/login');
    }

    /**
     * Process login
     */
    public function doLogin()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $result = $this->auth->attemptWithThrottle($email, $password);

        if ($result['success']) {
            return redirect()->to('/admin/dashboard')->with('success', 'Welcome back!');
        }

        return redirect()->back()->withInput()->with('error', $result['message']);
    }

    /**
     * Logout
     */
    public function logout()
    {
        $this->auth->logout();
        return redirect()->to('/admin/login')->with('success', 'You have been logged out.');
    }
}
