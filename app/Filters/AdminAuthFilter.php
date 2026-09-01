<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AdminAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $auth = new \App\Libraries\Auth();

        if (!$auth->check()) {
            return redirect()->to('/admin/login')->with('error', 'Please log in to access the admin panel.');
        }

        // Check role-based access
        if ($arguments && in_array('super_admin', $arguments)) {
            if (!$auth->isSuperAdmin()) {
                return redirect()->to('/admin/dashboard')->with('error', 'You do not have permission to access this area.');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Nothing to do after
    }
}
