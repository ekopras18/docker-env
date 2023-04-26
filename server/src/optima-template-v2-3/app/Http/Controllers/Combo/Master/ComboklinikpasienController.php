<?php

namespace App\Http\Controllers\Combo\Master;

use App\Http\Controllers\Controllercombopasien;
use Illuminate\Http\Request;
use App\Models\Kln\Master\Pasien;

class ComboklinikpasienController extends Controllercombopasien
{
  public function __construct()
  {
    $this->model = new Pasien();
    $this->combodata = array(
      'id' => 'msPasId',
      'kode' => 'msPasRm',
      'nama' => 'msPasNama',
      'alamat' => 'msPasAlamat',
      'tgllahir' => 'msPasLahir',
      'umur' => 'msPasUmur',
      'kelamin' => 'msPasGender',
      'telepon' => 'msPasTlp',
    );
  }
}
