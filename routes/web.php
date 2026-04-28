<?php

use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Front\PageController;
use App\Http\Controllers\Front\ProjectController;
use Illuminate\Support\Facades\Route;

// ── Redirect root to default locale ──────────────────────────
Route::get('/', fn () => redirect('/es'));


// ── Front public ─────────────────────────────────────────────

Route::prefix('{locale}')
    ->where(['locale' => 'es|ca'])
    ->middleware('locale')
    ->group(function () {
        Route::get('/', [PageController::class, 'index'])->name('home');
        Route::get('/projects', [ProjectController::class, 'index'])->name('projects');
        Route::get('/projects/{project:slug}', [ProjectController::class, 'show'])->name('projects.show');
        Route::get('/about', [PageController::class, 'about'])->name('about');
    });


// ── Admin Dashboard ──────────────────────────────────────────

Route::middleware(['auth', 'verified'])
->prefix('admin')
->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class)->except('show');
    Route::resource('courses', CourseController::class)->except('show');
    Route::resource('tags', TagController::class)->except('show');
    Route::resource('permissions', PermissionController::class)->except('show');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
});

/*

// Admin
Route::middleware(['auth', 'verified', 'admin.locale'])  // ← antes 'setAdminLocale'
    ->prefix('admin')
    ->group(function () {
        // ...
    });

*/
