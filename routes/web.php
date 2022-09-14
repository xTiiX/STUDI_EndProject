<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PartnerController;

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

Route::group(['prefix' => 'users', 'as' => 'users.', 'middleware' => 'auth'], function () {
    Route::get('/', [PartnerController::class, 'index'])->name('index');

    Route::get('/create', [PartnerController::class, 'create'])->name('create');
    Route::post('/create', [PartnerController::class, 'store'])->name('store');

    Route::get('/edit/{id}', [PartnerController::class, 'show'])->name('show');
    Route::post('/edit', [PartnerController::class, 'edit'])->name('edit');

    Route::post('/delete/{id}', [PartnerController::class, 'delete'])->name('delete');
    Route::post('/restore/{id}', [PartnerController::class, 'restore'])->name('restore');
});

Route::group(['prefix' => 'partners', 'as' => 'partners.', 'middleware' => 'auth'], function () {
    Route::group(['prefix' => 'structures', 'as' => 'structures.', 'middleware' => 'auth'], function () {
        Route::get('/', [PartnerController::class, 'index'])->name('index');
        Route::get('/{partner_id}', [PartnerController::class, 'index'])->name('index_partner');

        Route::get('/create', [PartnerController::class, 'create'])->name('create');
        Route::post('/create', [PartnerController::class, 'store'])->name('store');

        Route::get('/edit/{id}', [PartnerController::class, 'show'])->name('show');
        Route::post('/edit', [PartnerController::class, 'edit'])->name('edit');

        Route::post('/delete/{id}', [PartnerController::class, 'delete'])->name('delete');
        Route::post('/restore/{id}', [PartnerController::class, 'restore'])->name('restore');
    });

    Route::get('/', [PartnerController::class, 'index'])->name('index');

    Route::get('/create', [PartnerController::class, 'create'])->name('create');
    Route::post('/create', [PartnerController::class, 'store'])->name('store');

    Route::get('/edit/{id}', [PartnerController::class, 'show'])->name('show');
    Route::post('/edit', [PartnerController::class, 'edit'])->name('edit');

    Route::post('/delete/{id}', [PartnerController::class, 'delete'])->name('delete');
    Route::post('/restore/{id}', [PartnerController::class, 'restore'])->name('restore');
});

Route::group(['prefix' => 'services', 'as' => 'services.', 'middleware' => 'auth'], function () {
    Route::get('/', [PartnerController::class, 'index'])->name('index');

    Route::get('/create', [PartnerController::class, 'create'])->name('create');
    Route::post('/create', [PartnerController::class, 'store'])->name('store');

    Route::get('/edit/{id}', [PartnerController::class, 'show'])->name('show');
    Route::post('/edit', [PartnerController::class, 'edit'])->name('edit');

    Route::post('/delete/{id}', [PartnerController::class, 'delete'])->name('delete');
    Route::post('/restore/{id}', [PartnerController::class, 'restore'])->name('restore');
});

Route::get('/params', function () {
    return view('welcome');
})->middleware(['auth'])->name('params');

require __DIR__.'/auth.php';
