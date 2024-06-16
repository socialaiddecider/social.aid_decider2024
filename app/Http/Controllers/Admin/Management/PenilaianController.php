<?php

namespace App\Http\Controllers\Admin\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    public function index()
    {
        return view('pages.admin.management.penilaian');
    }
}
