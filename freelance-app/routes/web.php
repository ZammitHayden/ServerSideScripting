<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;

Route::get('/', function () {
    return redirect()->route('listings.index');
});

Route::resource('listings', ListingController::class)->parameters(['listings' => 'listing:id']);
