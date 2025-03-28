<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/about', function () {
    return '<h1>Halaman About</h1>';
});
Route::get('/contack', function () {
    return '<h1>Halaman contact</h1>';
});
