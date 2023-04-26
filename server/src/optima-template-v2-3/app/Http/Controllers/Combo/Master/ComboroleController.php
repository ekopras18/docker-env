<?php

namespace App\Http\Controllers\Combo\Master;

use App\Http\Controllers\Controllercombo;
use App\Models\Role;

class ComboroleController extends Controllercombo
{
    public function __construct(){
        $this->model=new Role();
        $this->combodata=array(
                                'id' => 'roleId',
                                'kode' => 'roleId',
                                'nama' => 'roleNama',
                              );
    }       
}
