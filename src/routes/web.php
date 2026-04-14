<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\MypageController;

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


Route::get('/detail/{shop_id}', [ShopController::class, 'detail'])->name('shops.detail');




Route::middleware('auth')->group(function () {
    Route::post('/favorite/{shop_id}', [ShopController::class, 'favorite'])->name('favorite');

    Route::post('/detail/{shop_id}', [ShopController::class, 'store'])->name('shops.store');

    Route::get('/done', [ShopController::class, 'done'])->name('shops.done');

    Route::get('/mypage', [MypageController::class, 'index'])->name('mypage.index');

    Route::delete('/mypage/reservation/{reservation_id}', [MypageController::class, 'destroy'])->name('mypage.destroy');

    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/login');
    })->name('logout');
});

