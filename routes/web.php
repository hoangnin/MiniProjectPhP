<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {

    // 1. Project list
    Route::get('projects', function () {
        $projects = \App\Models\Project::all();
        return view('projects.index', compact('projects'));
    })->name('projects.index');

    // 2. Task list trong project
    Route::get('projects/{project}', function (\App\Models\Project $project) {
        return view('projects.show', compact('project'));
    })->name('projects.show');

    // 3. CRUD task nested
    Route::resource('projects.tasks', TaskController::class);

});

