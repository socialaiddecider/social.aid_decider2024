<?php

namespace App\Http\Controllers\Admin\Features;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function index()
    {
        return view('pages.admin.features.news.index');
    }
}
