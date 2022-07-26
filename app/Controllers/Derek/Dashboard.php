<?php

namespace App\Controllers\Derek;

use App\Controllers\BaseController;
use DateTime;

class Dashboard extends BaseController
{
    public function index()
    {
        $now = date('l');
        $hari_indonesia = array(
            'Monday'  => 'Senin',
            'Tuesday'  => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
            'Sunday' => 'Minggu'
        );
        // dd($hari_indonesia[$now]);
        $data = [
            'title' => 'Dashboard Penindakan',
        ];

        return view('derek/dashboard', $data);
    }
}
