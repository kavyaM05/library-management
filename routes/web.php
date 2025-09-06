<?php

use App\Http\Controllers\LibraryController;
use Illuminate\Support\Facades\Route;


Route::controller(LibraryController::class)->group(function () {
    Route::get('/', 'index')->name('books.index');
    Route::post('save', 'save')->name('book.save');
    Route::get('list', 'list')->name('books.list');
});
