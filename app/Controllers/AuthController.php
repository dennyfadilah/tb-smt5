<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    public function login()
    {
        $data = [
            'title' => 'Login'
        ];
        return view('pages/auth/login', $data);
    }

    public function register()
    {
        $data = [
            'title' => 'Register'
        ];
        return view('pages/auth/register', $data);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('auth/login');
    }
}
