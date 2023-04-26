<?php

namespace App\Models\Kln\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    protected $table = 'kln_msdokter';
    protected $primaryKey = 'dokId';
    protected $fillable = ['compId','dokNama','dokNip','dokAlamat','dokSpesialis','dokPoli','dokLogin','dokJenis'];
}
