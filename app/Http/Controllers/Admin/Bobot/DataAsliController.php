<?php

namespace App\Http\Controllers\Admin\Bobot;

use App\Http\Controllers\Controller;
use App\Models\Alternatif;
use App\Models\DataAsli;
use Illuminate\Http\Request;

class DataAsliController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Data Asli';
        $addLocation = route('admin.bobot.data-asli.create');
        $editLocation = 'admin.bobot.data-asli.edit';
        $deleteLocation = 'admin.bobot.data-asli.delete';

        $periode = $request->input('periode');
        $tanggalAwal = null ?? now()->startOfMonth();
        $tanggalAkhir = null ?? now()->endOfMonth();

        if ($periode) {
            $bulanTahun = explode('-', $periode);
            $tahun = $bulanTahun[0];
            $bulan = $bulanTahun[1];
            $tanggalAwal = now()->setYear($tahun)->setMonth($bulan)->startOfMonth();
            $tanggalAkhir = now()->setYear($tahun)->setMonth($bulan)->endOfMonth();
        }

        $dataAsli = DataAsli::with('alternatif')->whereBetween('created_at', [$tanggalAwal, $tanggalAkhir])->get();


        $data = [
            'title' => $title,
            'addLocation' => $addLocation,
            'editLocation' => $editLocation,
            'deleteLocation' => $deleteLocation,
            'dataAsli' => $dataAsli
        ];


        return view('pages.admin.bobot.data-asli.index', $data);
    }

    public function create()
    {
        $title = 'Tambah Data Asli';
        $storeLocation = route('admin.bobot.data-asli.store');
        $alternatif = Alternatif::all();
        $dataAsli = DataAsli::all();

        $status = ['Menerima' => 'Menerima', 'Tidak Menerima' => 'Tidak Menerima'];

        $data = [
            'title' => $title,
            'storeLocation' => $storeLocation,
            'alternatif' => $alternatif,
            'status' => $status
        ];

        return view('pages.admin.bobot.data-asli.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'created_at' => 'required',
            'alternatif_id' => 'required',
            'status' => 'required'
        ]);


        $dataAsli = new DataAsli;
        $alternatif = new Alternatif;
        $alternatif->id = $request->get('alternatif_id');
        $dataAsli->alternatif()->associate($alternatif);
        $dataAsli->status = $request->get('status');

        // Ambil periode dari request
        $created_at = date('Y-m', strtotime($request->get('created_at')));
        $dataAsli->created_at = $created_at;
        $dataAsli->save();


        return redirect()->route('admin.bobot.data-asli.index');
    }

    public function edit($id)
    {
        $title = 'Edit Data Asli';
        $updateLocation = route('admin.bobot.data-asli.update', $id);
        $alternatif = Alternatif::all();
        $dataAsli = DataAsli::find($id);

        $status = ['Menerima' => 'Menerima', 'Tidak Menerima' => 'Tidak Menerima'];

        $data = [
            'title' => $title,
            'updateLocation' => $updateLocation,
            'alternatif' => $alternatif,
            'dataAsli' => $dataAsli,
            'status' => $status
        ];

        return view('pages.admin.bobot.data-asli.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'alternatif_id' => 'required',
            'status' => 'required',
        ]);

        $dataAsli = DataAsli::find($id);
        $dataAsli->alternatif_id = $request->get('alternatif_id');
        $dataAsli->status = $request->get('status');
        $dataAsli->save();

        return redirect()->route('admin.bobot.data-asli.index');

    }

    public function destroy($id)
    {
        $dataAsli = DataAsli::find($id);
        $dataAsli->delete();

        return redirect()->route('admin.bobot.data-asli.index');
    }
}
