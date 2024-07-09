<?php

namespace App\Http\Controllers\Admin\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PerhitunganController extends Controller
{
    public function index()
    {
        $title = 'Hasil Perhitungan';

        $data = [
            'title' => $title,
        ];

        return view('pages.admin.management.perhitungan', $data);
    }
}
