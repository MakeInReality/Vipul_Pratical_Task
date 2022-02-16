<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\RoleController;
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



Route::get('/', [AuthController::class, 'index'])->name('login');
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 
Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard'); 
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('role', [RoleController::class, 'index'])->name('role.index');
Route::get('role/create', [RoleController::class, 'create'])->name('role.create');
Route::post('role/store', [RoleController::class, 'store'])->name('role.store');
Route::get('role/edit/{id}',[RoleController::class, 'edit'])->name('role.edit');
Route::post('role/update/{id}',[RoleController::class, 'update'])->name('role.update');
Route::get('role/delete/{id}',[RoleController::class, 'destroy'])->name('role.delete');

Route::get('employee', [EmployeeController::class, 'index'])->name('employee.index');
Route::get('employee/create', [EmployeeController::class,'create'])->name('employee.create');
Route::post('employee/store', [EmployeeController::class,'store'])->name('employee.store');
Route::get('employee/edit/{id}',[EmployeeController::class, 'edit'])->name('employee.edit');
Route::post('employee/update/{id}',[EmployeeController::class, 'update'])->name('employee.update');
Route::get('employee/delete/{id}',[EmployeeController::class, 'destroy'])->name('employee.delete');