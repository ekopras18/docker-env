<?php

namespace App\Models\Kln_apt\Transaksi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    use HasFactory;
    protected $table = 'kln_apt_trresep';
    protected $primaryKey = 'resepId';
    protected $fillable = [
        'compId',
        'resepRawatId',
        'resepNoTrans',
        'resepNo',
        'resepRm',
        'resepNamaPasien',
        'resepGender',
        'resepTglLahir',
        'resepAlamat',
        'resepAsuransi',
        'resepNoAsuransi',
        'resepRuang',
        'resepDokterId',
        'resepDokter',
        'resepTgl',
        'resepTotalHarga',
        'resepStatus',
        'resepRc1',
        'resepRc2',
        'resepRc3',
        'resepRc4',
    ];
}
