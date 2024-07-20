<?php

namespace App\Http\Controllers\Admin\Management;

use App\Http\Controllers\Controller;
use App\Models\Normalisasi;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Subkriteria;
use App\Models\JumlahKali;
use App\Models\KaliPangkat;
use App\Models\HasilSpk;
use App\Models\Penilaian;
use Illuminate\Support\Facades\Log;

class PerhitunganController extends Controller
{
    public function index()
    {
        $sortby = request()->query('sortby');
        $orderby = request()->query('orderby');

        $title = 'Hasil Perhitungan';

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

        $sortable = [
            'nama' => 'Alternatif',
        ];

        $periode = request()->date;
        $tanggalAwal = null ?? now()->startOfMonth();
        $tanggalAkhir = null ?? now()->endOfMonth();

        if ($periode) {
            $bulanTahun = explode('-', $periode);

            $tahun = (int) $bulanTahun[0];
            $bulan = (int) $bulanTahun[1];
            $tanggalAwal = now()->setYear($tahun)->setMonth($bulan)->startOfMonth();
            $tanggalAkhir = now()->setYear($tahun)->setMonth($bulan)->endOfMonth();
        }

        $alternatif = Alternatif::all();
        $kriteria = Kriteria::all();

        $subkriteria = Subkriteria::join('kriteria', 'subkriteria.kriteria_id', '=', 'kriteria.id')
            ->get();
        $penilaian = Penilaian::whereBetween('created_at', [$tanggalAwal, $tanggalAkhir])->get();

        $orderbyVal = in_array($orderby, ['asc', 'desc']) ? $orderby : 'asc';
        $orderbyVal = $orderbyVal == 'asc' ? false : true;

        $alternatif = $sortby ? $alternatif->sortBy($sortby, SORT_REGULAR, $orderbyVal) : $alternatif;

        $calcLocation = route('admin.management.perhitungan.calc', $tanggalAwal->format('Y-m'));

        if ($penilaian->isEmpty()) {
            $normalisasi = collect();
            $jumlahKali = collect();
            $kaliPangkat = collect();
            $hasilSpk = collect();
            $data = [
                'title' => $title,
                'calcLocation' => $calcLocation,
                'alternatif' => $alternatif,
                'kriteria' => $kriteria,
                'subkriteria' => $subkriteria,
                'normalisasi' => $normalisasi,
                'jumlahKali' => $jumlahKali,
                'kaliPangkat' => $kaliPangkat,
                'hasilSpk' => $hasilSpk,
                'sortable' => $sortable,
                'monthName' => $monthName,
                'tanggalAwal' => $tanggalAwal,
                'tanggalAkhir' => $tanggalAkhir,
            ];

            return view('pages.admin.management.perhitungan', $data);
        }

        $normalisasi = Normalisasi::join('alternatif', 'normalisasi.alternatif_id', '=', 'alternatif.id')
            ->join('kriteria', 'normalisasi.kriteria_id', '=', 'kriteria.id')
            ->get();

        $jumlahKali = JumlahKali::join('alternatif', 'jumlah_kali.alternatif_id', '=', 'alternatif.id')->get();
        $kaliPangkat = KaliPangkat::join('alternatif', 'kali_pangkat.alternatif_id', '=', 'alternatif.id')->get();
        $hasilSpk = HasilSpk::join('alternatif', 'hasil_spk.alternatif_id', '=', 'alternatif.id')->get();



        $data = [
            'title' => $title,
            'calcLocation' => $calcLocation,
            'alternatif' => $alternatif,
            'kriteria' => $kriteria,
            'subkriteria' => $subkriteria,
            'normalisasi' => $normalisasi,
            'jumlahKali' => $jumlahKali,
            'kaliPangkat' => $kaliPangkat,
            'hasilSpk' => $hasilSpk,
            'sortable' => $sortable,
            'monthName' => $monthName,
            'tanggalAwal' => $tanggalAwal,
            'tanggalAkhir' => $tanggalAkhir,
        ];

        return view('pages.admin.management.perhitungan', $data);
    }

    public function calc($date)
    {
        $periode = $date;
        $pyWaspas = env('PYTHON_WASPAS_PATH');
        $pyBin = env('PYTHON_BINARY_PATH');
        $output = shell_exec("{$pyBin} {$pyWaspas} {$periode}");

        Log::info('Output from waspas.py: ' . $output);

        // Check if there was an error during execution
        if ($output === null) {
            Log::error('Failed to execute waspas.py');
            return redirect()->back()->with('error', 'Failed to calculate waspas.');
        }
        return redirect()->back()->with('success', 'Waspas calculated successfully.');
    }
}
