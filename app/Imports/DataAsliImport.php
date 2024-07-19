<?php

namespace App\Imports;

use App\Models\DataAsli;
use App\Models\Alternatif;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DataAsliImport implements ToCollection, WithHeadingRow
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
        // Array untuk menyimpan data untuk setiap alternatif
        $dataToInsert = [];

        // Iterasi melalui setiap baris
        foreach ($collection as $row) {

            // Memeriksa dan mencocokkan nama alternatif dari baris saat ini
            $namaAlternatif = $row['nama'];
            $alternatif = Alternatif::where('nama', $namaAlternatif)->first();

            // Jika nama alternatif ditemukan, periksa dan update atau sisipkan data
            if ($alternatif) {
                // Periksa apakah data dengan alternatif dan periode yang sama sudah ada
                $existingData = DataAsli::where('alternatif_id', $alternatif->id)
                    ->whereYear('created_at', $this->periodeYear)
                    ->whereMonth('created_at', $this->periodeMonth)
                    ->first();

                if ($existingData) {
                    // Jika sudah ada, lakukan pembaruan
                    $existingData->update([
                        'status' => $row['status_bansos'], // Menggunakan nama kolom 'Status Bansos'
                    ]);
                } else {
                    // Jika tidak ada, tambahkan data baru
                    $dataToInsert[] = [
                        'alternatif_id' => $alternatif->id,
                        'status' => $row['status_bansos'], // Menggunakan nama kolom 'Status Bansos'
                        'created_at' => Carbon::createFromFormat('Y-m-d', "{$this->periodeYear}-{$this->periodeMonth}-01"), // Gunakan periode yang diberikan
                    ];
                }
            }
        }

        // Menyimpan data ke dalam tabel data_asli
        DataAsli::insert($dataToInsert);

        // Jika nama alternatif tidak ditemukan, lewati data ini
        return null;
    }
}
