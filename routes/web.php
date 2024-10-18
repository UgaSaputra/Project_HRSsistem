<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PelanggaranController;

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

Route::get('/dashboard', function () {
    return view('HRS.input');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

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
Route::get('/export', [EmployeeController::class, 'export'])->name('export');
Route::post('/import', [EmployeeController::class, 'import'])->name('import');

Route::post('/employee/arsipkan/{id_number}', [EmployeeController::class, 'arsipkan'])->name('employee.arsipkan');
Route::get('/Arsipan', [EmployeeController::class, 'Arsip'])->name('Arsipan.Arsip');
Route::delete('/employee/{id_number}', [EmployeeController::class, 'destroy'])->name('employee.destroy');

Route::get('/inputPelanggaran', [PelanggaranController::class, 'inputPelanggaran'])->name('karyawan.inputPelanggaran');
Route::get('/pelanggaran', [PelanggaranController::class, 'index'])->name('Pelanggaran.index');
Route::post('/pelanggaran/create', [PelanggaranController::class, 'store'])->name('Pelanggaran.store');
Route::delete('/pelanggaran/{id_number}', [PelanggaranController::class, 'destroy'])->name('pelanggaran.destroy');
Route::get('/pelanggaran/{id_number}/edit', [PelanggaranController::class, 'edit'])->name('pelanggaran.edit');
Route::put('/pelanggaran/{id_number}', [PelanggaranController::class, 'update'])->name('pelanggaran.update');
Route::get('/pelanggaran/create', [PelanggaranController::class, 'create'])->name('pelanggaran.create');

Route::get('absen/input', [AbsensiController::class, 'showForm'])->name('absen.showForm');
Route::post('/absen/import', [AbsensiController::class, 'import'])->name('absen.import');