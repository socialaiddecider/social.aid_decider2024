<?php

namespace App\Http\Controllers\Admin\Features;

use App\Http\Controllers\Controller;
use App\Models\DetailPengajuan;
use Illuminate\Http\Request;
use App\Models\Pengajuan;

class PengajuanController extends Controller
{
    public function index()
    {
        $title = 'Kelola Pengajuan';
        $showLocation = 'admin.pengajuan.show';

        $pengajuan = Pengajuan::join('users', 'pengajuan.user_id', '=', 'users.id')->select('pengajuan.*', 'pengajuan.id as pengajuan_id', 'users.*')
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
        $updateLocation = 'admin.pengajuan.update';

        $pengajuan = Pengajuan::join('users', 'pengajuan.user_id', '=', 'users.id')->select('pengajuan.*', 'pengajuan.id as pengajuan_id', 'users.*')->find($id);
        $detailPengajuan = DetailPengajuan::join('kriteria', 'detail_pengajuan.kriteria_id', '=', 'kriteria.id')->join('subkriteria', 'detail_pengajuan.subkriteria_id', '=', 'subkriteria.id')->select('detail_pengajuan.*', 'kriteria.*', 'kriteria.nama as nama_kriteria', 'subkriteria.*')
            ->where('pengajuan_id', $id)
            ->get();


        $sortable = [
            'created_at' => 'Tanggal',
        ];

        $data = [
            'title' => $title,
            'pengajuan' => $pengajuan,
            'detailPengajuan' => $detailPengajuan,
            'sortable' => $sortable,
            'updateLocation' => $updateLocation,
        ];
        return view('pages.admin.features.pengajuan.show', $data);
    }

    public function update(Request $request, $id)
    {
        $pengajuan = Pengajuan::find($id);

        $request->validate([
            'status' => 'required',
        ]);

        if ($request->status == 'save') {
            $pengajuan->status = 'approved';
            $pengajuan->save();
        } else if ($request->status == 'remove') {
            $pengajuan->status = 'rejected';
            $pengajuan->save();
        } else {
            return redirect()->route('admin.pengajuan.show', $id)->with('error', 'Status pengajuan tidak valid');
        }

        return redirect()->route('admin.pengajuan.show', $id)->with('success', 'Status pengajuan berhasil diubah');
    }

}
