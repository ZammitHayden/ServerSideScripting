<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;

//When the root URL is accessed, returns the Index page.
Route::get('/', function () {
    return redirect()->route('listings.index');
});

//handles all CRUD operations for listings
Route::resource('listings', ListingController::class);

//handles sending messages to listing owners
Route::post('/listings/{listing}/message', [ListingController::class, 'sendMessage'])->name('listings.message');
