<?php

namespace App\Models\Kln\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kesadaran extends Model
{
    use HasFactory;
    protected $table = 'kln_mskesadaran';
    protected $primaryKey = 'kId';
    protected $fillable = [
        'compId',
        'kNama'
    ];
}
