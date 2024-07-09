<?php

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;

class SharedController extends Controller
{
    public function index()
    {
        $berita = Berita::all();
        $data = [
            'berita' => $berita,
            'news' => $berita
        ];

        return view('shared.index', $data);
    }

}
