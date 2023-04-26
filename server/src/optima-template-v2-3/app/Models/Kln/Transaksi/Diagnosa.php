<?php

namespace App\Models\Kln\Transaksi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosa extends Model
{
    use HasFactory;
    protected $table = 'kln_trrawat_diagnosa';
    protected $primaryKey = 'trDiagId';
    protected $fillable = ['compId', 
                        'trDiagMsId',
                        'trDiagRawatId',
                        'trDiagJenis',
                        'trDiagDiagnosa',
                        'trDiagTgl',
                        'trDiagDokterId',
                        'trDiagDokterPpa',
                        'trDiagDokterBersamaId',
                        'trDiagPoli',
                        'trDiagRuangan',
                        'trDiagTarif',
                        'trDiagUser'
                    ];
}
