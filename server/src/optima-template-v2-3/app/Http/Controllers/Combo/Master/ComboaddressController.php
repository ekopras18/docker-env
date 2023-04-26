<?php

namespace App\Http\Controllers\Combo\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\Villages;
use Illuminate\Support\Facades\Session;

class ComboaddressController extends Controller
{
    public function __construct()
    {
      $this->model = new Villages();
      $this->combodata = array(
        'name' => 'name',
        'field1' => 'newPasKecId',
        'field2' => 'newPasKabId',
        'field3' => 'newPasProvId',
      );
    }

    public function index()
    {

        $search = !empty($_GET['search']) ? $_GET['search'] : '%';

        if (trim(Session::get('email')) == '') {
            $wallidx = rand(1, 7);
            $data = array(
              'wallidx' => $wallidx,
              'message' => 'Anda telah logout dari system.',
            );
            return view('login', $data);
          } else {

              $query = $this->model->where(function ($query) use ($search) {
                $query->where($this->combodata['name'], 'like', '%' . $search . '%');
              })
              ->limit(50)
              ->get();
              foreach($query as $value){
                $value->village_id = $value->id;
                $value->village = $value->name;
                $value->district_id = $value->dis->id;
                $value->district = $value->dis->name;
                $value->regency_id = $value->dis->reg->id;
                $value->regency = $value->dis->reg->name;
                $value->province_id = $value->dis->reg->prov->id;
                $value->province = $value->dis->reg->prov->name;
                $value->text = $value->name . " - ". $value->dis->name ." - ". $value->dis->reg->name ." - " .  $value->dis->reg->prov->name;
                $value->field = array(
                  $this->combodata['field1'],
                  $this->combodata['field2'],
                  $this->combodata['field3'],
                );
              }

            return response()->json($query);
        }

    }
}
