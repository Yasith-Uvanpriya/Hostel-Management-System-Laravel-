<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SProfileController;
use App\Http\Controllers\RoomController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/S_interface', function(){
    $user = auth()->user();
    $sProfile = null;
    if ($user) {
        $sProfile = \App\Models\S_profile::where('user_id', $user->id)->first();
    }

    return view('S_interface', compact('sProfile', 'user'));
});
Route::get('/a_room', function(){
return view('admin.a_room');
});

Route::get('/room', [RoomController::class, 'add']);

// Admin dashboard route
Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/test', function () {
    return view('admin.a_interface');
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
Route::Post('/add-room', [RoomController::class, 'store'])->name('add.room');
Route::post('/update', [SProfileController::class, 'update'])->name('update');
Route::get('/register', [UserController::class, 'showRegistrationForm']);
Route::post('/register', [UserController::class, 'register'])->name('register');

Route::get('/login', [UserController::class, 'showLoginForm']);
Route::post('/login', [UserController::class, 'login'])->name('login');