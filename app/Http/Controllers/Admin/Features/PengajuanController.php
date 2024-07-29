<?php

namespace App\Http\Controllers\Admin\Features;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengajuan;

class PengajuanController extends Controller
{
    public function index()
    {
        $title = 'Kelola Pengajuan';
        $showLocation = 'admin.pengajuan.show';

        $pengajuan = Pengajuan::join('users', 'pengajuan.user_id', '=', 'users.id')
            ->orderBy('pengajuan.created_at', 'desc')
            ->get();


        $sortable = $sortable = [
            'created_at' => 'Tanggal',
        ];

        $data = [
            'title' => $title,
            'showLocation' => $showLocation,
            'sortable' => $sortable,
            'pengajuan' => $pengajuan,
        ];
        return view('pages.admin.features.pengajuan.index', $data);
    }

    public function show($id)
    {
        $title = 'Detail Pengajuan';
        $pengajuan = Pengajuan::join('users', 'pengajuan.user_id', '=', 'users.id')
            ->where('pengajuan.id', $id)
            ->first();

        $data = [
            'title' => $title,
            'pengajuan' => $pengajuan,
        ];
        return view('pages.admin.features.pengajuan.show', $data);
    }
}
