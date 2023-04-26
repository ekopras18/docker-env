<?php

namespace App\Http\Controllers\Combo\Master;

use App\Http\Controllers\Controllercombo;
use App\Models\User;
use Session;
use DB;
use Illuminate\Http\Request;

class CombousersController extends Controllercombo
{
    public function __construct()
    {
        $this->model = new User();
        $this->combodata = array(
            'id' => 'id',
            'kode' => 'email',
            'nama' => 'name',
        );
    }

    public function index()
    {

        $search = !empty($_GET['search']) ? $_GET['search'] : '%';
        $text = !empty($_GET['text']) ? $_GET['text'] : 1;
        $status_edit = !empty($_GET['status_edit']) ? $_GET['status_edit'] : '';

        if ($text == 1) {
            $text = $this->combodata['nama'] . ' ," - ", ' . $this->combodata['kode'];
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
                    ->where('status_dokter', '=', 1)
                    ->where('compId', '=', Session::get('compId'))
                    ->orderByDesc($this->combodata['id'])
                    ->limit(50)
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
                    ->where('status_dokter', '=', 1)
                    ->where('compId', '=', Session::get('compId'))
                    ->limit(50)
                    ->get();
            }

            return $query;
        }
    }
}
