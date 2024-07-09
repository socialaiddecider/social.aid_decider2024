<?php

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SharedController extends Controller
{
    public function index()
    {
        return view('shared.index');
    }

}
