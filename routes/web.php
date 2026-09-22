<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeadController;

Route::resource('leads', LeadController::class);
Route::get('/', function () {
    return view('welcome');
});
