<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class AuthController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }

        $data = [
            'title' => 'Login'
        ];

        // session()->set('isLoggedIn', true);
        return view('pages/auth/login', $data);
    }

    public function loginCheck()
    {
        if ($this->request->getMethod() == 'POST') {
            $rules = [
                'email' => [
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => 'Email harus diisi',
                        'valid_email' => 'Email tidak valid'
                    ]
                ],

                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Password harus diisi'
                    ]
                ]
            ];

            if ($this->validate($rules)) {

                $email = $this->request->getVar('email');
                $password = $this->request->getVar('password');

                $user = $this->userModel->where('email', $email)->first();

                if ($user) {
                    if (password_verify($password, $user['password'])) {
                        session()->set('isLoggedIn', true);
                        session()->set('user', $user);
                        return $this->response->setJSON([
                            // 'data' => [
                            //     'email' => $user['email'],
                            //     'password' => $password
                            // ],
                            'redirect' => base_url('/')
                        ]);
                    } else {
                        return $this->response->setJSON([
                            'error' => true,
                            'message' => 'Password salah'
                        ]);
                    }
                } else {
                    return $this->response->setJSON([
                        'error' => true,
                        'message' => 'Email tidak terdaftar'
                    ]);
                }
            } else {
                return $this->response->setJSON([
                    'error' => true,
                    'message' => $this->validator->getErrors()
                ]);
            }
        }
    }

    public function register()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }

        $data = [
            'title' => 'Register'
        ];
        return view('pages/auth/register', $data);
    }

    public function registerCheck()
    {
        if ($this->request->getMethod() == 'POST') {
            $rules = [
                'nama' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama harus diisi'
                    ]
                ],

                'no_telp' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'No. Telp harus diisi'
                    ]
                ],

                'email' => [
                    'rules' => 'required|valid_email|is_unique[user.email]',
                    'errors' => [
                        'required' => 'Email harus diisi',
                        'valid_email' => 'Email tidak valid',
                        'is_unique' => 'Email sudah terdaftar'
                    ]
                ],

                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Password harus diisi'
                    ]
                ]
            ];

            if ($this->validate($rules)) {
                $nama = $this->request->getVar('nama');
                $no_telp = $this->request->getVar('no_telp');
                $email = $this->request->getVar('email');
                $password = $this->request->getVar('password');

                // Mengubah email menjadi lowercase
                $toLowerEmail = strtolower($email);

                $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash password

                $data = [
                    'email' => $toLowerEmail,
                    'password' => $hashedPassword,
                    'nama' => $nama,
                    'no_telp' => $no_telp,
                ];

                if ($this->userModel->insert($data)) {
                    return $this->response->setJSON([
                        'error' => false,
                        'message' => 'Register success',
                        'redirect' => base_url('auth/login')
                    ]);
                } else {
                    return $this->response->setJSON([
                        'error' => true,
                        'message' => 'Register failed'
                    ]);
                }
            } else {
                return $this->response->setJSON([
                    'error' => true,
                    'message' => $this->validator->getErrors()
                ]);
            }
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('auth/login');
    }
}