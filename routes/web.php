<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();
Route::get('/store', [App\Http\Controllers\CityController::class, 'store'])->name('store');
Route::get('/home', [App\Http\Controllers\CityController::class, 'index'])->name('home');
Route::get('/detailed_weather/{city}', [App\Http\Controllers\CityController::class, 'show'])->name('detailed_weather');
Route::get('/detach/{city}', [App\Http\Controllers\CityController::class, 'detach'])->name('detach_weather');


