<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regencies extends Model
{
    use HasFactory;

    protected $table = 'msregencies';
    protected $fillable = ['id','provinces_id','name'];


    // Districts
    public function dis()
    {
        return $this->hasMany(Districts::class);
    }

    // Provinces
    public function prov()
    {
        return $this->belongsTo(Provinces::class, 'provinces_id', 'id');
    }

}
