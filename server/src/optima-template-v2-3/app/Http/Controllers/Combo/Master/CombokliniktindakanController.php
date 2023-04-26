<?php

namespace App\Http\Controllers\Combo\Master;

use App\Http\Controllers\Controllercombo;
use Illuminate\Http\Request;
use App\Models\Kln\Master\Tindakan;
use Session;


class CombokliniktindakanController extends Controllercombo
{
    public function __construct()
    {
        $this->model = new Tindakan();
        $this->combodata = array(
            'id' => 'tindId',
            'kode' => 'tindKode',
            'nama' => 'tindNama',
            'field1' => 'tindTarif',
            'field2' => 'tindJenis',
        );
    }

    public function index()
    {

        $search = !empty($_GET['search']) ? $_GET['search'] : '%';
        $text = !empty($_GET['text']) ? $_GET['text'] : 1;

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

            $query = $this->model::select(
                $this->combodata['id'] . ' as id',
                $this->combodata['kode'] . ' as kode',
                $this->combodata['nama'] . ' as nama',
                $this->combodata['field1'] . ' as tarif',
                $this->combodata['field2'] . ' as jenis'
                // DB::raw('concat('.$text.') as text')
            )
                ->where(function ($query) use ($search) {
                    $query->where($this->combodata['nama'], 'like', '%' . $search . '%')
                        ->orwhere($this->combodata['kode'], 'like', '%' . $search . '%');
                })
                ->limit(50)
                ->where('compId', '=', Session::get('compId'))
                ->orderByDesc($this->combodata['id'])
                ->get();
            foreach ($query as $key => $value) {
                $query[$key]->text = $value->kode . ' - ' . $value->nama . ' - ' . number_format($value->tarif, 2);
            }

            return $query;
        }
    }
}
