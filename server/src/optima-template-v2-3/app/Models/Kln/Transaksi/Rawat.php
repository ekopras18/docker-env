<?php

namespace App\Models\Kln\Transaksi;

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
        'rawatDokterRekId',
        'rawatDokterRekNama',
        'rawatPenRajal',
        'rawatPenIgd',
        'rawatPoli',
        'rawatLab',
        'rawatRad',
        'rawatFisio',
        'rawatRuangan',
        'rawatUrutDaftar',
        'rawatGolDarah',
        'rawatTekDarah',
        'rawatLingkarPerut',
        'rawatImt',
        'rawatSistole',
        'rawatDiastole',
        'rawatRespRate',
        'rawatHeartRate',
        'rawatSadarId',
        'rawatSadarNama',
        'rawatSuhu',
        'rawatNadi',
        'rawatSpo2',
        'rawatTinggi',
        'rawatBerat',
        'rawatUrutPcare',
        'rawatKdProvider',
        'rawatDokterPcare',
        'rawatKunjunganPcare',
        'rawatNoRujukanPcare',
        'rawatAsalRujukan',
        'rawatNoRujukan',
        'rawatTglRujukan',
        'rawatBaru',
        'rawatStatusClosing',
        'rawatTg',
        'rawatTgHub',
        'rawatCreateUser'
    ];
}
