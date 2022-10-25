<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ParamsController;
use App\Http\Controllers\SearchController;

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

//////////////////////////////////////////

$proxy_url    = getenv('PROXY_URL');
$proxy_scheme = getenv('PROXY_SCHEME');

if (!empty($proxy_url)) {
   URL::forceRootUrl($proxy_url);
}

if (!empty($proxy_scheme)) {
   URL::forceScheme($proxy_scheme);
}

//////////////////////////////////////////

Route::get('/', function () {
    return view('welcome');
});

Route::get('/modal-test', function () {
    return view('modal-example');
});

Route::get('/search-test',[SearchController::class, 'index']);

Route::get('/search-test/search',[SearchController::class, 'workingSearch'])->name('search');

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
    Route::group(['prefix' => 'structures', 'as' => 'structures.'], function () {
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
    Route::get('/search', [SearchController::class, 'searchPartners']);

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

Route::get('/params', [ParamsController::class, 'index'])->middleware(['auth'])->name('params');
Route::post('/params/newPass', [ParamsController::class, 'storeNewPass'])->middleware(['auth'])->name('params.storeNewPass');

require __DIR__.'/auth.php';
