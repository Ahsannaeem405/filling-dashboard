<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\ChatsController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\UserlistController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Auth::routes();

Route::middleware(['auth','user'])->group(function (){

    Route::get('/', [HomeController::class, 'index'])->name('dashboard');

    // Users Routes
    Route::get('user/create', [UserController::class, 'create']);
    Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('edit');
    Route::post('user/update/{id}', [UserController::class, 'update'])->name('update');
    Route::delete('user/delete/{id}', [UserController::class, 'delete'])->name('delete');

    Route::get('user/account-detail', [UserController::class, 'index']);
    Route::get('user-list', [UserlistController::class, 'index'])->name('users.list');
    Route::get('payment', [PaymentsController::class, 'index'])->name('payment');
    Route::get('chat', [ChatsController::class, 'index'])->name('chat');

    // Edit Profile
    Route::get('profile', [UserController::class, 'EditProfile'])->name('edit.profile');
    Route::post('profile/update', [UserController::class, 'UpdateProfile'])->name('update.profile');

    Route::get('conversation', [ChatsController::class, 'Conversation'])->name('conversation');
    Route::get('conversation/messages', [ChatsController::class, 'ConversationMessages'])->name('messages');


});
