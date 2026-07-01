<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    /**
     * Tampilkan halaman form login.
     */
    public function loginForm(): string
    {
        return view('auth/login', [
            'title' => 'Masuk — Bagong Jaya Motor',
        ]);
    }

    /**
     * Proses login: kirim ke API backend, simpan session jika berhasil.
     */
    public function login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Validasi sederhana
        if (empty($username) || empty($password)) {
            return redirect()->to(base_url('auth/login'))
                ->with('error', 'Username dan password wajib diisi.');
        }

        // Kirim ke API backend
        $apiUrl = rtrim(getenv('API_URL') ?: 'http://localhost:8000', '/');

        $client = \Config\Services::curlrequest();

        try {
            $response = $client->post($apiUrl . '/auth/login', [
                'json'    => ['username' => $username, 'password' => $password],
                'timeout' => 5,
            ]);

            $body = json_decode($response->getBody(), true);

            if (isset($body['token'])) {
                // Simpan token ke session
                session()->set([
                    'user_token'    => $body['token'],
                    'user_username' => $username,
                    'isLoggedIn'    => true,
                ]);
                return redirect()->to(base_url('/'))
                    ->with('success', 'Login berhasil! Selamat datang, ' . esc($username) . '.');
            }

            return redirect()->to(base_url('auth/login'))
                ->with('error', $body['message'] ?? 'Login gagal. Periksa username dan password.');
        } catch (\Exception $e) {
            return redirect()->to(base_url('auth/login'))
                ->with('error', 'Gagal menghubungi server. Silakan coba lagi. (' . $e->getMessage() . ')');
        }
    }

    /**
     * Tampilkan halaman form registrasi.
     */
    public function registerForm(): string
    {
        return view('auth/register', [
            'title' => 'Daftar Akun — Bagong Jaya Motor',
        ]);
    }

    /**
     * Proses registrasi: kirim ke API backend.
     */
    public function register()
    {
        $username = $this->request->getPost('username');
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        if (empty($username) || empty($email) || empty($password)) {
            return redirect()->to(base_url('auth/register'))
                ->with('error', 'Semua field wajib diisi.');
        }

        $apiUrl = rtrim(getenv('API_URL') ?: 'http://localhost:8000', '/');
        $client = \Config\Services::curlrequest();

        try {
            $response = $client->post($apiUrl . '/auth/register', [
                'json'    => ['username' => $username, 'email' => $email, 'password' => $password],
                'timeout' => 5,
            ]);

            $body = json_decode($response->getBody(), true);

            if (isset($body['status']) && $body['status'] === 'success') {
                return redirect()->to(base_url('auth/login'))
                    ->with('success', 'Registrasi berhasil! Silakan login dengan akun baru Anda.');
            }

            return redirect()->to(base_url('auth/register'))
                ->with('error', $body['message'] ?? 'Registrasi gagal. Silakan coba lagi.');
        } catch (\Exception $e) {
            return redirect()->to(base_url('auth/register'))
                ->with('error', 'Gagal menghubungi server: ' . $e->getMessage());
        }
    }

    /**
     * Logout: hapus session.
     */
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/'))
            ->with('success', 'Anda berhasil keluar.');
    }
}
