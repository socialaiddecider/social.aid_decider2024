<?php

namespace App\Http\Controllers\Admin\Bobot;

use App\Http\Controllers\Controller;
use App\Models\AlgoritmaGenetika;
use App\Models\Bobot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Kriteria;

class KriteriaController extends Controller
{
    public function index()
    {
        $sortby = request()->query('sortby');
        $orderby = request()->query('orderby');

        $title = 'Hitung Bobot Kriteria';
        $bobot = Bobot::join('kriteria', 'bobot.kriteria_id', '=', 'kriteria.id')->select('bobot.bobot', 'kriteria.kode_kriteria', 'kriteria.nama')->get();
        $calcLocation = route('admin.bobot.kriteria.calc');
        $saveLocation = 'admin.bobot.kriteria.save';

        $orderbyVal = in_array($orderby, ['asc', 'desc']) ? $orderby : 'asc';
        $orderbyVal = $orderbyVal == 'asc' ? false : true;

        $bobot = $sortby && $orderby ? $bobot->sortBy($sortby, SORT_REGULAR, $orderbyVal) : $bobot;


        $sortable = [
            'kode_kriteria' => 'Kode Kriteria',
            'bobot' => 'Bobot',
            'nama' => 'Nama',
        ];

        $data = [
            'title' => $title,
            'calcLocation' => $calcLocation,
            'saveLocation' => $saveLocation,
            'bobot' => $bobot,
            'sortable' => $sortable,
        ];

        return view('pages.admin.bobot.kriteria', $data);
    }

    public function calc(Request $request)
    {
        $request->validate([
            'periode' => 'required',
            'iteration' => 'required|integer',
            'popsize' => 'required|numeric',
            'crossover_rate' => 'required|numeric',
            'mutation_rate' => 'required|numeric',
            'sum_penerima' => 'required|integer',
        ]);

        $algoritmaGenetics = AlgoritmaGenetika::first();

        $algoritmaGenetics->update([
            'iterasi' => $request->input('iteration'),
            'popsize' => $request->input('popsize'),
            'cr' => $request->input('crossover_rate'),
            'mr' => $request->input('mutation_rate'),
            'jumlah_penerima' => $request->input('sum_penerima'),
        ]);

        $algoritmaGenetics->save();
        
        $periodeInput = $request->input('periode'); 
        $periode = substr($periodeInput, 0, 7);

        // format periode to Y-m
        // $periode = date('Y-m', strtotime($periode));

        $pyGA = env('PYTHON_GA_PATH');
        $pyBin = env('PYTHON_BINARY_PATH');
        $output = shell_exec("{$pyBin} {$pyGA} {$periode}");
        dd($output);

        Log::info('Output from ga.py: ' . $output);

        // Check if there was an error during execution
        if ($output === null) {
            Log::error('Failed to execute ga.py');
            return redirect()->back()->with('error', 'Failed to calculate weights.');
        }

        return redirect()->back()->with('success', 'Weights calculated successfully.');
    }

    public function save()
    {
        $bobot = Bobot::all();

        foreach ($bobot as $b) {
            $kriteria = Kriteria::find($b->kriteria_id);
            // Jika kriteria tidak ditemukan, lanjutkan ke bobot berikutnya
            if (!$kriteria) {
                continue;
            }

            // Simpan bobot ke dalam kriteria
            $kriteria->bobot = $b->bobot;
            $kriteria->save();
        }

        return redirect()->back()->with('success', 'Weights saved successfully.');
    }

}
