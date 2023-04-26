<?php

namespace App\Models\Kln\Transaksi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    use HasFactory;
    protected $table = 'kln_trrawat_lab';
    protected $primaryKey = 'trLabId';
    protected $fillable = ['compId', 
                        'trLabRawatId',
                        'trLabKategori',
                        'trLabMsId',
                        'trLabMsNama',
                        'trLabTarif',
                        'trLabTgl',
                        'trLabDokterPpa',
                        'trLabDokterPpaNama',
                        'trLabDokterLuar',
                        'trLabKasir',
                        'trLabFoto',
                    ];
}
