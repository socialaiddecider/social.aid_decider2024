<?php

namespace App\Http\Controllers\Admin\Data;

use App\Http\Controllers\Controller;
use App\Models\Kriteria;
use App\Models\Subkriteria;
use Illuminate\Http\Request;

class SubkriteriaController extends Controller
{
    public function index()
    {
        $title = 'Data Subkriteria';
        $detailLocation = 'admin.data.subkriteria.detail';

        $kriteria = Kriteria::all();

        $data = [
            'title' => $title,
            'kriteria' => $kriteria,
            'detailLocation' => $detailLocation

        ];
        return view('pages.admin.data.subkriteria.index', $data);
    }

    public function detail($id)
    {
        $title = 'Detail Data Subkriteria';
        $subkriteria = Subkriteria::where('kriteria_id', $id)->get();
        $addLocation = route('admin.data.subkriteria.create', $id);
        $editLocation = 'admin.data.subkriteria.edit';
        $deleteLocation = 'admin.data.subkriteria.delete';


        $data = [
            'title' => $title,
            'subkriteria' => $subkriteria,
            'addLocation' => $addLocation,
            'editLocation' => $editLocation,
            'deleteLocation' => $deleteLocation
        ];

        return view('pages.admin.data.subkriteria.detail', $data);
    }

    public function create($id)
    {
        $title = 'Tambah Data Subkriteria';
        $storeLocation = route('admin.data.subkriteria.store');

        $data = [
            'title' => $title,
            'storeLocation' => $storeLocation,
            'kriteria_id' => $id,
        ];
        return view('pages.admin.data.subkriteria.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'criteria_code' => "required",
            'subcriteria_name' => 'required|min:6',
            'subcriteria_value' => 'required|numeric',
        ]);

        $data = [
            'kriteria_id' => $request->get('criteria_code'),
            'nama' => $request->get('subcriteria_name'),
            'nilai' => $request->get('subcriteria_value'),
        ];

        Subkriteria::create($data);
        return redirect()->route('admin.data.subkriteria.detail', $request->get('criteria_code'));
    }

    public function edit($id)
    {
        $title = 'Edit Data Subkriteria';
        $updateLocation = route('admin.data.subkriteria.update', $id);
        $subkriteria = Subkriteria::find($id);

        $data = [
            'title' => $title,
            'updateLocation' => $updateLocation,
            'subkriteria' => $subkriteria
        ];
        return view('pages.admin.data.subkriteria.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'subcriteria_name' => 'required|min:6',
            'subcriteria_value' => 'required|numeric',
        ]);

        $data = [
            'nama' => $request->get('subcriteria_name'),
            'nilai' => $request->get('subcriteria_value'),
        ];

        Subkriteria::find($id)->update($data);
        $kriteria_id = Subkriteria::find($id)->kriteria_id;
        return redirect()->route('admin.data.subkriteria.detail', $kriteria_id);
    }

    public function destroy($id)
    {
        $kriteria_id = Subkriteria::find($id)->kriteria_id;
        Subkriteria::destroy($id);
        return redirect()->route('admin.data.subkriteria.detail', $kriteria_id);
    }
}
