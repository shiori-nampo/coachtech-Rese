<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\EvaluationController;

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

Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');


Route::get('/', [ShopController::class, 'index'])
    ->name('shops.index');


Route::get('/detail/{shop_id}', [ShopController::class, 'detail'])->name('shops.detail');



Route::middleware('auth')->group(function () {
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/login');
    })->name('logout');
});


Route::middleware('auth', 'verified')->group(function () {
    Route::post('/favorite/{shop_id}', [ShopController::class, 'favorite'])->name('favorite');

    Route::post('/detail/{shop_id}', [ShopController::class, 'store'])->name('shops.store');

    Route::get('/done', [ShopController::class, 'done'])->name('shops.done');

    Route::get('/mypage', [MypageController::class, 'index'])->name('mypage.index');

    Route::post('/mypage/reservation/{reservation_id}', [MypageController::class, 'destroy'])->name('mypage.destroy');

    Route::get('/mypage/reservation/edit/{reservation_id}', [MypageController::class, 'edit'])->name('mypage.edit');

    Route::patch('/mypage/reservation/update/{reservation_id}', [MypageController::class, 'update'])->name('mypage.update');

    Route::get('/mypage/review/show', [EvaluationController::class, 'show'])->name('review.show');

    Route::post('/mypage/review/store', [EvaluationController::class, 'store'])->name('review.store');


    Route::get('/mypage/reservation/payment/{reservation_id}', [MypageController::class, 'payment'])->name('payment.create');
});

