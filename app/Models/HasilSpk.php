<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilSpk extends Model
{
    use HasFactory;
    protected $table = 'hasil_spk';

    protected $fillable = [
        'alternatif_id',
        'nilai'
    ];

    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class, 'alternatif_id');
    }
}
