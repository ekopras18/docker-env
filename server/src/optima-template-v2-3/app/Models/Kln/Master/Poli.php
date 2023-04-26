<?php

namespace App\Models\Kln\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    use HasFactory;

    protected $table = 'kln_mspoli';
    protected $primaryKey = 'poliId';
    protected $fillable = ['compId', 'poliNama', 'poliJenis'];
}
