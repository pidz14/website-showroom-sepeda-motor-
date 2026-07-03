<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class TestDrive extends BaseController
{
    /**
     * Tampilkan form test drive.
     * Route: GET /test-drive
     */
    public function index(): string
    {
        // Coba ambil list motor dari API untuk dropdown
        $motors = $this->fetchMotorsFromApi();

        return view('test-drive/form', [
            'title'  => 'Daftar Test Drive — Bagong Jaya Motor',
            'motors' => $motors,
        ]);
    }

    /**
     * Proses pengiriman form test drive ke API backend.
     * Route: POST /test-drive
     */
    public function create()
    {
        $motorId = $this->request->getPost('motor_id');
        $tanggal = $this->request->getPost('tanggal');
        $nama    = $this->request->getPost('nama');

        if (empty($motorId) || empty($tanggal) || empty($nama)) {
            return redirect()->to(base_url('test-drive'))
                ->with('error', 'Nama, motor, dan tanggal wajib diisi.');
        }

        $apiUrl = rtrim(getenv('API_URL') ?: 'http://localhost:8000', '/');
        $client = \Config\Services::curlrequest();

        try {
            $response = $client->post($apiUrl . '/test-drive', [
                'json'    => [
                    'motor_id' => (int) $motorId,
                    'tanggal'  => $tanggal,
                ],
                'timeout' => 5,
            ]);

            $body = json_decode($response->getBody(), true);

            if (isset($body['status']) && $body['status'] === 'success') {
                return redirect()->to(base_url('test-drive'))
                    ->with('success', '✅ Permohonan test drive berhasil dikirim! Tim kami akan menghubungi Anda segera.');
            }

            return redirect()->to(base_url('test-drive'))
                ->with('error', $body['message'] ?? 'Gagal mengajukan test drive. Silakan coba lagi.');
        } catch (\Exception $e) {
            return redirect()->to(base_url('test-drive'))
                ->with('error', 'Gagal menghubungi server: ' . $e->getMessage());
        }
    }

    /**
     * Ambil daftar motor dari API untuk dropdown form test drive.
     * Jika API tidak bisa diakses, kembalikan array kosong (view punya fallback).
     */
    private function fetchMotorsFromApi(): array
    {
        $apiUrl = rtrim(getenv('API_URL') ?: 'http://localhost:8000', '/');
        $client = \Config\Services::curlrequest();

        try {
            $response = $client->get($apiUrl . '/motors', [
                'timeout' => 3,
                'headers' => ['Accept' => 'application/json'],
            ]);
            $body = json_decode($response->getBody(), true);

            if (isset($body['data']) && is_array($body['data'])) {
                return $body['data'];
            }
            if (is_array($body)) {
                return $body;
            }
        } catch (\Exception $e) {
            log_message('warning', 'TestDrive::fetchMotorsFromApi() gagal: ' . $e->getMessage());
        }

        return [];
    }
}
