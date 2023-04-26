<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Villages extends Model
{
    use HasFactory;
    protected $table = 'msvillages';
    protected $fillable = ['id','districts_id','name'];


    // Districts
    public function dis()
    {
        return $this->belongsTo(Districts::class, 'districts_id', 'id');
    }
}
