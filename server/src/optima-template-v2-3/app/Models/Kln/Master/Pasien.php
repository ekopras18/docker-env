<?php

namespace App\Models\Kln\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'kln_mspasien';
    protected $primaryKey = 'msPasId';
    protected $fillable = [
        'compId',
        'msPasRm',
        'msPasAsuransi',
        'msPasKtp',
        'msPasNama',
        'msPasTempatLahir',
        'msPasLahir',
        'msPasKelId',
		'msPasKelName',
		'msPasKecId',
		'msPasKecName',
		'msPasKabId',
		'msPasKabName',
		'msPasProvId',
		'msPasProvName',
        'msPasTlp',
        'msPasGender',
        'msPasStatusKawin',
        'msPasUmur',
        'msPasAlamat'
    ];
}
