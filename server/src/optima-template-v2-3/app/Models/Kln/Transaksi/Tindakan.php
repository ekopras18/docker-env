<?php

namespace App\Models\Kln\Transaksi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tindakan extends Model
{
    use HasFactory;
    protected $table = 'kln_trrawat_tindakan';
    protected $primaryKey = 'trTindId';
    protected $fillable = ['compId', 
                        'trTindMsId',
                        'trTindRawatId',
                        'trTindJenis',
                        'trTindKategori',
                        'trTindTindakan',
                        'trTindKeterangan',
                        'trTindHasil',
                        'trTindTgl',
                        'trTindCito',
                        'trTindDokterId',
                        'trTindDokterPpa',
                        'trTindDokterBersamaId',
                        'trTindPemberiDok',
                        'trTindPerawatId',
                        'trTindPoli',
                        'trTindPoliNama',
                        'trTindRuangan',
                        'trTindRuanganNama',
                        'trTindTarif',
                        'trTindUser'
                    ];
}
