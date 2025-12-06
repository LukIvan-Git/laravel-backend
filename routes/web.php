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
use App\Http\Controllers\Frontend\HomepageController;

Route::get('/', function () {
    return redirect()->route('homepage', app()->getLocale());
});

Route::prefix('{locale}')->middleware('locale')->group(function () {
    Route::get('/homepage', [HomepageController::class, 'index'])->name('homepage');

    Route::get('/my-careers', function () {
        return view('my_careers');
    })->name('my_careers');

    Route::get('/contact-me', function () {
        return view('contact_me');
    })->name('contact_me');
    
});