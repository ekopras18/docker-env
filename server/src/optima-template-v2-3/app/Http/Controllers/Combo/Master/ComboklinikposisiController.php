<?php

namespace App\Http\Controllers\Combo\Master;

use App\Http\Controllers\Controllercombo;
use App\Models\Kln\Master\Posisi;
use Illuminate\Http\Request;
use Session;
use DB;

class ComboklinikposisiController extends Controllercombo
{
    public function __construct()
    {
        $this->model = new Posisi();
        $this->combodata = array(
            'id' => 'pId',
            'kode' => 'pId',
            'nama' => 'pNama',
        );
    }

    public function index()
    {

        $search = !empty($_GET['search']) ? $_GET['search'] : '%';
        $text = !empty($_GET['text']) ? $_GET['text'] : 1;
        $status_edit = !empty($_GET['status_edit']) ? $_GET['status_edit'] : '';
        $value = !empty($_GET['value']) ? $_GET['value'] : '';

        if ($text == 1) {
            $text = $this->combodata['kode'] . ' ," - ", ' . $this->combodata['nama'];
        } else if ($text == 2) {
            $text = $this->combodata['nama'];
        }

        if (trim(Session::get('email')) == '') {
            $wallidx = rand(1, 7);
            $data = array(
                'wallidx' => $wallidx,
                'message' => 'Anda telah logout dari system.',
            );
            return view('login', $data);
        } else {

            if ($status_edit == false) {
                if ($value != '') {
                    $query = $this->model::select(
                        $this->combodata['id'] . ' as id',
                        $this->combodata['kode'] . ' as kode',
                        $this->combodata['nama'] . ' as nama',
                        DB::raw('concat(' . $text . ') as text')
                    )
                        ->where(function ($query) use ($search) {
                            $query->where($this->combodata['nama'], 'like', '%' . $search . '%')
                                ->orwhere($this->combodata['kode'], 'like', '%' . $search . '%');
                        })
                        ->limit(50)
                        ->where('pId', '=', $value)
                        ->where('compId', '=', Session::get('compId'))
                        ->orderByDesc($this->combodata['id'])
                        ->get();
                } else {
                    $query = $this->model::select(
                        $this->combodata['id'] . ' as id',
                        $this->combodata['kode'] . ' as kode',
                        $this->combodata['nama'] . ' as nama',
                        DB::raw('concat(' . $text . ') as text')
                    )
                        ->where(function ($query) use ($search) {
                            $query->where($this->combodata['nama'], 'like', '%' . $search . '%')
                                ->orwhere($this->combodata['kode'], 'like', '%' . $search . '%');
                        })
                        ->limit(50)
                        ->where('compId', '=', Session::get('compId'))
                        ->orderByDesc($this->combodata['id'])
                        ->get();
                }
            } else {
                if ($value != '') {
                    $query = $this->model::select(
                        $this->combodata['id'] . ' as id',
                        $this->combodata['kode'] . ' as kode',
                        $this->combodata['nama'] . ' as nama',
                        DB::raw('concat(' . $text . ') as text')
                    )
                        ->where(function ($query) use ($search) {
                            $query->where($this->combodata['id'], '=', $search);
                        })
                        ->limit(50)
                        ->where('pId', '=', $value)
                        ->where('compId', '=', Session::get('compId'))
                        ->get();
                } else {
                    $query = $this->model::select(
                        $this->combodata['id'] . ' as id',
                        $this->combodata['kode'] . ' as kode',
                        $this->combodata['nama'] . ' as nama',
                        DB::raw('concat(' . $text . ') as text')
                    )
                        ->where(function ($query) use ($search) {
                            $query->where($this->combodata['id'], '=', $search);
                        })
                        ->limit(50)
                        ->where('compId', '=', Session::get('compId'))
                        ->get();
                }
            }


            return $query;
        }
    }
}
