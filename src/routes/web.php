<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\AdminController;

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




Route::get('/', [ShopController::class, 'index'])
    ->name('shops.index');


Route::get('/detail/{shop_id}', [ShopController::class, 'detail'])->name('shops.detail');




Route::get('/thanks', function () {
    return view('auth/thanks');
})->name('thanks');

Route::get('/menu', function () {
    return view('auth/menu');
})->name('menu');

Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');




Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/owner/create', [AdminController::class, 'create'])->name('admin.create');

    Route::post('/admin/owner/store', [AdminController::class, 'store'])->name('admin.store');


    Route::get('/admin/index', [AdminController::class, 'index'])->name('admin.index');

    Route::get('/admin/owner/information', [AdminController::class, 'show'])->name('admin.show');

    Route::post('/admin/owner/send', [AdminController::class, 'send'])->name('admin.send');

});







Route::middleware(['auth', 'owner'])->group(function () {
    Route::get('/owners', [OwnerController::class, 'index'])->name('owners.index');

    Route::post('/owners/store', [OwnerController::class, 'store'])->name('owners.store');

    Route::get('/owners/list', [OwnerController::class, 'show'])->name('owners.show');

    Route::get('/owners/edit/{id}', [OwnerController::class, 'edit'])->name('owners.edit');

    Route::patch('/owners/edit/{id}', [OwnerController::class, 'update'])->name('owners.update');

    Route::get('/owners/reservation/confirm', [OwnerController::class, 'confirm'])->name('owners.confirm');

    Route::get('/owners/reservation/search', [OwnerController::class, 'search'])->name('owners.search');

});





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

    Route::delete('/mypage/reservation/{reservation_id}', [MypageController::class, 'destroy'])->name('mypage.destroy');

    Route::get('/mypage/reservation/edit/{reservation_id}', [MypageController::class, 'edit'])->name('mypage.edit');

    Route::patch('/mypage/reservation/update/{reservation_id}', [MypageController::class, 'update'])->name('mypage.update');

    Route::get('/mypage/review/show', [EvaluationController::class, 'show'])->name('review.show');

    Route::post('/mypage/review/store', [EvaluationController::class, 'store'])->name('review.store');


    Route::get('/mypage/reservation/payment/{reservation_id}', [MypageController::class, 'payment'])->name('payment.create');

    Route::get('/mypage/reservation/payment/success/{reservation_id}', [MypageController::class, 'success'])->name('payment.success');
});

