<?php

namespace App\Models\Kln\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jaminan extends Model
{
    use HasFactory;

    protected $table = 'kln_msjaminan';
    protected $primaryKey = 'jId';
    protected $fillable = ['compId', 'jNama','jMetodeBayar'];

}
