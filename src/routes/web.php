<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;

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

Route::get('/thanks', function () {
    return view('auth/thanks');
})->name('thanks');

Route::get('/menu', function () {
    return view('auth/menu');
})->name('menu');


Route::get('/', [ShopController::class, 'index'])
    ->name('shops.index');


Route::middleware('auth')->group(function () {
    Route::post('/favorite/{shop_id}', [ShopController::class, 'favorite'])->name('favorite');
});

