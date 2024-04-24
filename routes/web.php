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
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// DASHBOARD ADMIN

Route::middleware(['isLogin', 'CekRole:admin'])->group(function (){
    Route::get('/admin/users', [AdminController::class, 'users'])->name('users');
    Route::get('/admin/addUser', [AdminController::class, 'addUser'])->name('addUser');
    Route::post('/userStore', [AdminController::class, 'userStore'])->name('userStore');
    Route::get('/editUser/{id}', [AdminController::class, 'editUser'])->name('editUser');
    Route::put('/userUpdate/{id}', [AdminController::class, 'userUpdate'])->name('userUpdate');
    Route::delete('/deleteUser/{id}', [AdminController::class, 'deleteUser'])->name('deleteUser');
    
    Route::get('/exportBooksAdmin', [AdminController::class, 'exportBooksAdmin'])->name('export.books.admin.pdf');
    Route::get('/admin/index', [AdminController::class, 'index'])->name('admin');
    Route::get('/admin/addBook', [AdminController::class, 'addBook'])->name('addBook');
    Route::post('/bookStore', [AdminController::class, 'bookStore'])->name('bookStore');
    Route::get('/editBook/{id}', [AdminController::class, 'editBook'])->name('editBook');
    Route::put('/bookUpdate/{id}', [AdminController::class, 'bookUpdate'])->name('bookUpdate');
    Route::delete('/deleteBook/{id}', [AdminController::class, 'deleteBook'])->name('deleteBook');
    
    Route::get('/admin/categories', [AdminController::class, 'categories'])->name('categories');
    Route::post('/categoriesStore', [AdminController::class, 'categoriesStore'])->name('categoriesStore');
    Route::get('/editCategory/{id}', [AdminController::class, 'editCategory'])->name('editCategory');
    Route::put('/categoryUpdate/{id}', [AdminController::class, 'categoryUpdate'])->name('categoryUpdate');
    Route::delete('/deleteCategory/{id}', [AdminController::class, 'deleteCategory'])->name('deleteCategory');
    
    Route::get('/admin/history', [AdminController::class, 'history'])->name('history');
});

// DASHBOARD STAFF

Route::middleware(['isLogin', 'CekRole:staff'])->group(function (){
    Route::get('/exportBooksStaff', [StaffController::class, 'exportBooksStaff'])->name('export.books.staff');
    Route::get('/staff/index', [StaffController::class, 'index'])->name('staff');
    Route::get('/staff/addBook', [StaffController::class, 'addBook'])->name('addBookStaff');
    Route::post('/bookStoreStaff', [StaffController::class, 'bookStore'])->name('bookStoreStaff');
    Route::get('/editBookStaff/{id}', [StaffController::class, 'editBook'])->name('editBookStaff');
    Route::put('/bookUpdateStaff/{id}', [StaffController::class, 'bookUpdate'])->name('bookUpdateStaff');
    Route::delete('/deleteBookStaff/{id}', [StaffController::class, 'deleteBook'])->name('deleteBookStaff');

    Route::get('/staff/categories', [StaffController::class, 'categories'])->name('categoriesStaff');
    Route::post('/categoriesStoreStaff', [StaffController::class, 'categoriesStore'])->name('categoriesStoreStaff');
    Route::get('/editCategoryStaff/{id}', [StaffController::class, 'editCategory'])->name('editCategoryStaff');
    Route::put('/categoryUpdateStaff/{id}', [StaffController::class, 'categoryUpdate'])->name('categoryUpdateStaff');
    Route::delete('/deleteCategoryStaff/{id}', [StaffController::class, 'deleteCategory'])->name('deleteCategoryStaff');
    
    Route::get('/staff/history', [StaffController::class, 'history'])->name('historyStaff');
});

// DASHBOARD USER

Route::middleware(['isLogin', 'CekRole:user'])->group(function (){
    Route::get('/user/index', [UserController::class, 'index'])->name('user.books');
    
    Route::get('/user/wishlist', [UserController::class, 'wishlist'])->name('user.wishlist');
    Route::post('/user/addWishlist/{id}', [UserController::class, 'addWishlist'])->name('user.addWishlist');
    Route::delete('/removeWishlist/{id}', [UserController::class, 'removeWishlist'])->name('user.removeWishlist');
    
    Route::get('/user/borrowed', [UserController::class, 'borrowed'])->name('user.borrowed');
    Route::post('/user/borrow/{id}', [UserController::class, 'borrow'])->name('user.borrow');
    Route::delete('/removeBorrow/{id}', [UserController::class, 'removeBorrow'])->name('user.removeBorrow');
    
    Route::get('/user/review', [UserController::class, 'review'])->name('user.review');
    Route::get('/user/addReview{id}', [UserController::class, 'addReview'])->name('user.addReview');
    Route::post('/user/reviewStore', [UserController::class, 'reviewStore'])->name('user.reviewStore');
    Route::get('/user/editReview{id}', [UserController::class, 'editReview'])->name('user.editReview');
    Route::put('/user/reviewUpdate/{id}', [UserController::class, 'reviewUpdate'])->name('user.reviewUpdate');
    Route::delete('/removeReview/{id}', [UserController::class, 'removeReview'])->name('user.removeReview');

    Route::get('/user/history', [UserController::class, 'history'])->name('user.history');
});
