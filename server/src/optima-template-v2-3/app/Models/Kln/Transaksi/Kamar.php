<?php

namespace App\Models\Kln\Transaksi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;
    protected $table = 'kln_trrawat_kamar';
    protected $primaryKey = 'trkId';
    protected $fillable = ['compId', 
                        'trkRawatId',
                        'trkKamarId',
                        'trkKamarNama',
                        'trkTglAwal',
                        'trkTglAkhir',
                        'trkJumHari',
                        'trkTarif',
                        'trkTotal',
                    ];
}
