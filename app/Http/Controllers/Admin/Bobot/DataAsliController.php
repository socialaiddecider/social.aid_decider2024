<?php

namespace App\Http\Controllers\Admin\Bobot;

use App\Http\Controllers\Controller;
use App\Models\Alternatif;
use App\Models\DataAsli;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DataAsliImport;

class DataAsliController extends Controller
{
    public function index()
    {
        $sortby = request()->query('sortby');
        $orderby = request()->query('orderby');

        $title = 'Data Asli';
        $addLocation = route('admin.bobot.data-asli.create');
        $editLocation = 'admin.bobot.data-asli.edit';
        $deleteLocation = 'admin.bobot.data-asli.delete';
        $importLocation = route('admin.bobot.data-asli.import-xlsx');

        $periode = request()->date;
        $tanggalAwal = null ?? now()->startOfMonth();
        $tanggalAkhir = null ?? now()->endOfMonth();

        $sortable = [
            'kode_alternatif' => 'Kode Alternatif',
            'status' => 'Status',
            'nama' => 'Nama',
        ];

        $monthName = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December',
        ];

        if ($periode) {
            $bulanTahun = explode('-', $periode);
            $tahun = (int) $bulanTahun[0];
            $bulan = (int) $bulanTahun[1];
            $tanggalAwal = now()->setYear($tahun)->setMonth($bulan)->startOfMonth();
            $tanggalAkhir = now()->setYear($tahun)->setMonth($bulan)->endOfMonth();
        }

        $dataAsli = DataAsli::join('alternatif', 'alternatif.id', '=', 'data_asli.alternatif_id')->whereBetween('data_asli.created_at', [$tanggalAwal, $tanggalAkhir])->get();

        $orderbyVal = in_array($orderby, ['asc', 'desc']) ? $orderby : 'asc';
        $orderbyVal = $orderbyVal == 'asc' ? false : true;

        $dataAsli = $sortby && $orderby ? $dataAsli->sortBy($sortby, SORT_REGULAR, $orderbyVal) : $dataAsli;

        $data = [
            'title' => $title,
            'addLocation' => $addLocation,
            'editLocation' => $editLocation,
            'deleteLocation' => $deleteLocation,
            'dataAsli' => $dataAsli,
            'tanggalAwal' => $tanggalAwal,
            'tanggalAkhir' => $tanggalAkhir,
            'monthName' => $monthName,
            'sortable' => $sortable,
            'importLocation' => $importLocation
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

    public function importXlsx(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'xlsxFile' => 'required|mimes:xlsx,xls'
        ]);

        if ($request->fails()) {
            return redirect()->back();
        }

        $periode = $request->date;
        $file = $request->file('file');

        Excel::import(new DataAsliImport($periode), $file);

        return redirect()->route('admin.management.penilaian.index');

    }
}
