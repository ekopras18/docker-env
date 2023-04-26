<?php

namespace App\Http\Controllers\Combo\Master;

use App\Http\Controllers\Controller;
use App\Models\Kln\Master\Tujuanpindah;
use App\Http\Controllers\Controllercombo;
use Illuminate\Http\Request;

class Combokliniktujuanpindah extends Controllercombo
{
	public function __construct()
	{
		$this->model = new Tujuanpindah();
		$this->combodata = array(
			'id' => 'tujuanId',
			'kode' => 'tujuanId',
			'nama' => 'tujuanNama',
		);
	}
}
