<?php

namespace App\Models\Kln\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Radiologi extends Model
{
    use HasFactory;
    protected $table = 'kln_msradiologi';
    protected $primaryKey = 'radId';
    protected $fillable = ['compId', 'radNama', 'radTarif'];
}
