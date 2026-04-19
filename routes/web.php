<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Ruta de prueba...
// Route::get('/hola', function () {
//     return '<h1>hola!</h1>';
// });
