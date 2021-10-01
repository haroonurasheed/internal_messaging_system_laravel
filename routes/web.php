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

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::any('/compose', [App\Http\Controllers\HomeController::class, 'compose'])->name('compose');

Route::any('/inbox', [App\Http\Controllers\HomeController::class, 'inbox'])->name('inbox');

Route::any('/outbox', [App\Http\Controllers\HomeController::class, 'outbox'])->name('outbox');

Route::any('/msgdetail/{id}', [App\Http\Controllers\HomeController::class, 'msgdetail'])->name('msgdetail');

Route::any('/msgsentdetail/{id}', [App\Http\Controllers\HomeController::class, 'msgsentdetail'])->name('msgsentdetail');
