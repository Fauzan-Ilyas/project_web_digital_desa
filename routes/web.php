<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cek-env', function () {
    return env('APP_KEY');
});

Route::get('/cek-di', function (UserController $controller) {
    return 'Berhasil resolve UserController dan dependensinya!';
});

