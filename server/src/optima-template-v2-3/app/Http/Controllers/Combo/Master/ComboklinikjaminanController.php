<?php

namespace App\Http\Controllers\Combo\Master;

use App\Http\Controllers\Controllercombo;
use App\Models\Kln\Master\Jaminan;
use Illuminate\Http\Request;

class ComboklinikjaminanController extends Controllercombo
{
    public function __construct()
    {
        $this->model = new Jaminan();
        $this->combodata = array(
            'id' => 'jId',
            'kode' => 'jId',
            'nama' => 'jNama',
        );
    }
}
