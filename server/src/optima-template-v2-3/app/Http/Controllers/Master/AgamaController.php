<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controllermaster;
use App\Models\Master\Agama;
use Session;
use Illuminate\Http\Request;

class AgamaController extends Controllermaster
{
    public function __construct()
    {
        $this->compId = Session::get('compId');
        $this->compNama = Session::get('compNama');
        $this->model = new Agama;
        $this->primaryKey = 'agamaId';
        $this->mainroute = 'omd-msagama';
        $this->mandatory = array(
            'compId' => 'required',
            'agamaNama' => 'required',
        );

        $this->grid = array(
            array(
                'label' => 'ID',
                'field' => 'agamaId',
                'type' => 'text',
                'width' => '5%'
            ),
            array(
                'label' => 'NAMA',
                'field' => 'agamaNama',
                'type' => 'text',
                'width' => ''
            ),
        );

        $this->form = array(
            array(
                'label' => 'NAMA AGAMA',
                'field' => 'agamaNama',
                'type' => 'text',
                'placeholder' => 'Masukan Nama Agama',
                'keterangan' => '* Wajib diisi'
            ),
        );
    }

    public function index()
    {
        if (trim(Session::get('email')) == '' or $this->checkRouteAuth() == 3) {
            $wallidx = rand(1, 7);
            $data = array(
                'wallidx' => $wallidx,
                'message' => 'Anda telah logout dari system.',
            );
            return view('login', $data);
        } else {
            $search = !empty($_GET['search']) ? $_GET['search'] : '';
            if ($search == '') {
                $listdata = $this->model
                    ->paginate(15);
            } else {
                $listdata = $this->model
                    ->where('agamaNama', 'like', '%' . $search . '%')
                    ->paginate(15);
            }


            $data = array(
                'authmenu' => $this->getusermenu(),
                'company' => $this->compNama,
                'logo' => Session::get('compLogo'),
                'detail' => Session::get('compDetail'),
                'name' => Session::get('name'),
                'namelong' => Session::get('email'),
                'search' => $search,
                'page_tittle' => 'Master Agama',
                'page_active' => 'Master Agama',
                'grid' => $this->grid,
                'form' => $this->form,
                'listdata' => $listdata,
                'primaryKey' => $this->primaryKey,
                'mainroute' => $this->mainroute,
                'compId' => $this->compId,
                'code' => 0,
            );

            return view('Omd.Master.master', $data)->with('data', $data);
        }
    }
}
