<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::get('/login', static fn () => 'hello world ')->name('login');
