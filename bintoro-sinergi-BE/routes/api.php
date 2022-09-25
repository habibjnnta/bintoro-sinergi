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
Route::get('/category/list', [App\Http\Controllers\Api\CategoryController::class, 'list']);
Route::get('/blog/list', [App\Http\Controllers\Api\BlogController::class, 'list']);
Route::get('/blog/{id}', [App\Http\Controllers\Api\BlogController::class, 'show']);

Route::post('/register', App\Http\Controllers\Api\RegisterController::class)->name('register');
Route::post('/login', App\Http\Controllers\Api\LoginController::class)->name('login');

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::middleware(['token'])->group(function () {
    Route::resource('/category', App\Http\Controllers\Api\CategoryController::class);
    Route::resource('/blog', App\Http\Controllers\Api\BlogController::class);
    Route::post('/upload_blog_image', [App\Http\Controllers\Api\BlogController::class, 'upload_foto']);
    Route::post('/logout', App\Http\Controllers\Api\LogoutController::class)->name('logout');
});



