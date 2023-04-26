<?php

namespace App\Http\Controllers\Combo\Master;

use App\Http\Controllers\Controllercombo;
use Illuminate\Http\Request;
use App\Models\Kln\Master\Ruangan;
use Session;
use DB;

class ComboklinikpolikeluarrajalController extends Controllercombo
{
    public function __construct()
  {
    $this->model = new Ruangan();
    $this->combodata = array(
      'id' => 'rId',
      'kode' => 'rKode',
      'nama' => 'rNama',
    );
  }

  public function index()
  {

    $search = !empty($_GET['search']) ? $_GET['search'] : '%';
    $text = !empty($_GET['text']) ? $_GET['text'] : 1;
    $status_edit = !empty($_GET['status_edit']) ? $_GET['status_edit'] : '';

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
          ->where('rJenisId', 1) // atau set manual 1 = poli rawat jalan
          ->where('compId', '=', Session::get('compId'))
          ->limit(50)
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
            $query->where($this->combodata['id'], '=', $search);
          })
          ->where('rJenisId', 1) // atau set manual 1 = poli rawat jalan
          ->where('compId', '=', Session::get('compId'))
          ->limit(50)
          ->orderByDesc($this->combodata['id'])
          ->get();
      }

      return $query;
    }
  }
}
