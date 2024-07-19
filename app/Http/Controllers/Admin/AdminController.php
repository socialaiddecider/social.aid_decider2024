<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function dashboard()
    {
        $title = 'Dashboard';

        $data = [
            'title' => $title,
        ];

        return view('pages.admin.dashboard', $data);
    }

    public function profile()
    {
        $title = 'Profile';
        $data = [
            'title' => $title,
        ];

        return view('pages.user.profile', $data);
    }
}
