<?php

namespace App\Http\Controllers\Combo\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kln_apt\Master\Barang;
use DB;
use Session;

class ComboklinikaptbarangController extends Controller
{
    public function __construct()
    {
        $this->model = new Barang();
        $this->combodata = array(
            'id' => 'brgId',
            'kode' => 'brgKode',
            'nama' => 'brgNama',
            'field1' => 'brgKecil',
            'field2' => 'brgHarga',
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
                $this->combodata['field1'] . ' as satuankecil',
                $this->combodata['field2'] . ' as harga',
                DB::raw('concat(' . $text . ') as text')
            )
                ->where(function ($query) use ($search) {
                    $query->where($this->combodata['nama'], 'like', '%' . $search . '%')
                        ->orwhere($this->combodata['kode'], 'like', '%' . $search . '%');
                })
                ->limit(50)
                // ->where('compId', '=',Session::get('compId'))
                ->orderByDesc($this->combodata['id'])
                ->get();

            return $query;
        }
    }
}
