<?php

namespace App\Http\Controllers\User\Features;

use App\Http\Controllers\Controller;
use App\Models\DetailPengajuan;
use App\Models\Kriteria;
use App\Models\Pengajuan;
use App\Models\User;
use App\Notifications\NewSubmission;
use Illuminate\Http\Request;

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

        $user = User::find(auth()->id());

        $userAdmin = User::where('role', 'admin')->get();

        foreach ($userAdmin as $admin) {
            $admin->notify(new NewSubmission($pengajuan, $admin, auth()->user()));
        }

        return redirect()->route('user.pengajuan.index');
    }

    public function show($id)
    {
        $pengajuan = Pengajuan::join('users', 'pengajuan.user_id', '=', 'users.id')
            ->where('pengajuan.id', $id)->select('*', 'users.name as user_name')->first();

        $detailPengajuan = DetailPengajuan::join('kriteria', 'detail_pengajuan.kriteria_id', '=', 'kriteria.id')
            ->join('subkriteria', 'detail_pengajuan.subkriteria_id', '=', 'subkriteria.id')
            ->where('pengajuan_id', $id)->select('*', 'kriteria.nama as kriteria_nama', 'subkriteria.nama as subkriteria_nama')
            ->get();

        if ($pengajuan?->user_id != auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $data = [
            'pengajuan' => $pengajuan,
            'detailPengajuan' => $detailPengajuan,

        ];

        return view('pages.user.features.pengajuan.show', $data);
    }

    public function destroy($id)
    {
        $pengajuan = Pengajuan::find($id);
        if ($pengajuan && $pengajuan->user_id == auth()->id()) {
            $pengajuan->delete();
        }

        return redirect()->route('user.features.pengajuan.show');
    }
}
