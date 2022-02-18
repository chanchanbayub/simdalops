<?php

namespace App\Controllers\Image;

use App\Controllers\BaseController;

class ImageView extends BaseController
{
    public function index()
    {
        return view('imgFile/image');
    }
}
