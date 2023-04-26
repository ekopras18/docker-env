<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Districts extends Model
{
    use HasFactory;
    protected $table = 'msdistricts';
    protected $fillable = ['id','regencies_id','name'];

    // villages
    public function vil()
    {
        return $this->hasMany(Villages::class);
    }

    // Regencies
    public function reg()
    {
        return $this->belongsTo(Regencies::class, 'regencies_id', 'id');
    }

}
