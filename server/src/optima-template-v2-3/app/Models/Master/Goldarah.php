<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goldarah extends Model
{
    use HasFactory;

    protected $table = 'msgoldarah';
    protected $primaryKey = 'goldarahId';
    protected $fillable = ['goldarahNama'];
}
