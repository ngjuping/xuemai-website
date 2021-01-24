<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// XueMai's api lies here
Route::prefix('/api')->middleware('web')->group(function() {
    Route::get('/posts', [PostController::class, 'index']);
    Route::prefix('/post')->group(function () {
        Route::get('/{id}', [PostController::class, 'show']);
        Route::post('/create', [PostController::class, 'store']);
        Route::put('/{id}', [PostController::class, 'update']);
        Route::delete('/{id}', [PostController::class, 'destroy']);
    });
});


require __DIR__.'/auth.php';

// Uncomment for customized 404
//Route::fallback(function () {
//    return view('notfound');
//});
