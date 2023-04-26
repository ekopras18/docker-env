<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinces extends Model
{
    use HasFactory;
    protected $table = 'msprovinces';
    protected $fillable = ['id','name'];
    
    // Regencies
    public function reg()
    {
        return $this->hasMany(Regencies::class);
    }
}
