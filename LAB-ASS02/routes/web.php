<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserRegistrationController;

Route::get('/', function () {
    return redirect()->route('users.index');
});

Route::resource('users', UserRegistrationController::class);