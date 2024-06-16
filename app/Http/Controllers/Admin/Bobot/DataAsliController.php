<?php

namespace App\Http\Controllers\Admin\Bobot;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataAsliController extends Controller
{
    public function index()
    {
        return view('pages.admin.bobot.data-asli');
    }
}
