<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

use App\Http\Middleware\Admin;
use App\Livewire\Counter2;
use App\Livewire\MonComposant;
use App\Livewire\Posts\CreatePost;
use App\Livewire\ShowUser;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware('guest')->group(function () {
	Volt::route('/register', 'auth.register');
	Volt::route('/login', 'auth.login')->name('login');
	Volt::route('/forgot-password', 'auth.forgot-password');
	Volt::route('/reset-password/{token}', 'auth.reset-password')->name('password.reset');
});

Route::middleware('auth')->group(function () {
	Volt::route('profile', 'auth.profile')->name('profile');
	Volt::route('images/create', 'images.create')->name('images.create');
	Volt::route('albums', 'albums.index')->name('albums.index');
	Volt::route('albums/create', 'albums.create')->name('albums.create');
	Volt::route('albums/{album}/edit', 'albums.edit')->name('albums.edit');
});

// Volt::route('/', 'index')->name('home');
Route::get('/', function () {
	return redirect()->route('home', ['category' => 'all']);
});

Route::middleware(Admin::class)->group(function () {
	Route::get('/user/{user}', ShowUser::class)->name('user');
	Volt::route('/users', 'users.index')->name('users');
	Volt::route('categories', 'categories.index')->name('categories.index');
	Volt::route('categories/create', 'categories.create')->name('categories.create');
	Volt::route('categories/{category}/edit', 'categories.edit')->name('categories.edit');
	Volt::route('/myIndex', 'my-index')->name('myIndex');
	Route::get('composant', MonComposant::class)->name('composant');
});

Volt::route('/posts/create', CreatePost::class)->name('posts.create');

Volt::route('/counter1', 'divers/counter1')->name('counter1');
Volt::route('/counter2', Counter2::class)->name('counter2');
Volt::route('/counters', 'divers/counters')->name('counters');
Volt::route('/next', 'divers/next')->name('next');

// Route::pattern('category', '(?!users|user|categories\/create)[A-Za-z0-9]+');
Volt::route('/{category}/{param?}', 'index')->name('home');
