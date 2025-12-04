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
    return redirect()->route('home', app()->getLocale());
});

Route::prefix('{locale}')->middleware('locale')->group(function () {
    Route::get('/home', function () {
        return view('welcome');
    })->name('home');

    Route::get('/my-career', function () {
        return view('my_career');
    })->name('my_career');

    Route::get('/contact-me', function () {
        return view('contact_me');
    })->name('contact_me');
    
});