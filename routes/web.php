<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;
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

Route::middleware('auth')->group(function() {
    Route::get('user-list', [UserController::class,'list'])->name('user.list');
    Route::get('load-messages', [MessageController::class, 'load'])->name('messages.load');
    Route::get('check-messages', [MessageController::class, 'check'])->name('messages.check');
    Route::post('send-message', [MessageController::class, 'send'])->name('messages.send');
    Route::post('delete-message', [MessageController::class, 'delete'])->name('messages.delete');
    Route::post('mark-as-read-message', [MessageController::class, 'markAsRead'])->name('messages.seen');
});



require __DIR__.'/auth.php';
