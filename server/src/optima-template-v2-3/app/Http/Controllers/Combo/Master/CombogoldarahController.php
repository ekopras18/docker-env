<?php

namespace App\Http\Controllers\Combo\Master;

use App\Http\Controllers\Controllercombo;
use Illuminate\Http\Request;
use App\Models\Master\Goldarah;


class CombogoldarahController extends Controllercombo
{
    public function __construct(){
        $this->model=new Goldarah();
        $this->combodata=array(
                                'id' => 'goldarahId',
                                'kode' => 'goldarahId',
                                'nama' => 'goldarahNama',
                              );
      }
}