<?php

namespace App\Http\Controllers\Admin\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penerima;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Barryvdh\DomPDF\Facade\Pdf;

class PenerimaController extends Controller
{
    public function index()
    {
        $sortby = request()->query('sortby');
        $orderby = request()->query('orderby');

        $title = 'Data Penerima';
        $exportLocation = 'admin.management.penerima.exportPdf';

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

        $periode = request()->date;
        $tanggalAwal = null ?? now()->startOfMonth();
        $tanggalAkhir = null ?? now()->endOfMonth();

        if ($periode) {
            $bulanTahun = explode('-', $periode);

            $tahun = (int) $bulanTahun[0];
            $bulan = (int) $bulanTahun[1];
            $tanggalAwal = now()->setYear($tahun)->setMonth($bulan)->startOfMonth();
            $tanggalAkhir = now()->setYear($tahun)->setMonth($bulan)->endOfMonth();
        } else {
            $periode = now()->format('Y-m');
        }

        $sortable = [
            'nama' => 'Nama',
            'nilai' => 'Nilai',
            'status' => 'Status',

        ];

        $penerima = Penerima::join('alternatif', 'alternatif.id', '=', 'penerima.alternatif_id')->whereBetween('penerima.created_at', [$tanggalAwal, $tanggalAkhir])->get();

        $orderbyVal = in_array($orderby, ['asc', 'desc']) ? $orderby : 'asc';
        $orderbyVal = $orderbyVal == 'asc' ? false : true;

        $penerima = $sortby ? $penerima->sortBy($sortby, SORT_REGULAR, $orderbyVal) : $penerima;

        $data = [
            'title' => $title,
            'exportLocation' => $exportLocation,
            'penerima' => $penerima,
            'monthName' => $monthName,
            'tanggalAwal' => $tanggalAwal,
            'tanggalAkhir' => $tanggalAkhir,
            'sortable' => $sortable,
            'periode' => $periode,
        ];

        return view('pages.admin.management.penerima.index', $data);
    }

    public function exportPDF($date)
    {
        $bulanTahun = explode('-', $date);

        $tahun = (int) $bulanTahun[0];
        $bulan = (int) $bulanTahun[1];
        $tanggalAwal = now()->setYear($tahun)->setMonth($bulan)->startOfMonth();
        $tanggalAkhir = now()->setYear($tahun)->setMonth($bulan)->endOfMonth();

        $penerima = Penerima::join('alternatif', 'alternatif.id', '=', 'penerima.alternatif_id')->whereBetween('penerima.created_at', [$tanggalAwal, $tanggalAkhir])->get();

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

        $alternatif = Alternatif::whereHas('penilaian')->get();
        $kriteria = Kriteria::with('subkriteria')->get();
        $penilaian = Penilaian::with('alternatif', 'kriteria')->whereBetween('created_at', [$tanggalAwal, $tanggalAkhir])->get();
        $penerima = Penerima::with('alternatif')->whereBetween('created_at', [$tanggalAwal, $tanggalAkhir])->get();

        $data = [
            'alternatif' => $alternatif,
            'kriteria' => $kriteria,
            'penilaian' => $penilaian,
            'penerima' => $penerima,
            'monthName' => $monthName,
            'tanggalAwal' => $tanggalAwal,
            'tanggalAkhir' => $tanggalAkhir,
        ];

        $pdf = Pdf::loadView('pages.admin.management.penerima.export-pdf', $data);
        return $pdf->stream('Data Penerima ' . $monthName[$bulan - 1] . ' ' . $tahun . '.pdf');
    }
}
