<?php

namespace App\Http\Controllers\Admin\Features;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    public function index()
    {
        $title = 'Kelola Pengajuan';
        $sortable = $sortable = [
            'created_at' => 'Tanggal',
        ]
        ;

        $data = [
            'title' => $title,
            'sortable' => $sortable,
        ];
        return view('pages.admin.features.pengajuan.index', $data);
    }
}
