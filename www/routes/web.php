<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContentsController;

Route::get('/', function () {
    return redirect()->route('contents.index');
});

Route::resource('contents', ContentsController::class);
