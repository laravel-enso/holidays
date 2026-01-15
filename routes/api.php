<?php

use Illuminate\Support\Facades\Route;
use LaravelEnso\Holidays\Http\Controllers\Index;
use LaravelEnso\Holidays\Http\Controllers\Show;
use LaravelEnso\Holidays\Http\Controllers\Toggle;

Route::middleware(['api', 'auth', 'core'])
    ->prefix('api/holidays')
    ->as('holidays.')
    ->group(function () {
        Route::get('', Index::class)->name('index');
        Route::get('{holiday}/toggle', Toggle::class)->name('toggle');
        Route::get('{holidayYear}', Show::class)->name('show');
    });
