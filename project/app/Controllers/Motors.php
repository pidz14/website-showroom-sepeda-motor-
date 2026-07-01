<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Motors extends BaseController
{
    /**
     * Halaman katalog motor (SPA — JS yang handle render dari API).
     * Route: GET /motors
     */
    public function index(): string
    {
        return view('home/index', [
            'title' => 'Katalog Motor — Bagong Jaya Motor',
        ]);
    }

    /**
     * Halaman detail motor — JS showroom.js yang fetch detail dari API.
     * Route: GET /motors/{id}
     */
    public function show(int $id): string
    {
        return view('home/index', [
            'title'    => 'Detail Motor #' . $id . ' — Bagong Jaya Motor',
            'motor_id' => $id,
        ]);
    }
}
