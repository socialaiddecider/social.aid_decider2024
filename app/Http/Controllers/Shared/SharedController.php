<?php

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Penerima;

class SharedController extends Controller
{
    public function index()
    {
        $berita = Berita::where('status', 'publish')->get();

        $data = [
            'berita' => $berita,
            'news' => $berita
        ];

        return view('pages.shared.index', $data);
    }

    public function showData()
    {

        $title = 'Data Penerima';


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

        $penerima = Penerima::join('alternatif', 'alternatif.id', '=', 'penerima.alternatif_id')->whereBetween('penerima.created_at', [$tanggalAwal, $tanggalAkhir])->get();


        $data = [
            'title' => $title,
            'periode' => $periode,
            'monthName' => $monthName,
            'penerima' => $penerima,
            'tanggalAwal' => $tanggalAwal,
            'tanggalAkhir' => $tanggalAkhir
        ];

        return view('pages.shared.showData', $data);
    }
}
