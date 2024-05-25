<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataAsli extends Model
{
    use HasFactory;
    protected $table = 'data_asli';

    protected $fillable = [
        'alternatif_id',
        'status',
        'created_at'
    ];

    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class, 'alternatif_id');
    }
}
