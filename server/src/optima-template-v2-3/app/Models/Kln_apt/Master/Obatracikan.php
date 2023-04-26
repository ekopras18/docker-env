<?php

namespace App\Models\Kln_apt\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obatracikan extends Model
{
    use HasFactory;
    protected $table = 'kln_apt_msobat_racikan';
    protected $primaryKey = 'racikanId';
    protected $fillable = [
        'compId',
        'racikanNama',
    ];
}
