<?php

namespace App\Filters\Auth;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\Session\Session;

class AuthFilters implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('isLoggedIn') == true) {
            return redirect()->to(base_url('/'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        if (session()->get('isLoggedIn') == true) {
            if (session('role_management') == 'Admin') {
                return redirect()->to(base_url('admin/dashboard'));
            }
        }
    }
}
