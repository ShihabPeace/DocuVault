<?php

use App\Http\Controllers\WidgetController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [WidgetController::class, 'index'])->name('dashboard');

Route::post('/checked', [WidgetController::class, 'checked'])->name('checked');

Route::post('/remove', [WidgetController::class, 'remove'])->name('remove');

Route::post('/approve', [WidgetController::class, 'approve'])->name('approve');

Route::post('/cancel', [WidgetController::class, 'cancel'])->name('cancel');