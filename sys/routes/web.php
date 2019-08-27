<?php

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

Route::get('/home', function () {
    return view('adm.index');
});

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/tes', function () {
    return view('tes');
});

Route::get('/login', function(){
    return redirect('/auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', 'AuthController@logout');

Route::get('/', function () {
    return view('auth.login');
});


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', 'AuthController@logout');

Route::resource('laporan', 'LaporanController')->middleware('auth');
Route::resource('level', 'LevelController')->middleware('auth');
Route::resource('user', 'UserController')->middleware('auth');
Route::resource('customer', 'CustomerController')->middleware('auth');
Route::resource('karyawan', 'KaryawanController')->middleware('auth');
Route::resource('katmaterial', 'KatMaterialController')->middleware('auth');
Route::resource('katpekerjaan', 'KatPekerjaanController')->middleware('auth');
Route::resource('material', 'MaterialController')->middleware('auth');
Route::resource('pekerjaan', 'PekerjaanController')->middleware('auth');
Route::resource('pekerja', 'PekerjaController')->middleware('auth');
Route::resource('proyek', 'ProyekController')->middleware('auth');
Route::resource('supplier', 'SupplierController')->middleware('auth');
Route::resource('typerumah', 'TypeRumahController')->middleware('auth');
Route::resource('unitrumah', 'UnitRumahController')->middleware('auth');
Route::resource('gudang', 'GudangController')->middleware('auth');
Route::resource('item', 'ItemController')->middleware('auth');
Route::resource('pembelianitem', 'PembelianController')->middleware('auth');
Route::resource('bagian', 'BagianController')->middleware('auth');

Route::resource('rabmaterialtype', 'RabMaterialTypeController')->middleware('auth');
Route::get('rabmaterialtype/{id}/editing', 'RabMaterialTypeController@show2')->middleware('auth');
Route::get('rabmaterialtype/{id}/show', 'RabMaterialTypeController@getRabMaterialType')->middleware('auth')->name('rabmaterialtype.show_type');

Route::resource('rabmaterialunit', 'RabMaterialUnitController')->middleware('auth');
Route::get('rabmaterialunit/{id}/editing', 'RabMaterialUnitController@show2')->middleware('auth');
Route::delete('rabmaterialunit/{id}/delete', 'RabMaterialUnitController@destroy2')->middleware('auth')->name('rabmaterialunit.permanentdelete');

Route::resource('rabpekerjaantype', 'RabPekerjaanTypeController')->middleware('auth');
Route::get('rabpekerjaantype/{id}/editing', 'RabPekerjaanTypeController@show2')->middleware('auth');

Route::resource('rabpekerjaanunit', 'RabPekerjaanUnitController')->middleware('auth');
Route::get('rabpekerjaanunit/{id}/editing', 'RabPekerjaanUnitController@show2')->middleware('auth');
Route::delete('rabpekerjaanunit/{id}/delete', 'RabPekerjaanUnitController@destroy2')->middleware('auth')->name('rabpekerjaanunit.permanentdelete');


Route::get('opnamemaster/{id}/editing', 'OpnameMasterController@show2')->middleware('auth');
Route::resource('opnamemaster', 'OpnameMasterController')->middleware('auth');
// Route::resource('opnamedetail', 'OpnameDetailController')->middleware('auth');

Route::resource('pakaimaterialmaster', 'PakaiMaterialMasterController')->middleware('auth');
Route::get('pakaimaterialmaster/{id}/editing', 'PakaiMaterialMasterController@show2')->middleware('auth');
// Route::resource('pakaimaterialdetail', 'PakaiMaterialDetailController')->middleware('auth');

//ajax handler route

Route::get('/getrabmaterialtype/{id}','RabMaterialTypeController@getMaterial');
Route::get('/getrabmaterialcurrent/{matid}/{typeid}','RabMaterialTypeController@getMaterialCurrent');

Route::get('/getrabpekerjaantype/{id}','RabPekerjaanTypeController@getPekerjaan');
Route::get('/getrabpekerjaancurrent/{pekid}/{typeid}','RabPekerjaanTypeController@getPekerjaanCurrent');



Route::get('/hal/{id}', 'UtamaController@halaman');
Route::get('/subhal/{id}', 'UtamaController@subhal');
Route::get('/spost/{id}', 'UtamaController@spost');
Route::get('/setting', 'SettingController@index')->middleware('auth');
Route::post('/setting/submit/{id}', 'SettingController@change')->middleware('auth');
