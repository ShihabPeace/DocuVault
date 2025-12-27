<?php

use App\Http\Controllers\WidgetController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('dashboard');
})->name('dashboard');

Route::get('/', [WidgetController::class,'index'])->name('dashboard');



