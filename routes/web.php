<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TimeslotController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    # authentication related routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    # Routes related to time slots
    Route::get('/timeslots', [TimeslotController::class, 'index'])->name('timeslots.index');
    Route::get('/timeslots/create', [TimeslotController::class, 'create'])->name('timeslots.create');
    Route::post('/timeslots/store', [TimeslotController::class, 'store'])->name('timeslots.store');
    Route::get('/timeslots/edit/{id}', [TimeslotController::class, 'edit'])->name('timeslots.edit');
    Route::get('/timeslots/destroy', [TimeslotController::class, 'destroy'])->name('timeslots.destroy');

    # Routes related to goals
    Route::get('/goals', [GoalController::class, 'index'])->name('goals.index');
    Route::get('/goals/create', [GoalController::class, 'create'])->name('goals.create');
    Route::post('/goals/store', [GoalController::class, 'store'])->name('goals.store');
    Route::get('/goals/edit/{id}', [GoalController::class, 'edit'])->name('goals.edit');
    Route::patch('/goals/update/{id}', [GoalController::class, 'update'])->name('goals.update');
    Route::delete('/goals/{id}', [GoalController::class, 'destroy'])->name('goals.destroy');
    Route::post('/goals/{id}/generate-more-tasks', [GoalController::class, 'generateMoreTasks'])->name('goals.generateMoreTasks');

    # Routes related to goals
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/tasks/goal/{goalId}', [TaskController::class, 'list'])->name('tasks.list');
    Route::get('/tasks/edit/{id}', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::patch('/tasks/update/{id}', [TaskController::class, 'update'])->name('tasks.update');
    Route::get('/tasks/finish', [TaskController::class, 'finish'])->name('tasks.finish');
    Route::get('/tasks/postpone', [TaskController::class, 'postpone'])->name('tasks.postpone');
    Route::get('/tasks/dismiss', [TaskController::class, 'dismiss'])->name('tasks.dismiss');
});

require __DIR__ . '/auth.php';
