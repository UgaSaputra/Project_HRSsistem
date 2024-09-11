<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\absensiController;
use App\Http\Controllers\ArsipanController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PelanggaranController;

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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/inputPage', [EmployeeController::class, 'inputPage'])->name('karyawan.inputPage');
Route::post('/k', [EmployeeController::class, 'store'])->name('karyawan.store');
Route::get('/employees', [EmployeeController::class, 'index'])->name('karyawan.index');
Route::get('employee/{id_number}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
Route::put('employee/{id_number}', [EmployeeController::class, 'update'])->name('employee.update');
// Route::delete('/employee/{id_number}', [EmployeeController::class, 'destroy'])->name('employee.destroy');
Route::post('/employee/archive/{id_number}', [EmployeeController::class, 'archive'])->name('employee.archive');


Route::get('/inputPelanggaran', [PelanggaranController::class, 'inputPelanggaran'])->name('karyawan.inputPelanggaran');
Route::get('/pelanggaran', [PelanggaranController::class, 'index'])->name('Pelanggaran.index');
Route::post('/pelanggaran/create', [PelanggaranController::class, 'store'])->name('Pelanggaran.store');
Route::delete('/pelanggaran/{id_number}', [PelanggaranController::class, 'destroy'])->name('pelanggaran.destroy');
Route::get('/pelanggaran/{id_number}/edit', [PelanggaranController::class, 'edit'])->name('pelanggaran.edit');
Route::put('/pelanggaran/{id_number}', [PelanggaranController::class, 'update'])->name('pelanggaran.update');
Route::get('/pelanggaran/create', [PelanggaranController::class, 'create'])->name('pelanggaran.create');

Route::get('/export', [EmployeeController::class, 'export'])->name('export');

Route::post('absen/input', [absensiController::class, 'store'])->name('absen.store');
Route::get('/absen', [absensiController::class, 'index'])->name('absen.index');

Route::get('/employee/arsipan', [ArsipanController::class, 'arsipan'])->name('employee.arsipan');
Route::get('/arsipan', [ArsipanController::class, 'index'])->name('arsipan.index');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

















    




 