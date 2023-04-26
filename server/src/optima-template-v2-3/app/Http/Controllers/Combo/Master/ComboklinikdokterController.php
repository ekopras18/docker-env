<?php

namespace App\Http\Controllers\Combo\Master;

use App\Http\Controllers\Controllercombo;
use Illuminate\Http\Request;
use App\Models\Kln\Master\Dokter;


class ComboklinikdokterController extends Controllercombo
{
    public function __construct(){
        $this->model=new Dokter();
        $this->combodata=array(
                                'id' => 'dokId',
                                'kode' => 'dokId',
                                'nama' => 'dokNama',
                              );
      }
}
