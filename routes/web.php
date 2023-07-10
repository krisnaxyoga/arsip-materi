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
    Route::post('/regisanggota', [\App\Http\Controllers\AuthController::class, 'regisanggota'])->name('doregist');
    
    Route::get('/register', [\App\Http\Controllers\AuthController::class, 'regisform'])->name('registerman');
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
    Route::resource('/admin/anggota', \App\Http\Controllers\Admin\AnggotaController::class);
    Route::resource('/category', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('/admin/petugas', \App\Http\Controllers\Admin\PetugasController::class);
    Route::get('/cetak/form',[\App\Http\Controllers\Admin\AnggotaController::class, 'formprint'])->name('form.cetak');
    
    Route::get('/adm/comment',[\App\Http\Controllers\Admin\CommentController::class, 'index'])->name('comment.index');
    
    Route::delete('/adm/comment/delete/{id}',[\App\Http\Controllers\Admin\CommentController::class, 'delete'])->name('comment.delete');
    Route::get('/cetak/cetak',[\App\Http\Controllers\Admin\AnggotaController::class, 'print'])->name('cetakpdf.cetak');
    Route::get('/password/admin', [\App\Http\Controllers\Admin\DashboardController::class, 'password'])->name('password.admin');
    
    Route::post('/passwordadmin/store', [\App\Http\Controllers\Admin\DashboardController::class, 'passwordstrore'])->name('passwordadmin.store');
});

// untuk vendor
Route::group(['middleware' => ['auth', 'checkrole:2']], function() {
    Route::get('/dashboard/petugas', [\App\Http\Controllers\Petugas\DashboardController::class, 'index'])->name('dashboard.petugas');
    
    Route::get('/password/petugas', [\App\Http\Controllers\Petugas\DashboardController::class, 'password'])->name('password.petugas');
    
    Route::post('/passwordpetugas/store', [\App\Http\Controllers\Petugas\DashboardController::class, 'passwordstrore'])->name('passwordpetugas.store');
    Route::resource('/arsipmateri', \App\Http\Controllers\Petugas\MateriController::class);
    Route::resource('/petugas/commentpetugas', \App\Http\Controllers\Petugas\CommentController::class);
    Route::resource('/sertifikatbypetugas', \App\Http\Controllers\Petugas\SertifikatController::class);
});

// untuk agent
Route::group(['middleware' => ['auth', 'checkrole:3']], function() {
    Route::get('/dashboard/anggota', [\App\Http\Controllers\Anggota\DashboardController::class, 'index'])->name('dashboard.anggota');
    Route::get('/dashboard/anggota/materi', [\App\Http\Controllers\Anggota\MateriController::class, 'index'])->name('dashboard.anggota.materi');
    Route::resource('/anggota/jamaattanya', \App\Http\Controllers\Anggota\CommentController::class);
    Route::get('/dashboard/anggota/sertif', [\App\Http\Controllers\Anggota\DashboardController::class, 'sertif'])->name('dashboard.anggota.sertif');
    Route::get('/password/anggota', [\App\Http\Controllers\Anggota\DashboardController::class, 'password'])->name('password.anggota');
    
    Route::post('/passwordanggota/store', [\App\Http\Controllers\Anggota\DashboardController::class, 'passwordstrore'])->name('passwordanggota.store');
   
});
