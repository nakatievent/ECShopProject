<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// 商品
Route::prefix('products')->name('products.')->group(function() {
    Route::get('list', App\Http\Controllers\Products\IndexController::class)->name('list');
    Route::get('search/{keyword}', App\Http\Controllers\Products\SearchController::class)->name('search');
    Route::get('detail/{id}', App\Http\Controllers\Products\DetailController::class)->name('detail');
});

// カテゴリー
Route::prefix('categories')->name('categories.')->group(function() {
    Route::get('/{category_id}/products', App\Http\Controllers\Categories\CategoryProductController::class)->name('category-product');
    Route::get('/list', App\Http\Controllers\Categories\ListController::class)->name('category-list');
    // Route::get('detail/{id}', App\Http\Controllers\Products\DetailController::class)->name('detail');
});

// お気に入り
Route::prefix('favorites')->name('favorites.')->group(function() {
    Route::post('/favorite-add', App\Http\Controllers\Favorites\AddController::class)->name('favorite-add');
    Route::post('/favorite-delete', App\Http\Controllers\Favorites\DeleteController::class)->name('favorite-delete');
    Route::get('/favorite-list', App\Http\Controllers\Favorites\ListController::class)->name('favorite-list');
});

// 決済
Route::prefix('payments')->name('payments.')->group(function() {
    Route::post('/create', App\Http\Controllers\Payments\CreateController::class)->name('payment-create');
    // Route::post('/favorite-delete', App\Http\Controllers\Favorites\DeleteController::class)->name('favorite-delete');
    // Route::get('/favorite-list', App\Http\Controllers\Favorites\ListController::class)->name('favorite-list');
});

// よくある質問
Route::prefix('faqs')->name('faqs.')->group(function() {
    Route::get('/list/{shop_id}', App\Http\Controllers\Faqs\ListController::class)->name('faq-list');
});
