<?php

use Illuminate\Support\Facades\Route;

// routes/web.php
Route::get('/', function () {
    return view('home');
});