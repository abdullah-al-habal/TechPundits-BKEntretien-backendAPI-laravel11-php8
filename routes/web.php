<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return "hello world ";
})->name('login');
