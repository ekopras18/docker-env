<?php

namespace App\Models\Kln\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenispelayanan extends Model
{
    use HasFactory;

    protected $table = 'kln_msjenispelayanan';
    protected $primaryKey = 'jpId';
    protected $fillable = ['compId','jpKode','jpNama'];
}
