<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\ProductsController;
use App\Http\Controllers\admin\CategoriesController;

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
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
Route::get('/admin/categories',[CategoriesController::class,'index'])->name('categories.index');
Route::get('/admin/categories/create',[CategoriesController::class,'create'])->name('categories.create');
Route::post('/admin/categories',[CategoriesController::class,'store'])->name('categories.store');
Route::get('/admin/categories/{id}',[CategoriesController::class,'show'])->name('categories.show');
Route::get('/admin/categories/{id}/edit',[CategoriesController::class,'edit'])->name('categories.edit');
Route::put('/admin/categories/{id}',[CategoriesController::class,'update'])->name('categories.update');
Route::delete('/admin/categories/{id}',[CategoriesController::class,'destroy'])->name('categories.destroy');

Route::resource('/admin/products',ProductsController::class)->middleware(['auth', 'password.confirm']);
