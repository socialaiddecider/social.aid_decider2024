<?php

namespace App\Http\Controllers\Admin\Data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alternatif;

class AlternatifController extends Controller
{
    public function index()
    {
        $sortby = request()->query('sortby');
        $orderby = request()->orderby;

        $title = 'Data Alternatif';
        $addLocation = route('admin.data.alternatif.create');
        $editLocation = 'admin.data.alternatif.edit';
        $deleteLocation = 'admin.data.alternatif.delete';
        $alternatif = Alternatif::all();

        $sortable = ['kode_alternatif' => 'Kode Alternatif', 'nama' => "Nama", 'nkk' => 'NKK', 'alamat' => 'Alamat'];
        $orderbyVal = in_array($orderby, ['asc', 'desc']) ? $orderby : 'asc';

        $alternatif = $sortby ? Alternatif::orderBy($sortby, $orderbyVal)->get() : $alternatif;

        $data = [
            'title' => $title,
            'alternatif' => $alternatif,
            'addLocation' => $addLocation,
            'editLocation' => $editLocation,
            'deleteLocation' => $deleteLocation,
            'sortable' => $sortable
        ];

        return view('pages.admin.data.alternatif.index', $data);
    }

    public function create()
    {
        $title = 'Tambah Data Alternatif';
        $storeLocation = route('admin.data.alternatif.store');

        $data = [
            'title' => $title,
            'storeLocation' => $storeLocation
        ];

        return view('pages.admin.data.alternatif.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'alternatif_code' => 'required|min:2|max:10|unique:alternatif,kode_Alternatif',
            'alternatif_name' => 'required|min:3',
            'alternatif_nkk' => 'required|min:16',
            'alternatif_address' => 'required|min:6'
        ]);

        $data = [
            'kode_Alternatif' => $request->get('alternatif_code'),
            'nama' => $request->get('alternatif_name'),
            'nkk' => $request->get('alternatif_nkk'),
            'alamat' => $request->get('alternatif_address')
        ];

        Alternatif::create($data);
        return redirect()->route('admin.data.alternatif.index');
    }

    public function edit($id)
    {
        $title = 'Edit Data Alternatif';
        $alternatif = Alternatif::find($id);
        $updateLocation = route('admin.data.alternatif.update', $id);

        $data = [
            'title' => $title,
            'alternatif' => $alternatif,
            'updateLocation' => $updateLocation
        ];

        return view('pages.admin.data.alternatif.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'alternatif_code' => 'required|min:2|max:10|unique:alternatif,kode_Alternatif,' . $id,
            'alternatif_name' => 'required|min:3',
            'alternatif_address' => 'required|min:6'
        ]);

        $data = [
            'kode_Alternatif' => $request->get('alternatif_code'),
            'nama' => $request->get('alternatif_name'),
            'nkk' => $request->get('alternatif_nkk'),
            'alamat' => $request->get('alternatif_address')
        ];

        Alternatif::find($id)->update($data);
        return redirect()->route('admin.data.alternatif.index');
    }

    public function destroy($id)
    {
        Alternatif::destroy($id);
        return redirect()->route('admin.data.alternatif.index');
    }
}
