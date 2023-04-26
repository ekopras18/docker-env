<?php

namespace App\Models\Kln_apt\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'kln_apt_msbarang';
    protected $primaryKey = 'brgId';
    protected $fillable = [
        'compId',
        'brgKdPcare',
        'brgKode',
        'brgNama',
        'brgJenis',
        'brgBesar',
        'brgKecil',
        'brgIsiBesar',
        'brgIsiKecil',
        'brgDosisRacik',
        'brgHarga',
        'brgMargin',
        'brgMarginSatuanBesar',
        'brgNarkotik',
        'brgPsikotropika',
        'brgGenerik',
        'brgMorfin',
        'brgFormNas',
        'brgFormRs',
        'brgAlkes',
        'brgObatTertentu',
        'brgObatProgram',
        'brgObatPenjualanBebas',
        'brgGudang',
        'brgReorderPoint',
        'brgStokMinimum',
    ];
}
