<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;

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

    return view('dashboard');
    
});

Route::get('/dashboard', function () {

    return view('dashboard');

})->name('dashboard');

Route::resource('orders',OrderController::class);
Route::resource('products',ProductController::class);

Route::post('/uploads', [ProductController::class, 'uploads']);


