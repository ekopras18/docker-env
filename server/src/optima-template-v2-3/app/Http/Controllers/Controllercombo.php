<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Validator;
use Session;
use Illuminate\Support\Facades\Route;
use DB;
use App\Models\Menu;

class Controllercombo extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

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
                    ->limit(50)
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
                        $query->where($this->combodata['id'], '=', $search);
                    })
                    ->limit(50)
                    ->where('compId', '=', Session::get('compId'))
                    ->get();
            }


            return $query;
        }
    }


    public function checkRouteAuth()
    {

        $routename = Route::currentRouteName();
        $routename = str_replace(".index", "", $routename);

        $role = Session::get('role');
        $menu = new Menu();
        $result = $menu
            ->leftjoin('role_menu', 'role_menu.rmMenuId', '=', 'menu.menuId')
            ->where('menu.menuRoute', '=', $routename)
            ->where('role_menu.rmRoleId', '=', $role)
            ->get();

        if (count($result) > 0) {
            return 1;
        } else {
            return 2;
        }
    }
}
