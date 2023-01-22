<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpController;
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

Route::get('/' , [EmpController::class , 'index'])->name('employees.index');
//Route::get('/employees/create' , [EmpController::class , 'create'])->name('employees.create');
//Route::post('/employees' , [EmpController::class , 'store'])->name('employees.store');
//Route::get('/employees/{employee}/edit' , [EmpController::class , 'edit'])->name('employees.edit');
//Route::put('/employees/{employee}' , [EmpController::class , 'update'])->name('employees.update');
//Route::delete('/employees/{employee}' , [EmpController::class , 'destroy'])->name('employees.destroy');

//or

Route::resource('employees' , EmpController::class);