<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
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

Route::get('/admin', [DashboardController::class, 'index']);
Route::get('/admin/category', [CategoryController::class, 'index'])->name('admin.categories.index');
Route::get('/admin/category/create', [CategoryController::class, 'create'])->name('admin.categories.create');
Route::post('/admin/category/create', [CategoryController::class, 'store']);
Route::get('/admin/category/update/{id}', [CategoryController::class, 'edit'])->name('admin.categories.update');
Route::post('/admin/category/update/{id}', [CategoryController::class, 'update']);
Route::get('/admin/category/delete/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.delete');

Route::get('/admin/user', [UserController::class, 'index'])->name('admin.users.index');
Route::get('/admin/user/create', [UserController::class, 'create'])->name('admin.users.create');
Route::post('/admin/user/create', [UserController::class, 'store']);
Route::get('/admin/user/update/{id}', [UserController::class, 'edit'])->name('admin.users.update');
Route::post('/admin/user/update/{id}', [UserController::class, 'update']);
Route::get('/admin/user/delete/{id}', [UserController::class, 'destroy'])->name('admin.users.delete');
