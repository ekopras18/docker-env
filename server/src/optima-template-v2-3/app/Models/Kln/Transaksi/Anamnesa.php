<?php

namespace App\Models\Kln\Transaksi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anamnesa extends Model
{
    use HasFactory;
    protected $table = 'kln_trrawat_anamnesa';
    protected $primaryKey = 'anamId';
    protected $fillable = ['compId', 
                        'anamRawatId', 
                        'anamAnamnesa',
                        'anamTgl',
                        'anamDokterId',
                        'anamDokterBersamaId',
                        'anamDokterPpa',
                        'anamTarif'
                    ];
}
