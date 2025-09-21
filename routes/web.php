<?php

use App\Http\Controllers\Administrator\Banner_Controller;
use App\Http\Controllers\Administrator\CategoryController;
use App\Http\Controllers\Administrator\ProdukController;
use App\Http\Controllers\Administrator\UserController;
use App\Http\Controllers\Public\AlatdiagnostikController;
use App\Http\Controllers\Public\CartController;
use App\Http\Controllers\Public\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', [HomeController::class, 'index'])->name('home.index');

// user
Route::get('administrator/user', 'App\Http\Controllers\Administrator\UserController@index')->name('user');
Route::get('administrator/user/tambah', 'App\Http\Controllers\Administrator\UserController@tambah');
Route::post('administrator/user/proses-tambah', 'App\Http\Controllers\Administrator\UserController@proses_tambah');
Route::get('administrator/user/edit/{id}', 'App\Http\Controllers\Administrator\UserController@edit');
Route::post('administrator/user/proses-edit', 'App\Http\Controllers\Administrator\UserController@proses_edit');
Route::post('administrator/user/delete/{id}', [UserController::class, 'delete'])->name('user.delete');
Route::get('administrator/user/ganti-password', [UserController::class, 'ganti_password'])->name('user.ganti_password');
Route::post('administrator/user/ganti-password/proses', [UserController::class, 'proses_ganti_password'])->name('user.proses_ganti_password');

// cATEGORY
Route::get('administrator/banner', 'App\Http\Controllers\Administrator\Banner_Controller@index');
Route::get('administrator/banner/tambah', 'App\Http\Controllers\Administrator\Banner_Controller@tambah');
Route::post('administrator/banner/proses-tambah', 'App\Http\Controllers\Administrator\Banner_Controller@proses_tambah');
Route::get('administrator/banner/edit/{id}', 'App\Http\Controllers\Administrator\Banner_Controller@edit');
Route::post('administrator/banner/proses-edit', 'App\Http\Controllers\Administrator\Banner_Controller@proses_edit');
Route::post('administrator/banner/delete/{id}', [Banner_Controller::class, 'delete'])->name('banner.delete');

// Kategori
Route::get('administrator/category', 'App\Http\Controllers\Administrator\CategoryController@index');
Route::get('administrator/category/tambah', 'App\Http\Controllers\Administrator\CategoryController@tambah');
Route::post('administrator/category/proses-tambah', 'App\Http\Controllers\Administrator\CategoryController@proses_tambah');
Route::get('administrator/category/edit/{id}', 'App\Http\Controllers\Administrator\CategoryController@edit');
Route::post('administrator/category/proses-edit', 'App\Http\Controllers\Administrator\CategoryController@proses_edit');
Route::post('administrator/category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');

// Produk
Route::get('administrator/produk', 'App\Http\Controllers\Administrator\ProdukController@index');
Route::get('administrator/produk/tambah', 'App\Http\Controllers\Administrator\ProdukController@tambah');
Route::post('administrator/produk/proses-tambah', 'App\Http\Controllers\Administrator\ProdukController@proses_tambah');
Route::get('administrator/produk/edit/{id}', 'App\Http\Controllers\Administrator\ProdukController@edit');
Route::post('administrator/produk/proses-edit', 'App\Http\Controllers\Administrator\ProdukController@proses_edit');
Route::post('administrator/produk/delete/{id}', [ProdukController::class, 'delete'])->name('produk.delete');
Route::get('/produk/{id}', [App\Http\Controllers\Public\HomeController::class, 'detailProduk'])
     ->whereNumber('id')
     ->name('produk.detail');

// Cart
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');


// Unit
Route::prefix('produk')->group(function () {
    Route::get('/alatdiagnostik', [AlatdiagnostikController::class, 'alatdiagnostik'])->name('profil.alatdiagnostik');
    Route::get('/up3sbu', [Up3sbuController::class, 'sbu'])->name('profil.up3sbu');
    Route::get('/up3sbs', [Up3sbsController::class, 'sbs'])->name('profil.up3sbs');
    Route::get('/up3sbb', [Up3sbbController::class, 'sbb'])->name('profil.up3sbb');
    Route::get('/up3mojokerto', [Up3mojokertoController::class, 'mojokerto'])->name('profil.up3mojokerto');
    Route::get('/up3gresik', [Up3gresikController::class, 'gresik'])->name('profil.up3gresik');
    Route::get('/up3madura', [Up3maduraController::class, 'madura'])->name('profil.up3madura');
    Route::get('/up3banyuwangi', [Up3banyuwangiController::class, 'banyuwangi'])->name('profil.up3banyuwangi');
    Route::get('/up2d', [Up2dController::class, 'up2d'])->name('profil.up2d');
    Route::get('/up3malang', [Up3malangController::class, 'malang'])->name('profil.up3malang');
    Route::get('/up3sidoarjo', [Up3sidoarjoController::class, 'sidoarjo'])->name('profil.up3sidoarjo');
    Route::get('/up3madiun', [Up3madiunController::class, 'madiun'])->name('profil.up3madiun');
    Route::get('/up3pasuruan', [Up3pasuruanController::class, 'pasuruan'])->name('profil.up3pasuruan');
    Route::get('/up3bojonegoro', [Up3bojonegoroController::class, 'bojonegoro'])->name('profil.up3bojonegoro');
    Route::get('/up3kediri', [Up3kediriController::class, 'kediri'])->name('profil.up3kediri');
    Route::get('/up3ponorogo', [Up3ponorogoController::class, 'ponorogo'])->name('profil.up3ponorogo');
    Route::get('/up3situbondo', [Up3situbondoController::class, 'situbondo'])->name('profil.up3situbondo');
});