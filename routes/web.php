<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\AdminMessageController;
use App\Http\Controllers\UserMessageController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/S_interface', function(){
    $user = auth()->user();
    $sProfile = null;
    $unread_messages = [];
    if ($user) {
        $sProfile = \App\Models\S_profile::where('user_id', $user->id)->first();
        $unread_messages = \App\Models\Message::where('user_id', $user->id)->where('is_read', false)->latest()->get();
    }

    return view('S_interface', compact('sProfile', 'user', 'unread_messages'));
});
Route::get('/a_room', function(){
return view('admin.a_room');
});

Route::get('/room', [RoomController::class, 'add']);

// Admin dashboard route
Route::get('/admin/login', [\App\Http\Controllers\AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [\App\Http\Controllers\AdminController::class, 'login'])->name('admin.login.submit');
Route::middleware(['admin'])->group(function () {
    Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
});

Route::get('/profile/{id}', function($id){
    $user = \App\Models\User::find($id);
    return view('Profile', compact('user'));
});

// Show profile for the currently authenticated user (if logged in)
Route::get('/profile', function () {
    if (! auth()->check()) {
        return redirect('/login');
    }

    $user = auth()->user();
    return view('S_interface', compact('user'));
});
Route::get('/usermsg', [UserMessageController::class, 'index'])->name('user.messages');
Route::post('/aroom', [RoomController::class, 'adminStore']);
Route::Post('/add-room', [RoomController::class, 'store'])->name('add.room');
Route::post('/update', [SProfileController::class, 'update'])->name('update');
Route::get('/register', [UserController::class, 'showRegistrationForm']);
Route::post('/register', [UserController::class, 'register'])->name('register');

Route::get('/login', [UserController::class, 'showLoginForm']);
Route::post('/login', [UserController::class, 'login'])->name('login');

Route::get('/messages/create', [AdminMessageController::class, 'create'])->name('admin.messages.create');
Route::post('/messages/store', [AdminMessageController::class, 'store'])->name('admin.messages.store');
Route::delete('/messages/{message}', [AdminMessageController::class, 'destroy'])->name('admin.messages.destroy');
