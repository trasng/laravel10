<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
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
