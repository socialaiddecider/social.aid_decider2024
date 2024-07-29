<?php

namespace App\Http\Controllers\User\Feature;

use App\Http\Controllers\Controller;
use App\Models\DetailPengajuan;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use App\Models\Pengajuan;

class PengajuanController extends Controller
{
    public function index()
    {
        $submissionLocation = route('user.pengajuan.create');
        $deleteLocation = 'user.pengajuan.delete';
        $showLocation = 'user.pengajuan.show';
        $pengajuan = Pengajuan::where('user_id', auth()->id())->get();

        $data = [
            'submissionLocation' => $submissionLocation,
            'deleteLocation' => $deleteLocation,
            'pengajuan' => $pengajuan,
            'showLocation' => $showLocation,
        ];

        return view('pages.user.features.pengajuan.index', $data);
    }

    public function create()
    {
        $updateLocation = route('user.pengajuan.store');
        $kriteria = Kriteria::with('subkriteria')->get();
        $data = [
            'kriteria' => $kriteria,
            'updateLocation' => $updateLocation,
        ];
        return view('pages.user.features.pengajuan.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'value' => 'required',
            'value.*' => 'required',
        ]);

        $pengajuan = Pengajuan::create([
            'user_id' => auth()->id(),
            'periode' => date('Y-m-d'),
            'status' => 'pending',
        ]);


        if ($pengajuan) {
            foreach ($request->value as $key => $value) {
                DetailPengajuan::create([
                    'pengajuan_id' => $pengajuan->id,
                    'kriteria_id' => $key,
                    'subkriteria_id' => $value,
                ]);
            }
        }

        return redirect()->route('user.pengajuan.index');
    }

    public function show($id)
    {

        return view('pages.user.feature.pengajuan.show');
    }

    public function destroy($id)
    {
        $pengajuan = Pengajuan::find($id);
        if ($pengajuan && $pengajuan->user_id == auth()->id()) {
            $pengajuan->delete();
        }

        return redirect()->route('user.pengajuan.index');
    }
}
