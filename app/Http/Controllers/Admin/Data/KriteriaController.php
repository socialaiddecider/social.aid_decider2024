<?php

namespace App\Http\Controllers\Admin\Data;

use App\Http\Controllers\Controller;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        $title = 'Data Kriteria';
        $addLocation = route('admin.data.kriteria.create');
        $editLocation = 'admin.data.kriteria.edit';
        $deleteLocation = 'admin.data.kriteria.delete';
        $kriteria = Kriteria::all();

        $data = [
            'title' => $title,
            'addLocation' => $addLocation,
            'editLocation' => $editLocation,
            'deleteLocation' => $deleteLocation,
            'kriteria' => $kriteria
        ];
        return view('pages.admin.data.kriteria.index', $data);
    }

    public function create()
    {
        $title = 'Tambah Data Kriteria';
        $storeLocation = route('admin.data.kriteria.store');

        $data = [
            'title' => $title,
            'storeLocation' => $storeLocation
        ];
        return view('pages.admin.data.kriteria.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'criteria_code' => 'required|min:2|max:10|unique:kriteria,kode_kriteria',
            'criteria_name' => 'required|min:6',
            'criteria_type' => 'required',
        ]);

        $data = [
            'kode_kriteria' => $request->get('criteria_code'),
            'nama' => $request->get('criteria_name'),
            'jenis' => $request->get('criteria_type'),
        ];

        Kriteria::create($data);
        return redirect()->route('admin.data.kriteria.index');
    }

    public function edit($id)
    {
        $title = 'Edit Data Kriteria';
        $updateLocation = route('admin.data.kriteria.update', $id);
        $kriteria = Kriteria::find($id);


        $data = [
            'title' => $title,
            'updateLocation' => $updateLocation,
            'kriteria' => $kriteria
        ];
        return view('pages.admin.data.kriteria.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'criteria_code' => 'required|min:2|max:10|unique:kriteria,kode_kriteria,' . $id,
            'criteria_name' => 'required|min:6',
            'criteria_type' => 'required',
        ]);

        $data = [
            'kode_kriteria' => $request->get('criteria_code'),
            'nama' => $request->get('criteria_name'),
            'jenis' => $request->get('criteria_type'),
        ];

        Kriteria::find($id)->update($data);
        return redirect()->route('admin.data.kriteria.index');
    }

    public function destroy($id)
    {
        Kriteria::destroy($id);
        return redirect()->route('admin.data.kriteria.index');
    }
}
