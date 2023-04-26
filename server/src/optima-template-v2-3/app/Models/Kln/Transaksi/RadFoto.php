<?php

namespace App\Models\Kln\Transaksi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Radfoto extends Model
{
    use HasFactory;
    protected $table = 'kln_trrawat_radiology_foto';
    protected $primaryKey = 'trRadId';
    protected $fillable = [
        'compId',
        'trRadRawatId',
        'trRadKategori',
        'trRadMsId',
        'trRadMsNama',
        'trRadTarif',
        'trRadTgl',
        'trRadDokterPpa',
        'trRadDokterPpaNama',
        'trRadDokterLuar',
        'trRadKasir',
        'trRadFoto',
    ];
}
