<?php

namespace App\Models\Kln_apt\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obatwaktu extends Model
{
    use HasFactory;
    protected $table = 'kln_apt_msobat_waktu';
    protected $primaryKey = 'waktuId';
    protected $fillable = [
        'compId',
        'waktuNama',
    ];
}
