<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;


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
});

Route::post('/k', [EmployeeController::class, 'store'])->name('karyawan.store');
Route::get('/employees', [EmployeeController::class, 'index'])->name('karyawan.index');
Route::get('employee/{id_number}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
Route::put('employee/{id_number}', [EmployeeController::class, 'update'])->name('employee.update');
Route::delete('/employee/{id_number}', [EmployeeController::class, 'destroy'])->name('employee.destroy');




    




 