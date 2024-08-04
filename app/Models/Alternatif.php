<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;
    protected $table = 'alternatif';

    protected $fillable = [
        'kode_Alternatif',
        'nama',
        'nkk',
        'alamat'
    ];

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class);
    }
    public function normalisasi()
    {
        return $this->hasMany(Normalisasi::class);
    }
    public function jumlah_kali()
    {
        return $this->hasMany(JumlahKali::class);
    }
    public function kali_pangkat()
    {
        return $this->hasMany(KaliPangkat::class);
    }
    public function hasil_spk()
    {
        return $this->hasMany(HasilSpk::class);
    }
    public function penerima()
    {
        return $this->hasMany(Penerima::class);
    }
    public function data_asli()
    {
        return $this->hasMany(DataAsli::class);
    }
}
