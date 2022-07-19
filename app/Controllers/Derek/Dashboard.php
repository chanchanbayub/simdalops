<?php

namespace App\Controllers\Derek;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $now = date('Y-m-d');
        // dd(session('unit_id'));
        $data = [
            'title' => 'Dashboard Penindakan',
        ];

        return view('derek/dashboard', $data);
    }
}
