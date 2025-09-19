<?php

use App\Http\Controllers\Administrator\Banner_Controller;
use App\Http\Controllers\Administrator\CategoryController;
use App\Http\Controllers\Administrator\UserController;
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

Route::get('administrator/category', 'App\Http\Controllers\Administrator\CategoryController@index');
Route::get('administrator/category/tambah', 'App\Http\Controllers\Administrator\CategoryController@tambah');
Route::post('administrator/category/proses-tambah', 'App\Http\Controllers\Administrator\CategoryController@proses_tambah');
Route::get('administrator/category/edit/{id}', 'App\Http\Controllers\Administrator\CategoryController@edit');
Route::post('administrator/category/proses-edit', 'App\Http\Controllers\Administrator\CategoryController@proses_edit');
Route::post('administrator/category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');