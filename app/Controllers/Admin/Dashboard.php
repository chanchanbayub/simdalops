<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard | E-Tilang'
        ];
        return view('admin/dashboard', $data);
    }
}
