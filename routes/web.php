<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/jwa', function () {
    return "Jimmy Wira Arbaa";
});

Route::redirect('/jimmy', '/jwa');

Route::get('/hello', function () {
    return view('hello', ['name' => 'Jimmy']);
});

// Error 404
Route::fallback(function () {
    return "Error 404 by Jimmy Wira Arbaa";
});
