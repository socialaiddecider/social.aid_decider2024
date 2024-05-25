<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JumlahKali extends Model
{
    use HasFactory;
    protected $table = 'jumlah_kali';

    protected $fillable = [
        'alternatif_id',
        'nilai'
    ];

    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class, 'alternatif_id');
    }
}
