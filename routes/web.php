<?php

use App\Http\Controllers\Administrator\Banner_Controller;
use App\Http\Controllers\Administrator\CategoryController;
use App\Http\Controllers\Administrator\GuestbookController;
use App\Http\Controllers\Administrator\OrderController;
use App\Http\Controllers\Administrator\ProdukController;
use App\Http\Controllers\Administrator\UserController;
use App\Http\Controllers\Administrator\UsersController;
use App\Http\Controllers\Public\AlatbedahController;
use App\Http\Controllers\Public\AlatdiagnostikController;
use App\Http\Controllers\Public\AlatibuanakController;
use App\Http\Controllers\Public\AlatlaboratController;
use App\Http\Controllers\pUBLIC\Alatp3kController;
use App\Http\Controllers\Public\AlatrumahController;
use App\Http\Controllers\Public\AlatrumkitController;
use App\Http\Controllers\Public\AlatterapiController;
use App\Http\Controllers\Public\APDController;
use App\Http\Controllers\Public\CartController;
use App\Http\Controllers\Public\CheckoutController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\LokasiController;
use App\Http\Controllers\Public\PeralatanlukaController;
use App\Http\Controllers\Public\Produk_Controller;
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

// user
Route::get('administrator/users', 'App\Http\Controllers\Administrator\UsersController@index')->name('users');
Route::get('administrator/users/tambah', 'App\Http\Controllers\Administrator\UsersController@tambah');
Route::post('administrator/users/proses-tambah', 'App\Http\Controllers\Administrator\UsersController@proses_tambah');
Route::post('administrator/users/delete/{id}', [UsersController::class, 'delete'])->name('users.delete');

//halaman login
Route::get('administrator/login', 'App\Http\Controllers\Administrator\LoginController@index')->name('administrator.login'); 
Route::get('administrator/lupa-password', 'App\Http\Controllers\Administrator\LoginController@lupa_password')->name('administrator.lupa_password');
Route::post('administrator/cek-login', 'App\Http\Controllers\Administrator\LoginController@cek_login')->name('administrator.cek_login');
Route::get('administrator/logout', 'App\Http\Controllers\Administrator\LoginController@logout')->name('administrator.logout');

// Form Ganti Password
Route::get('akun', 'App\Http\Controllers\Admin\Login@edit')->name('akun.edit');

// Proses Ganti Password
Route::post('akun', 'App\Http\Controllers\Admin\Login@proses_edit')->name('akun.proses_edit');

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
Route::get('/category/{slug}', [Produk_Controller::class, 'byCategory'])->name('produk.category');

// Login
Route::get('login', 'App\Http\Controllers\Public\LoginController@index')->name('login'); 
Route::get('register', [App\Http\Controllers\Public\LoginController::class, 'register'])->name('register');
Route::post('register/proses-tambah', 'App\Http\Controllers\Public\LoginController@proses_tambah');

Route::get('administrator/lupa-password', 'App\Http\Controllers\Public\LoginController@lupa_password')->name('administratorlupa_password');
Route::post('cek-login', 'App\Http\Controllers\Public\LoginController@cek_login')->name('administrator.cek_login');
Route::get('logout', 'App\Http\Controllers\Public\LoginController@logout')->name('logout');


Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/success/{orderId}', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/checkout/pdf/{orderId}', [CheckoutController::class, 'downloadPDF'])->name('checkout.pdf');
Route::post('checkout/{order}/cancel', [CheckoutController::class, 'cancel'])
    ->name('orders.cancel');

//lokasi
Route::get('/lokasi', [LokasiController::class, 'index'])->name('lokasi');

// Submit guestbook dari halaman lokasi
Route::post('/lokasi/guestbook', [LokasiController::class, 'storeGuestbook'])->name('lokasi.guestbook.store');

Route::get('administrator/guestbook', 'App\Http\Controllers\Administrator\GuestbookController@index');
Route::post('administrator/guestbook/delete/{id}', [GuestbookController::class, 'delete'])->name('guestbook.delete');

Route::get('administrator/orders', [OrderController::class, 'index'])->name('orders.index');
Route::put('administrator/orders/{id}/shipping', [OrderController::class, 'updateShipping'])->name('orders.updateShipping');
Route::delete('administrator/orders/{id}', [OrderController::class, 'delete'])->name('orders.delete');


Route::put('/administrator/orders/{id}/update-status', [OrderController::class, 'updateStatus'])
    ->name('orders.updateStatus');

Route::delete('/administrator/orders/{id}', [OrderController::class, 'destroy'])
    ->name('orders.delete');
