<?php

namespace App\Http\Controllers\Combo\Master;

use App\Http\Controllers\Controllercombo;
use App\Models\Menu;

class ComboparentController extends Controllercombo
{
    public function __construct(){
        $this->model=new Menu();
        $this->combodata=array(
                                'id' => 'menuId',
                                'kode' => 'menuId',
                                'nama' => 'menuNama',
                              );
    }
}
