<?php

namespace App\Models\Kln_apt\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obatdosis extends Model
{
    use HasFactory;
    protected $table = 'kln_apt_msobat_dosis';
    protected $primaryKey = 'dosisId';
    protected $fillable = [
        'compId',
        'dosisNama',
    ];
}
