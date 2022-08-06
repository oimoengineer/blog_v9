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

Route::controller(PostController::class)->group(function (){
  Route::get('/posts', 'index');
  Route::get('/post/create', 'create');
  Route::post('/posts', 'store');
  Route::get('/post/{post}', 'show');
  //いいね機能用ルーティング
  Route::post('/post/{post}/like', 'like')->middleware('auth');
  Route::post('/post/{post}/unlike', 'unlike')->middleware('auth');
});

//calender
Route::controller(CalenderController::class)->group(function(){
    
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
