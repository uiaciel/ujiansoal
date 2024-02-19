<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HasilUjianController;
use App\Http\Controllers\JawabanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PertanyaanController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\UjianController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'middleware' => ['auth'],
    // 'prefix' => 'admin'
], function () {

    Route::get('/users', [AdminController::class, 'users'])->name('users.list');
    Route::get('/siswa', [AdminController::class, 'siswa'])->name('siswa.list');

    Route::post('/siswa', [AdminController::class, 'tambahsiswa'])->name('siswa.store');
    Route::post('/siswa/update', [AdminController::class, 'update'])->name('siswa.update');

    Route::get('/ujian/create/{id}', [UjianController::class, 'create'])->name('ujian.create');
    Route::resource('/ujian', UjianController::class);
    Route::get('/hasil-ujian', [UjianController::class, 'hasilujian'])->name('ujian.hasil');

    Route::resource('/soal', SoalController::class);
    Route::resource('/kelas', KelasController::class);
    Route::resource('/jawaban', JawabanController::class);

    Route::get('/pertanyaan/create', [PertanyaanController::class, 'create'])->name('pertanyaan.create');
    Route::resource('/pertanyaan', PertanyaanController::class);
    Route::post('/import/data', [SoalController::class, 'import'])->name('ujian.import');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


});



Auth::routes();

