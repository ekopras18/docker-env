<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controllermaster;
use App\Models\Master\Provinces;
use App\Models\Master\Regencies;
use App\Models\Master\Districts;
use App\Models\Master\Villages;
use Illuminate\Http\Request;
use Session;
use Validator;

class AlamatController extends Controllermaster
{
    public function __construct()
    {
        $this->compId = Session::get('compId');
        $this->compNama = Session::get('compNama');
        $this->model_prov = new Provinces;
        $this->model_kab = new Regencies;
        $this->model_kec = new Districts;
        $this->model_kel = new Villages;
        $this->primaryKey = 'id';
        $this->mainroute = 'alamat';
        $this->mandatory = array(
            'id' => 'required',
            'name' => 'required',
        );

        $this->grid_prov = array(
            array(
                'label' => 'ID PROVINSI',
                'field' => 'id',
                'type' => 'text',
                'width' => '15%'
            ),
            array(
                'label' => 'NAMA',
                'field' => 'name',
                'type' => 'text',
                'width' => ''
            ),
        );

        $this->grid_kab = array(
            array(
                'label' => 'ID PROVINSI',
                'field' => 'provinces_id',
                'type' => 'text',
                'width' => '15%'
            ),
            array(
                'label' => 'ID KABUPATEN',
                'field' => 'id',
                'type' => 'text',
                'width' => '15%'
            ),
            array(
                'label' => 'NAMA',
                'field' => 'name',
                'type' => 'text',
                'width' => ''
            ),
        );

        $this->grid_kec = array(
            array(
                'label' => 'ID KABUPATEN',
                'field' => 'regencies_id',
                'type' => 'text',
                'width' => '15%'
            ),
            array(
                'label' => 'ID KECAMATAN',
                'field' => 'id',
                'type' => 'text',
                'width' => '15%'
            ),
            array(
                'label' => 'NAMA',
                'field' => 'name',
                'type' => 'text',
                'width' => ''
            ),
        );

        $this->grid_kel = array(
            array(
                'label' => 'ID KECAMATAN',
                'field' => 'districts_id',
                'type' => 'text',
                'width' => '15%'
            ),
            array(
                'label' => 'ID KELURAHAN',
                'field' => 'id',
                'type' => 'text',
                'width' => '15%'
            ),
            array(
                'label' => 'NAMA',
                'field' => 'name',
                'type' => 'text',
                'width' => ''
            ),
        );

        $this->form_prov = array(
            array(
                'label' => 'ID PROVINSI',
                'field' => 'id',
                'type' => 'number',
                'placeholder' => 'Masukkan ID Provinsi',
                'keterangan' => '* Wajib Diisi'
            ),
            array(
                'label' => 'NAMA',
                'field' => 'name',
                'type' => 'text',
                'placeholder' => 'Masukkan Nama Provinsi',
                'keterangan' => '* Wajib Diisi'
            ),
        );

        $this->form_kab = array(
			array(
				'label' => 'ID PROVINSI',
				'field' => 'provinces_id',
				'setfield' => 'id_kab',
				'type' => 'autocomplete',
				'text' => 1,
				'url' => 'comboprovinsi',
				'default' => 'Pilih Provinsi',
				'keterangan' => '* Wajib Diisi'
			),
            array(
                'label' => 'ID KABUPATEN',
                'field' => 'id',
                'type' => 'number',
                'placeholder' => 'Masukkan ID Kabupaten',
                'keterangan' => '* Wajib Diisi'
            ),
            array(
                'label' => 'NAMA',
                'field' => 'name',
                'type' => 'text',
                'placeholder' => 'Masukkan Nama Kabupaten',
                'keterangan' => '* Wajib Diisi'
            ),
        );

        $this->form_kec = array(
			array(
				'label' => 'ID KABUPATEN',
				'field' => 'regencies_id',
				'setfield' => 'id_kec',
				'type' => 'autocomplete',
				'text' => 1,
				'url' => 'combokabupaten',
				'default' => 'Pilih Kabupaten',
				'keterangan' => '* Wajib Diisi'
			),
            array(
                'label' => 'ID KECAMATAN',
                'field' => 'id',
                'type' => 'number',
                'placeholder' => 'Masukkan ID Kecamatan',
                'keterangan' => '* Wajib Diisi'
            ),
            array(
                'label' => 'NAMA',
                'field' => 'name',
                'type' => 'text',
                'placeholder' => 'Masukkan Nama Kecamatan',
                'keterangan' => '* Wajib Diisi'
            ),
        );

        $this->form_kel = array(
			array(
				'label' => 'ID KECAMATAN',
				'field' => 'districts_id',
				'setfield' => 'id_kel',
				'type' => 'autocomplete',
				'text' => 1,
				'url' => 'combokecamatan',
				'default' => 'Pilih Kecamatan',
				'keterangan' => '* Wajib Diisi'
			),
            array(
                'label' => 'ID KELURAHAN',
                'field' => 'id',
                'type' => 'number',
                'placeholder' => 'Masukkan ID Kelurahan',
                'keterangan' => '* Wajib Diisi'
            ),
            array(
                'label' => 'NAMA',
                'field' => 'name',
                'type' => 'text',
                'placeholder' => 'Masukkan Nama Kelurahan',
                'keterangan' => '* Wajib Diisi'
            ),
        );
    }

