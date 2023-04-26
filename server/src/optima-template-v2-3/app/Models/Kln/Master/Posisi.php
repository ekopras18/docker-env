<?php

namespace App\Models\Kln\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posisi extends Model
{
    use HasFactory;
    protected $table = 'kln_msposisi';
    protected $primaryKey = 'pId';
    protected $fillable = ['compId', 'pNama'];
}
