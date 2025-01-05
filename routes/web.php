<?php

use App\Livewire\CategoryEdit;
use App\Livewire\ProductEdit;
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
})->name('welcome');
Route::get('/category/edit/{id}', CategoryEdit::class)->name('category.edit');
Route::get('/product/edit/{id}', ProductEdit::class)->name('product.edit');