<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\BrevoLibrary;
use CodeIgniter\HTTP\ResponseInterface;

class VerificationController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = model('UserModel');
    }

    public function sendVerificationCode()
    {
        // Ambil email dari input
        $email = $this->request->getPost('email');

        // Validasi email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Email tidak valid.']);
        }

        // Cek apakah email sudah terdaftar
        $user = $this->userModel->where('email', $email)->first();

        if ($user) {
            if ($this->sendCode($email)) {
                return $this->response->setJSON([
                    'error' => false,
                    'message' => 'Kode verifikasi telah dikirim.',
                    'redirect' => base_url('auth/enter-code')
                ]);
            } else {
                return $this->response->setJSON(['error' => true, 'message' => 'Gagal mengirim kode verifikasi.']);
            }
        } else {
            return $this->response->setJSON(['error' => true, 'message' => 'Email tidak terdaftar.']);
        }
    }

    public function sendCode($email)
    {
        // Generate kode verifikasi
        $verificationCode = rand(100000, 999999);

        // Simpan kode verifikasi ke database atau session untuk validasi
        session()->set('code', $verificationCode);
        session()->set('email', $email);

        // Buat instance BrevoLibrary
        $brevo = new BrevoLibrary();

        // Pesan yang akan dikirim
        $subject = 'Kode Verifikasi Anda';
        $content = "<p>Kode verifikasi Anda adalah: <strong>$verificationCode</strong></p>";

        // Kirim email
        return $brevo->sendVerificationEmail($email, $subject, $content);
    }
}