<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassController;

Route::prefix('/class')->group(function () {
    Route::get('/', [ClassController::class, 'getClasses'])->name('Classes');
    Route::post('/book', [ClassController::class, 'postClass'])->name('BookClass');
    Route::delete('/{bookedClass}/cancel', [ClassController::class, 'deleteClass'])->name('DeleteClass');
});