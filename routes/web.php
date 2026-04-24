<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Front\PageController;
use App\Http\Controllers\Front\ProjectController;
use Illuminate\Support\Facades\Route;

// ── Language switcher ────────────────────────────────────────
Route::get('/language/{locale}', function (string $locale) {
    if (in_array($locale, ['es', 'ca'])) {
        session(['locale' => $locale]);
        app()->setLocale($locale);
    }

    return redirect()->back();
})->name('language');

// ── Front public ─────────────────────────────────────────────
Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/projects', [ProjectController::class, 'index'])->name('projects');
Route::get('/projects/{project:slug}', [ProjectController::class, 'show']) ->name('projects.show');
Route::get('/about', [PageController::class, 'about'])->name('about');

// ── Admin Dashboard ──────────────────────────────────────────
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class,   'edit']) ->name('profile.edit');

    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class)->except('show');
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
});
