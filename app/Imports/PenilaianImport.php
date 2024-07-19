<?php

namespace App\Imports;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PenilaianImport implements ToCollection, WithHeadingRow
{
    protected $periodeYear;
    protected $periodeMonth;



    public function __construct(Carbon $periodeDate)
    {
        $this->periodeYear = $periodeDate->year;
        $this->periodeMonth = $periodeDate->month;
    }
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            $namaAlternatif = $row['nama']; // Sesuaikan dengan nama kolom dalam file Excel
            $alternatif = Alternatif::where('nama', $namaAlternatif)->first();

            if ($alternatif) {
                $kriteriaList = Kriteria::with('subkriteria')->get();

                foreach ($kriteriaList as $kriteria) {
                    $namaKriteria = strtolower(str_replace(' ', '_', $kriteria->nama)); // Ubah spasi menjadi underscore dan ubah menjadi lowercase
                    $value = $row[$namaKriteria];

                    // Pastikan $value tidak kosong sebelum digunakan
                    if (!is_null($value)) {
                        $existingPenilaian = Penilaian::where('alternatif_id', $alternatif->id)
                            ->where('kriteria_id', $kriteria->id)
                            ->whereYear('created_at', $this->periodeYear)
                            ->whereMonth('created_at', $this->periodeMonth)
                            ->first();

                        if ($existingPenilaian) {
                            // Jika sudah ada, lakukan pembaruan
                            $existingPenilaian->update([
                                'nilai' => $value,
                            ]);
                        } else {
                            // Jika tidak ada, tambahkan data baru
                            Penilaian::create([
                                'alternatif_id' => $alternatif->id,
                                'kriteria_id' => $kriteria->id,
                                'nilai' => $value,
                                'created_at' => Carbon::createFromDate($this->periodeYear, $this->periodeMonth, 1), // Gunakan periode yang diberikan
                            ]);
                        }
                    }
                }
            }
        }
    }
}
