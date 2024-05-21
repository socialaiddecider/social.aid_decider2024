<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function dashboard()
    {
        return view('pages.admin.dashboard');
    }
}
