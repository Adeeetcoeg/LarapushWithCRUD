<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;

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

Auth::routes();\

    Route::group(
        ['prefix'=>'admin','middleware'=>['auth','role:Admin']], function(){
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

    Route::group(
        ['prefix'=>'user','middleware'=>['auth','role:member']], function(){
        Route::get('/sample', [App\Http\Controllers\HomeController::class, 'index2'])->name('home');
});

Route::resource('author', AuthorController::class);
Route::resource('book', BookController::class);