<?php

namespace App\Http\Controllers\Combo\Master;

use App\Http\Controllers\Controllercombo;
use App\Models\Kln\Master\Kesadaran;
use Illuminate\Http\Request;

class ComboklinikkesadaranController extends Controllercombo
{
    public function __construct()
    {
        $this->model = new Kesadaran();
        $this->combodata = array(
            'id' => 'kId',
            'kode' => 'kId',
            'nama' => 'kNama',
        );
    }
}
