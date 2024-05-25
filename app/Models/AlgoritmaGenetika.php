<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlgoritmaGenetika extends Model
{
    use HasFactory;
    protected $table = 'algoritma_genetika';

    protected $fillable = [
        'iterasi',
        'popsize',
        'cr',
        'mr',
        'jumlah_penerima'
    ];
}
