<?php

use App\Http\Controllers\ProductAnswersController;
use App\Http\Controllers\ProductQuestionsController;
use App\Http\Controllers\ProductReviewsController;
use App\Http\Controllers\ProductsController;
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

Route::group(['middleware' => 'auth:sanctum', 'verified'], function() {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/products', [ProductsController::class, 'index'])->name('products.all');
    Route::post('/products', [ProductsController::class, 'store'])->name('product.store');
    Route::get('/products/create', [ProductsController::class, 'create'])->name('product.create');
    Route::get('/products/{product}', [ProductsController::class, 'show'])->name('product.show');
    Route::get('/products/{product}/edit', [ProductsController::class, 'edit'])->name('product.edit');
    Route::patch('/products/{product}', [ProductsController::class, 'update'])->name('product.update');

    Route::post('/products/{product}/reviews', [ProductReviewsController::class, 'store'])->name('review.store');
    Route::patch('/products/{product}/reviews/{review}', [ProductReviewsController::class, 'update'])->name('review.update');

    Route::post('/products/{product}/questions', [ProductQuestionsController::class, 'store'])->name('question.store');
    Route::patch('/products/{product}/questions/{question}', [ProductQuestionsController::class, 'update'])->name('question.update');

    Route::post('/products/{product}/questions/{question}/answers', [ProductAnswersController::class, 'store'])->name('question.store');
    Route::patch('/products/{product}/questions/{question}/answers/{answer}', [ProductAnswersController::class, 'update'])->name('question.update');
});
