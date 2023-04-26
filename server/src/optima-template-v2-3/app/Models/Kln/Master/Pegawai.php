<?php

namespace App\Models\Kln\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
    protected $table = 'kln_mspegawai';
    protected $primaryKey = 'pgId';
    protected $fillable = ['compId', 'pgNip', 'pgNama', 'pgPosisiId', 'pgPosisiNama', 'pgKtp', 'pgTempatLahir', 'pgTglLahir', 'pgTglMasuk', 'pgLulusan', 'pgTelp'];
}
