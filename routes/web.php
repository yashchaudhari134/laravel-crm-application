<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\FollowUpController;

Route::resource('leads', LeadController::class);
Route::get('/', function () {
    return view('welcome');
});

Route::resource('follow-ups',FollowUpController::class);

