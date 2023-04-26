<?php

namespace App\Http\Controllers\Combo\Master;

use App\Http\Controllers\Controllercombo;
use Illuminate\Http\Request;
use App\Models\Kln\Master\Diagnosa;


class ComboklinikdiagnosaController extends Controllercombo
{
  public function __construct()
  {
    $this->model = new Diagnosa();
    $this->combodata = array(
      'id' => 'diagId',
      'kode' => 'diagKode',
      'nama' => 'diagNama',
    );
  }
}
