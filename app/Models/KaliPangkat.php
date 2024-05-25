<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KaliPangkat extends Model
{
    use HasFactory;
    protected $table = 'kali_pangkat';

    protected $fillable = [
        'alternatif_id',
        'nilai'
    ];

    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class, 'alternatif_id');
    }
}
