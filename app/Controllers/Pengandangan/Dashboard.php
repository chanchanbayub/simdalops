<?php

namespace App\Controllers\Pengandangan;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'E-Tilang',
        ];

        return view('pengandangan/dashboard', $data);
    }
}
