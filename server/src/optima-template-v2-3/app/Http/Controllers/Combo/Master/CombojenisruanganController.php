<?php

namespace App\Http\Controllers\Combo\Master;

use App\Http\Controllers\Controllercombo;
use App\Models\Kln\Master\Jenisruangan;
use Illuminate\Http\Request;

class CombojenisruanganController extends Controllercombo
{
    public function __construct()
    {
        $this->model = new Jenisruangan();
        $this->combodata = array(
            'id' => 'jId',
            'kode' => 'jId',
            'nama' => 'jNama',
        );
    }
}
