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
                'loginInput' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Masukan email atau no. telp'
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

                $loginInput = $this->request->getVar('loginInput');
                $password = $this->request->getVar('password');

                $user = $this->userModel
                    ->where('email', $loginInput)
                    ->orWhere('no_telp', $loginInput)
                    ->first();

                if ($user) {
                    if (password_verify($password, $user['password'])) {
                        session()->set('isLoggedIn', true);
                        session()->set('nama', $user['nama']);
                        return $this->response->setJSON([
                            'redirect' => base_url('/')
                        ]);
                    } else {
                        return $this->response->setJSON([
                            'error' => true,
                            'message' => 'Informasi yang Anda masukkan tidak sesuai. Silakan coba lagi.'
                        ]);
                    }
                } else {
                    return $this->response->setJSON([
                        'error' => true,
                        'message' => 'Informasi yang Anda masukkan tidak sesuai. Silakan coba lagi.'
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

    public function forgotPassword()
    {
        return view('pages/auth/forgot-password', ['title' => 'Forgot Password']);
    }

    public function enterCode()
    {
        $data = [
            'title' => 'Enter Code',
            'email' => session()->get('email')
        ];

        return view('pages/auth/enter-code', $data);
    }

    public function verifyCode()
    {
        if ($this->request->getMethod() == 'POST') {
            $code = $this->request->getVar('code');

            if ($code == session()->get('code')) {
                return $this->response->setJSON([
                    'error' => false,
                    'redirect' => base_url('auth/reset-password')
                ]);
            } else {
                return $this->response->setJSON([
                    'error' => true,
                    'message' => 'The code entered is invalid.'
                ]);
            }
        }
    }

    public function resetPassword()
    {
        return view('pages/auth/enter-password', ['title' => 'Reset Password']);
    }

    public function confirmPassword()
    {
        if ($this->request->getMethod() == 'POST') {
            $rules = [
                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Password harus diisi'
                    ]
                ], 'confirmPassword' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Konfirmasi Password harus diisi'
                    ]
                ]
            ];

            if ($this->validate($rules)) {
                $password = $this->request->getVar('password');
                $confirmPassword = $this->request->getVar('confirmPassword');

                if ($confirmPassword == $password) {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash password

                    $user = $this->userModel->where('email', session()->get('email'))->first();

                    if ($this->userModel->update($user['id'], ['password' => $hashedPassword])) {
                        return $this->response->setJSON([
                            'error' => false,
                            'message' => 'Reset password success',
                            'redirect' => base_url('auth/login')
                        ]);
                    } else {
                        return $this->response->setJSON([
                            'error' => true,
                            'message' => 'Reset password failed'
                        ]);
                    }
                } else {
                    return $this->response->setJSON([
                        'error' => true,
                        'field' => true,
                        'message' => 'The password entered does not match.'

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
}
