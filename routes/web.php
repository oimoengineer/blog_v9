<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\NoteController;
use App\Events\Message;
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

Route::controller(PostController::class)->group(function (){
  Route::get('/posts', 'index');
  Route::get('/post/create', 'create')->middleware('auth');
  Route::post('/posts', 'store')->middleware('auth');
  Route::get('/post/{post}', 'show')->name("post.show");
  Route::delete('/post/{post}', 'destroy');
  //いいね機能用ルーティング
  Route::post('/post/{post}/like', 'like')->middleware('auth');
  Route::post('/post/{post}/unlike', 'unlike')->middleware('auth');
});

//calendar
Route::controller(CalendarController::class)->group(function(){
    
});

//fullcalendar
Route::controller(ScheduleController::class)->group(function (){
  Route::get('/fullcalendar', 'index');
  Route::get('/fullcalendar/create', 'create');
  Route::post('/fullcalendar', 'store');
  Route::post('/fullcalendar-get', 'show');
  
});

//chat
Route::get('/chat', function() {
  return view('chat');
});

Route::post('/send-message', function(Request $request) {
  event(
    new Message(
        $request->input('username'),
        $request->input('message')
      )
    );
    return ["success" => true];
});

// comment
Route::controller(CommentController::class)->group(function (){
  Route::post('/post/{post}/comment', 'store');
  Route::delete('/post/{post}/comment', 'destroy')->name("comment.destroy");
});

//game関連
//games checkbox
Route::controller(GameController::class)->group(function (){
  Route::get('/games', 'index');
  Route::post('/games', 'store');
  Route::get('/games/create', 'create');
});

// game memo
Route::controller(NoteController::class)->group(function (){
  Route::post('/games/notes', 'store');
  Route::get('/games/notes/{note}', 'show');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
