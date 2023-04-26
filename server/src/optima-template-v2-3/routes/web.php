<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::resource('/', App\Http\Controllers\MainController::class);
Route::resource('dashboard', App\Http\Controllers\DashboardController::class);
// Route::get('getdashboarddata', [App\Http\Controllers\DashboarddataController::class,'index']);
// Route::resource('dashboardobat', App\Http\Controllers\DashboardobatController::class);

// Remove in Production Server
Route::get('/getsession', function(){
	return Session::all();
});

// Route Setup
Route::resource('company', App\Http\Controllers\Setup\CompanyController::class);
Route::any('company/{id}', [App\Http\Controllers\Setup\CompanyController::class, 'update']);
Route::post('save-management', [App\Http\Controllers\Setup\CompanyController::class, 'setCompany']);

Route::resource('role', App\Http\Controllers\Setup\RoleController::class);
Route::resource('rolemenu', App\Http\Controllers\Setup\RolemenuController::class);
Route::resource('menu', App\Http\Controllers\Setup\MenuController::class);
Route::resource('user', App\Http\Controllers\Setup\UserController::class);
Route::resource('usercomp', App\Http\Controllers\Setup\UsercompController::class);
Route::resource('gantipass', App\Http\Controllers\Setup\GantipassController::class);


// Route Address
Route::get('comboaddress', [App\Http\Controllers\Combo\Master\ComboaddressController::class, 'index']);

//MASTER COMBO ALL
// Route Autocomplete
Route::get('comboparent', [App\Http\Controllers\Combo\Master\ComboparentController::class, 'index']);
Route::get('comborole', [App\Http\Controllers\Combo\Master\ComboroleController::class, 'index']);
Route::get('combokelurahan', [App\Http\Controllers\Combo\Master\CombokelurahanController::class, 'index']);
Route::get('combokecamatan', [App\Http\Controllers\Combo\Master\CombokecamatanController::class, 'index']);
Route::get('combokabupaten', [App\Http\Controllers\Combo\Master\CombokabupatenController::class, 'index']);
Route::get('comboprovinsi', [App\Http\Controllers\Combo\Master\ComboprovinsiController::class, 'index']);
Route::get('comboagama', [App\Http\Controllers\Combo\Master\ComboagamaController::class, 'index']);
Route::get('combogoldarah', [App\Http\Controllers\Combo\Master\CombogoldarahController::class, 'index']);
Route::get('combopendidikan', [App\Http\Controllers\Combo\Master\CombopendidikanController::class, 'index']);
Route::get('combousers', [App\Http\Controllers\Combo\Master\CombousersController::class, 'index']);

//Master
Route::resource('alamat', App\Http\Controllers\Master\AlamatController::class);

