<?php

use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\Admin\ProjectController;
use Illuminate\Support\Facades\Route;

/* ──────────────────────────────────────────────
 | Public portfolio routes
──────────────────────────────────────────────*/
Route::get('/', [PortfolioController::class, 'index'])->name('home');
Route::post('/contact', [PortfolioController::class, 'contact'])->name('contact');

/* ──────────────────────────────────────────────
 | Admin routes — protect with auth middleware
 | Auth scaffolding is not installed, so remove auth until login is added.
 | Run: php artisan make:auth  OR use Breeze/Fortify when ready
──────────────────────────────────────────────*/
Route::prefix('admin')->name('admin.')->group(function () {

    /* Projects CRUD */
    Route::get('/',                                      [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/create',                       [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects',                             [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{project}/edit',               [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/projects/{project}',                    [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{project}',                 [ProjectController::class, 'destroy'])->name('projects.destroy');
    Route::patch('/projects/{project}/toggle-visibility',[ProjectController::class, 'toggleVisibility'])->name('projects.toggle-visibility');
    Route::patch('/projects/{project}/toggle-featured',  [ProjectController::class, 'toggleFeatured'])->name('projects.toggle-featured');

    /* Messages */
    Route::get('/messages',                              [ProjectController::class, 'messages'])->name('messages');
    Route::delete('/messages/{message}',                 [ProjectController::class, 'destroyMessage'])->name('messages.destroy');
});
