<?php

namespace App\Models\Kln\Pendaftaran;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rawat extends Model
{
    use HasFactory;

    protected $table = 'kln_trrawat';
    protected $primaryKey = 'rawatId';
    protected $fillable = [
        'compId',
        'rawatPasId',
        'rawatPasNama',
        'rawatPasRm',
        'rawatPasUmur',
        'rawatStatusfisio',
        'rawatStatuslab',
        'rawatStatusrad',
        'rawatStatuspoli',
        'rawatTglDaftar',
        'rawatJenisMasuk',
        'rawatJenis',
        'rawatJaminanId',
        'rawatJaminanNama',
        'rawatDokterId',
        'rawatDokterNama',
        'rawatPenRajal',
        'rawatPenIgd',
        'rawatPoli',
        'rawatLab',
        'rawatRad',
        'rawatFisio',
        'rawatUrutDaftar',
        'rawatRuanganId',
        'rawatRuanganNama',
        'rawatAsalRujukan',
        'rawatNoRujukan',
        'rawatTglRujukan',
        'rawatStatusClosing',
        'rawatTg',
        'rawatTgHub',
        'rawatCreateUser'
    ];
}