    public function index()
    {
        if (trim(Session::get('email')) == '' or $this->checkRouteAuth() == 2) {
            $wallidx = rand(1, 7);
            $data = array(
                'wallidx' => $wallidx,
                'message' => 'Anda telah logout dari system.',
            );
            return view('login', $data);
        } else {
            $search = !empty($_GET['search']) ? $_GET['search'] : '';
            if ($search == '') {
                $listdata_prov = $this->model_prov->paginate(15);
                $listdata_kab = $this->model_kab->paginate(15);
                $listdata_kec = $this->model_kec->paginate(15);
                $listdata_kel = $this->model_kel->paginate(15);
            } else {
                $listdata_prov = $this->model_prov
                    ->where('name', 'like', '%' . $search . '%')
                    ->orwhere('id', 'like', '%' . $search . '%')
                    ->paginate(15);

                $listdata_kab = $this->model_kab
                    ->where('name', 'like', '%' . $search . '%')
                    ->orwhere('id', 'like', '%' . $search . '%')
                    ->paginate(15);

                $listdata_kec = $this->model_kec
                    ->where('name', 'like', '%' . $search . '%')
                    ->orwhere('id', 'like', '%' . $search . '%')
                    ->paginate(15);

                $listdata_kel = $this->model_kel
                    ->where('name', 'like', '%' . $search . '%')
                    ->orwhere('id', 'like', '%' . $search . '%')
                    ->paginate(15);
            }

            $data = array(
                'authmenu' => $this->getusermenu(),
                'company' => Session::get('compNama'),
                'logo' => Session::get('compLogo'),
                'detail' => Session::get('compDetail'),
                'name' => Session::get('name'),
                'namelong' => Session::get('email'),
                'search' => $search,
                'page_tittle' => 'Master Alamat',
                'page_active' => 'Master Alamat',
                'grid_prov' => $this->grid_prov,
                'grid_kab' => $this->grid_kab,
                'grid_kec' => $this->grid_kec,
                'grid_kel' => $this->grid_kel,
                'form_prov' => $this->form_prov,
                'form_kab' => $this->form_kab,
                'form_kec' => $this->form_kec,
                'form_kel' => $this->form_kel,
                'listdata_prov' => $listdata_prov,
                'listdata_kab' => $listdata_kab,
                'listdata_kec' => $listdata_kec,
                'listdata_kel' => $listdata_kel,
                'primaryKey' => $this->primaryKey,
                'mainroute' => $this->mainroute,
                'compId' => $this->compId,
                'code' => 0,
            );

            return view('Master.alamat', $data)->with('data', $data);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->mandatory); // $this->mainroute

        if ($validator->fails()) {
            $messages = [
                'data' => $validator->errors()->first(),
                'status' => 401,
            ];
            return response()->json($messages);
        }

        $resultdata = eval('return $this->' . $request->model . '->create($request->all());');

        $this->addSysLog(eval('return $this->' . $request->model . '->getTable();'), 'create_' . $request->model, json_encode($resultdata));
        return $resultdata;
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), $this->mandatory);
        if ($validator->fails()) {
            $messages = [
                'data' => $validator->errors(),
                'status' => 401,
            ];
            return response()->json($messages);
        }

        $resultdata = eval('return $this->' . $request->model . '->find('.$id.')->update($request->all());');

        $this->addSysLog(eval('return $this->' . $request->model . '->getTable();'), 'update_' . $request->model, json_encode($resultdata));
        return $resultdata;
    }

    public function destroy(Request $request, $id)
    {
        $data = eval('return $this->' . $request->model . '->find(' . $id . ');');

        eval('return $this->' . $request->model . '->find(' . $id . ')->delete();');

        $this->addSysLog(eval('return $this->' . $request->model . '->getTable();'), 'delete_' . $request->model, json_encode($data));
        return response()->json('data deleted successfully');
    }
}
