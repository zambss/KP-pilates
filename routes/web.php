<?php

use Illuminate\Support\Facades\Route;

// routes/web.php
Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/fasilitas', function () {
    return view('fasilitas');
});

Route::get('/coach', function () {
    return view('coach');
});

Route::get('/event', function () {
    return view('event');
});

Route::get('/faq', function () {
    return view('faq');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/join-class', function () {
    return view('join-class');
});