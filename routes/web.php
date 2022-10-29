<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\StructureController;
use App\Http\Controllers\ServiceController;
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

Route::group(['prefix' => 'users', 'as' => 'users.', 'middleware' => 'auth'], function () {
    Route::get('/', [UserController::class, 'index'])->name('index'); // DONE
    Route::get('/search', [SearchController::class, 'searchUsers'])->name('search'); // DONE

    Route::get('/create', [UserController::class, 'create'])->name('create'); // DONE
    Route::post('/create', [UserController::class, 'store'])->name('store'); // DONE

    Route::get('/edit/{id}', [UserController::class, 'show'])->name('show'); // DONE
    Route::post('/edit', [UserController::class, 'edit'])->name('edit'); // DONE

    Route::post('/delete/{id}', [UserController::class, 'delete'])->name('delete'); // DONE
    Route::post('/restore/{id}', [UserController::class, 'restore'])->name('restore'); // DONE
});

Route::group(['prefix' => 'partners', 'as' => 'partners.', 'middleware' => 'auth'], function () {
    Route::group(['prefix' => 'structures', 'as' => 'structures.'], function () {
        Route::get('/', [StructureController::class, 'index'])->name('index'); // DONE
        Route::get('/search', [SearchController::class, 'searchStructures'])->name('search'); // DONE

        Route::get('/create', [StructureController::class, 'create'])->name('create'); // DONE
        Route::post('/create', [StructureController::class, 'store'])->name('store'); // DONE

        Route::get('/edit/{id}', [StructureController::class, 'show'])->name('show'); // DONE
        Route::post('/edit', [StructureController::class, 'edit'])->name('edit'); // DONE

        Route::post('/delete/{id}', [StructureController::class, 'delete'])->name('delete'); // DONE
        Route::post('/restore/{id}', [StructureController::class, 'restore'])->name('restore'); // DONE

        Route::get('/view/{structure_id}', [StructureController::class, 'indexStructure'])->name('index_structure');
    });

    Route::get('/', [PartnerController::class, 'index'])->name('index'); // DONE
    Route::get('/search', [SearchController::class, 'searchPartners'])->name('search'); // DONE

    Route::get('/create', [PartnerController::class, 'create'])->name('create'); // DONE
    Route::post('/create', [PartnerController::class, 'store'])->name('store'); // DONE

    Route::get('/edit/{id}', [PartnerController::class, 'show'])->name('show'); // DONE
    Route::post('/edit', [PartnerController::class, 'edit'])->name('edit'); // DONE

    Route::post('/delete/{id}', [PartnerController::class, 'delete'])->name('delete'); // DONE
    Route::post('/restore/{id}', [PartnerController::class, 'restore'])->name('restore'); // DONE

    Route::get('/view/{partner_id}', [StructureController::class, 'indexPartner'])->name('index_partner'); // DONE
});

Route::group(['prefix' => 'services', 'as' => 'services.', 'middleware' => 'auth'], function () {
    Route::get('/', [ServiceController::class, 'index'])->name('index'); // DONE
    Route::get('/search', [SearchController::class, 'searchServices'])->name('search'); // DONE

    Route::get('/create', [ServiceController::class, 'create'])->name('create'); // DONE
    Route::post('/create', [ServiceController::class, 'store'])->name('store'); // DONE

    Route::get('/edit/{id}', [ServiceController::class, 'show'])->name('show'); // DONE
    Route::post('/edit', [ServiceController::class, 'edit'])->name('edit'); // DONE

    Route::post('/delete/{id}', [ServiceController::class, 'delete'])->name('delete'); // DONE
    Route::post('/restore/{id}', [ServiceController::class, 'restore'])->name('restore'); // DONE
});

Route::get('/params', [ParamsController::class, 'index'])->middleware(['auth'])->name('params'); // DONE
Route::post('/params/newPass', [ParamsController::class, 'storeNewPass'])->middleware(['auth'])->name('params.storeNewPass'); // DONE

require __DIR__.'/auth.php';
