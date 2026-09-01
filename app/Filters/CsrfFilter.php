<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class CsrfFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // CSRF is handled globally by CodeIgniter's Security config
        // This filter can be extended for additional checks
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Nothing to do after
    }
}
