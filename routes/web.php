<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('template');
});

// Ruta Panel
Route::view('/panel', 'panel.index')->name('panel');
// Ruta Categorías
Route::resource('/category', CategoryController::class);

// Ruta Login
Route::get('/login', function () {
    return view('auth.login');
});

// Ruta 401
Route::get('/401', function () {
    return view('pages.401');
});

// Ruta 404
Route::get('/404', function () {
    return view('pages.404');
});

// Ruta 500
Route::get('/500', function () {
    return view('pages.500');
});
