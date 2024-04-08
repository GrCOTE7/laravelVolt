<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

// Volt::route('/', 'index')->name('home');
Route::get('/', function () {
    return redirect()->route('home', ['category' => 'all']);
});

Volt::route('/myIndex', 'my_index')->name('myIndex');
Volt::route('/users', 'users.index')->name('users');


Route::middleware('guest')->group(function () {
    Volt::route('/register', 'auth.register');
	Volt::route('/login', 'auth.login')->name('login');
	Volt::route('/forgot-password', 'auth.forgot-password');
	Volt::route('/reset-password/{token}', 'auth.reset-password')->name('password.reset');
});

Route::middleware('auth')->group(function () {
    Volt::route('images/create', 'images.create')->name('images.create');
});

Volt::route('/{category}/{param?}', 'index')->name('home');
