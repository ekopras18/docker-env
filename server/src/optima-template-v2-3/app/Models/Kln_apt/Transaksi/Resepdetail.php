<?php

namespace App\Models\Kln_apt\Transaksi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resepdetail extends Model
{
    use HasFactory;
    protected $table = 'kln_apt_trresepdetail';
    protected $primaryKey = 'resepDetId';
    protected $fillable = [
        'compId',
        'resepDetRawatId',
        'resepDetTgl',
        'resepDetNoTrans',
        'resepDetNo',
        'resepDetKode',
        'resepDetNama',
        'resepDetSatuan',
        'resepDetHarga',
        'resepDetJumlah',
        'resepDetKeterangan',
        'resepDetRacikan',
        'resepDetDosis',
        'resepDetWaktu',
        'resepDetAturan',
        'resepDetQty'
    ];
}
