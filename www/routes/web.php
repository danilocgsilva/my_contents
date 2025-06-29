<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContentsController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('contents', ContentsController::class);
