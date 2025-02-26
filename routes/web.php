<?php

use Illuminate\Support\Facades\Route;

// Example custom route for administrators
Route::middleware(['web', 'auth'])->prefix('admin')->group(function () {
    Route::get('/extra-settings', function () {
        return 'This is an example route for extra settings!';
    });
});