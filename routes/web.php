<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\EmailController;
use Illuminate\Http\Request;

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




Route::get('/admin', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// No auth required URLs
// all API share the same request per minute
 Route::prefix('/api')->middleware('throttle:60,1')->group(function() {

    Route::post('/feedback', [FeedbackController::class, 'store']); // submit feedback
    Route::post('/subscribe', [EmailController::class, 'store']); // subscribe with email
    Route::get('/posts', [PostController::class, 'index']); // show all posts

    Route::prefix('/post')->group(function () {

        Route::get('/{id}', [PostController::class, 'show']); // get detail of post with id X

    });

});

// Requires auth and has throttle protection
Route::prefix('/api')->middleware('auth')->group(function() {

    Route::get('/user',function (Request $request){ return $request->user(); }); // get user info


    Route::prefix('/post')->group(function () {

        Route::post('/create', [PostController::class, 'store']); // create a new post
        Route::put('/{id}', [PostController::class, 'update']); // update post with id X
        Route::delete('/{id}', [PostController::class, 'destroy']); // delete post with id X

    });
});

require __DIR__.'/auth.php';

Route::fallback(function () {
    return view('welcome');
});


// Uncomment for customized 404
//Route::fallback(function () {
//    return view('notfound');
//});
