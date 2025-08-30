<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SProfileController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/S_interface', function(){
    return view('S_interface');
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
    return view('Profile', compact('user'));
});
Route::post('/update', [SProfileController::class, 'update'])->name('update');
Route::get('/register', [UserController::class, 'showRegistrationForm']);
Route::post('/register', [UserController::class, 'register'])->name('register');

Route::get('/login', [UserController::class, 'showLoginForm']);
Route::post('/login', [UserController::class, 'login'])->name('login');