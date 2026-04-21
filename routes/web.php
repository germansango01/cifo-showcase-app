<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

<<<<<<< HEAD
// Ruta de prueba...
// Route::get('/hola', function () {
//     return '<h1>hola!</h1>';
// });
=======
Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

/*
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

});
*/
>>>>>>> main
