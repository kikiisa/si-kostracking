<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriWisata;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PemetaanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use App\Models\WisataCategory;

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

Route::get('/',[HomeController::class,'index'])->name('home')->middleware('is_login');
Route::get('/auth',[AuthController::class,'index'])->name('auth')->middleware('is_login');
Route::get('/registrasi',[AuthController::class,'create'])->name('registrasi')->middleware('is_login');
Route::post('/registrasi',[AuthController::class,'registerStore'])->name('registrasi.store');
Route::get("/search",[PemetaanController::class,'search'])->name("search");
Route::get('/semua-kos',[HomeController::class,'all'])->name("semua.product");

Route::post('/auth',[AuthController::class,'store'])->name('login');
Route::get('logout',[AuthController::class,'destroy'])->name('logout');
Route::get('/detail-wisata/{id}',[PemetaanController::class,'show'])->name("detail.wisata");
Route::get('/tentang-kami',[HomeController::class,'about'])->name("about");
Route::get('/api-peta',[PemetaanController::class,'rest_peta'])->middleware('cors');
Route::get('/api-peta/{lat}/position/{lon}',[PemetaanController::class,'rest_petaByLatAndLot'])->middleware('cors');
Route::get('/wisata/{id}',[HomeController::class,'show'])->name("bycategori");
Route::get('/profile',[ProfileController::class,'index'])->name('profile');


Route::middleware('auth')->group(function(){
    Route::get("master-user",[UserController::class,'index'])->name("user");
    Route::put("master-user/{id}",[UserController::class,'update'])->name("user.update");
    Route::delete("master-user/{id}",[UserController::class,'destroy'])->name("user.delete");
    Route::put('status-user/{id}',[UserController::class,'store'])->name("user.status");
    Route::get("profile",[UserController::class,'profile'])->name("user.profile");
    Route::put("change-password",[UserController::class,'update_pass'])->name("user.password");
    Route::get('setting-password',[UserController::class,'pass_view'])->name('user.setpassword');

    Route::get('/data-pemetaan',[PemetaanController::class,'index'])->name('pemetaan');
    Route::post('/data-pemetaan',[PemetaanController::class,'store']);
    Route::delete('/data-pemetaan/{id}',[PemetaanController::class,'destroy'])->name('hapus_pemetaan');
    Route::get('/edit-pemetaan/{id}',[PemetaanController::class,'edit'])->name('edit_pemetaan');
    Route::get('/tambah-pemetaan',[PemetaanController::class,'create'])->name('tambah_peta');
    Route::put('/data-pemetaan/{id}',[PemetaanController::class,'update'])->name('update_pemetaan');
    
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
   

    Route::get('/wisata-kategori',[CategoriWisata::class,"index"])->name("kategori");
    Route::get('/wisata-kategori/{id}',[CategoriWisata::class,"edit"])->name("kategori.edit");
    Route::put('/wisata-kategori/{id}',[CategoriWisata::class,"update"])->name("kategori.update");
    Route::delete('/wisata-kategori/{id}',[CategoriWisata::class,"delete"])->name("kategori.delete");
    Route::get('/tambah-kategori',[CategoriWisata::class,"create"])->name("kategori.tambah");
    Route::post('/wisata-kategori',[CategoriWisata::class,"store"])->name("kategori.store");
    
    Route::get('/image-slider',[FasilitasController::class,'index'])->name('fasilitas');
    Route::delete('/image-slider/{id}',[FasilitasController::class,'destroy'])->name('fasilitas.delete');
    Route::post('/image-slider',[FasilitasController::class,'store'])->name('fasilitas.store');
    Route::get('/tambah-image-slider',[FasilitasController::class,'create'])->name('fasilitas.create');
   
    Route::get('/pengaturan',[SettingsController::class,'index'])->name('setting');
    Route::put('/pengaturan',[SettingsController::class,'update'])->name('setting.update');

});