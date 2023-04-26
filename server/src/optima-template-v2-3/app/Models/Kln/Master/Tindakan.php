<?php

namespace App\Models\Kln\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tindakan extends Model
{
    use HasFactory;

    protected $table = 'kln_mstindakan';
    protected $primaryKey = 'tindId';
    protected $fillable = ['compId',
     'tindKode',
     'tindJenis',
     'tindNama',
     'tindTarif',
     'tindJs',
     'tindJp',
     'tindBhp'
    ];
}
