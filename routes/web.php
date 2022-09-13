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

Route::get('/dashboard', function () {
    return view('dashboard', ['partners' => ['name' => 'Test', 'desc' => 'Bla bla blaaaaa']]);
})->middleware(['auth'])->name('dashboard');

Route::get('/users', function () {
    return view('welcome');
})->middleware(['auth'])->name('users');

Route::get('/partners', function () {
    return view('welcome');
})->middleware(['auth'])->name('partners');

Route::get('/structures', function () {
    return view('welcome');
})->middleware(['auth'])->name('structures');

Route::get('/services', function () {
    return view('welcome');
})->middleware(['auth'])->name('services');

Route::get('/params', function () {
    return view('welcome');
})->middleware(['auth'])->name('params');

require __DIR__.'/auth.php';
