<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UserController;

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

// AUTH

Route::post('/login', [AuthController::class, 'authLogin'])->name('login');
Route::post('/register', [AuthController::class, 'authRegister'])->name('register');
Route::post('/proses_login', [AuthController::class, 'proses_login'])->name('proses_login');
Route::get('/signUp', [AuthController::class, 'signUp'])->name('signUp');
Route::get('/signIn', [AuthController::class, 'signIn'])->name('signIn');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// DASHBOARD ADMIN

Route::get('/admin/index', [AdminController::class, 'index'])->name('admin');
Route::get('/admin/users', [AdminController::class, 'users'])->name('users');
Route::get('/admin/addUser', [AdminController::class, 'addUser'])->name('addUser');
Route::post('/userStore', [AdminController::class, 'userStore'])->name('userStore');

// DASHBOARD STAFF

Route::get('/staff/index', [StaffController::class, 'index'])->name('staff');

// DASHBOARD USER

Route::get('/user/index', [UserController::class, 'index'])->name('user');
