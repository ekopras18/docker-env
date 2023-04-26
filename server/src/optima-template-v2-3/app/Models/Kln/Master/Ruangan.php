<?php

namespace App\Models\Kln\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;
    protected $table = 'kln_msruangan';
    protected $primaryKey = 'rId';
    protected $fillable = ['compId', 'rPcareKd', 'rKode', 'rNama', 'rJenisId', 'rJenisNama','rTarif'];
}
