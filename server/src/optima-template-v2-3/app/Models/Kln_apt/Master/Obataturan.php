<?php

namespace App\Models\Kln_apt\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obataturan extends Model
{
    use HasFactory;
    protected $table = 'kln_apt_msobat_aturan';
    protected $primaryKey = 'aturanId';
    protected $fillable = [
        'compId',
        'aturanNama',
    ];
}
