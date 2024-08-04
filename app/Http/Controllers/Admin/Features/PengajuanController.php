<?php

namespace App\Http\Controllers\Admin\Features;

use App\Http\Controllers\Controller;
use App\Models\Alternatif;
use App\Models\DetailPengajuan;
use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\Penilaian;
use App\Models\User;
use App\Notifications\StatusChanged;

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
        $user = User::find($pengajuan->user_id);

        $request->validate([
            'status' => 'required',
        ]);

        // if ($pengajuan->status == 'approved' || $pengajuan->status == 'rejected') {
        //     return redirect()->route('admin.pengajuan.show', $id)->with('error', 'Status pengajuan tidak dapat diubah');
        // }

        if ($request->status == 'save') {
            $pengajuan->status = 'approved';
            $pengajuan->save();

            $detailPengajuan = DetailPengajuan::join('pengajuan', 'detail_pengajuan.pengajuan_id', '=', 'pengajuan.id')->join('subkriteria', 'subkriteria.id', '=', 'detail_pengajuan.subkriteria_id')->where('pengajuan_id', $id)->get();


            $alternatif = Alternatif::where('nkk', $user->nkk);
            $lastAlternatif = Alternatif::orderBy('kode_alternatif', 'desc')->first();
            $splitKodeAlternatif = str_split($lastAlternatif->kode_alternatif, 1) ?? ['A', 0];
            $kodeAlternatif = $splitKodeAlternatif[0] . end($splitKodeAlternatif) + 1;
            if (!$alternatif?->exists()) {
                $alternatif = Alternatif::create([
                    'kode_Alternatif' => $kodeAlternatif,
                    'nama' => $user->name,
                    'nkk' => $user->nkk,
                    'alamat' => $user->address ?? '-',
                ]);
            }
            $created_at = substr($pengajuan->periode, 0, 7);

            // split year and month
            $month = (int) substr($created_at, 5);
            $year = (int) substr($created_at, 0, 4);

            foreach ($detailPengajuan as $detail) {
                $created_at = now()->setYear($year)->setMonth($month)->startOfMonth();

                Penilaian::create([
                    'alternatif_id' => $alternatif->id,
                    'kriteria_id' => $detail->kriteria_id,
                    'nilai' => $detail->nilai,
                    'created_at' => $created_at,
                ]);
            }


        } else if ($request->status == 'remove') {
            $pengajuan->status = 'rejected';
            $pengajuan->save();
        } else {
            return redirect()->route('admin.pengajuan.show', $id)->with('error', 'Status pengajuan tidak valid');
        }

        $user->notify(new StatusChanged($pengajuan, $user));

        return redirect()->route('admin.pengajuan.show', $id)->with('success', 'Status pengajuan berhasil diubah');
    }

}
