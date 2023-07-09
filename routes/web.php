<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//  jika user belum login
Route::group(['middleware' => 'guest'], function() {
    Route::get('/', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'dologin']);
});

// untuk superadmin dan agent dan vendor
Route::group(['middleware' => ['auth', 'checkrole:1,2,3']], function() {
    Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
    Route::get('/redirect', [\App\Http\Controllers\RedircetController::class, 'cek']);
});


// untuk superadmin
Route::group(['middleware' => ['auth', 'checkrole:1']], function() {
    Route::get('/admin', [\App\Http\Controllers\Admin\DashboardController::class, 'index']);
    Route::resource('/materi', \App\Http\Controllers\Admin\MateriController::class);
});

// untuk vendor
Route::group(['middleware' => ['auth', 'checkrole:2']], function() {
    Route::get('/petugas', [\App\Http\Controllers\Petugas\DashboardController::class, 'index']);

});

// untuk agent
Route::group(['middleware' => ['auth', 'checkrole:3']], function() {
    Route::get('/anggota', [\App\Http\Controllers\Anggota\DashboardController::class, 'index']);

});
