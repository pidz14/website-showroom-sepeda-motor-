<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Motors extends BaseController
{
    /**
     * Panel admin: tampilkan daftar motor.
     * Route: GET /admin/motors
     */
    public function index(): string
    {
        return view('admin/motors', [
            'title' => 'Admin — Manajemen Motor | Bagong Jaya Motor',
        ]);
    }

    /**
     * Tambah motor baru via API (opsional, jika ada form admin).
     * Route: POST /admin/motors
     */
    public function create()
    {
        $nama  = $this->request->getPost('nama');
        $merk  = $this->request->getPost('merk');
        $harga = $this->request->getPost('harga');

        if (empty($nama) || empty($merk) || empty($harga)) {
            return redirect()->to(base_url('admin/motors'))
                ->with('error', 'Nama, merek, dan harga wajib diisi.');
        }

        $apiUrl = rtrim(getenv('API_URL') ?: 'http://localhost:8000', '/');
        $client = \Config\Services::curlrequest();

        try {
            $response = $client->post($apiUrl . '/admin/motors', [
                'json'    => ['nama' => $nama, 'merk' => $merk, 'harga' => (int) $harga],
                'timeout' => 5,
            ]);
            $body = json_decode($response->getBody(), true);

            return redirect()->to(base_url('admin/motors'))
                ->with('success', $body['message'] ?? 'Data motor berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->to(base_url('admin/motors'))
                ->with('error', 'Gagal menghubungi server: ' . $e->getMessage());
        }
    }
}
