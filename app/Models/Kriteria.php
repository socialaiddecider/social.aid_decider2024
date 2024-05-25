<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $table = 'kriteria';

    protected $fillable = [
        'kode_kriteria',
        'nama',
        'jenis'
    ];

    public function subkriteria()
    {
        return $this->hasMany(Subkriteria::class);
    }
    public function penilaian()
    {
        return $this->hasMany(Penilaian::class);
    }
    public function normalisasi()
    {
        return $this->hasMany(Normalisasi::class);
    }
    public function bobot()
    {
        return $this->hasOne(Bobot::class);
    }
}
