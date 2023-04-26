<?php

namespace App\Models\Kln\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenisruangan extends Model
{
    use HasFactory;
    protected $table = 'kln_msjenis_ruangan';
    protected $primaryKey = 'jId';
    protected $fillable = ['compId', 'jNama'];
}
