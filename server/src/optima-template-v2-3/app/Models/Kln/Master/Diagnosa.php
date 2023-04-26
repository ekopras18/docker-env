<?php

namespace App\Models\Kln\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosa extends Model
{
    use HasFactory;

    protected $table = 'kln_msdiagnosa';
    protected $primaryKey = 'diagId';
    protected $fillable = ['compId', 'diagKode', 'diagJenis', 'diagNama', 'diagTacc'];
}
