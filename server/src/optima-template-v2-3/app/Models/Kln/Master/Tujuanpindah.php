<?php

namespace App\Models\Kln\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tujuanpindah extends Model
{
    use HasFactory;

    protected $table = 'kln_mstujuanpindah';
    protected $primaryKey = 'tujuanId';
    protected $fillable = ['compId','tujuanNama'];
}
