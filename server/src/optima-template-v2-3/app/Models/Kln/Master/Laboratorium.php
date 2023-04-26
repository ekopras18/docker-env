<?php

namespace App\Models\Kln\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratorium extends Model
{
    use HasFactory;
    protected $table = 'kln_mslab';
    protected $primaryKey = 'labId';
    protected $fillable = ['compId', 'labKode', 'labPaket', 'labTarif', 'labJs', 'labJp', 'labBhp'];
}
