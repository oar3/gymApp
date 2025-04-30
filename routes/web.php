<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Broadcast;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\ExerciseController;
use App\Models\Workout;
use App\Events\WorkoutRecorded;
use App\Http\Controllers\BroadcastController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\TemplateController;

Route::view('/', 'welcome');
Route::view('/about', 'about');
Route::view('/exercises', 'exercises.index');
//Route::view('/standards', 'standards');
Route::view('/broadcasts', 'broadcasts.index');
//Mail test route
Route::view('/mail-test', 'mail.test');

// User Preference Routes
Route::middleware('auth')->group(function () {
    Route::patch('/user/preferences', [App\Http\Controllers\UserPreferenceController::class, 'update'])
        ->name('user.preferences.update');
});

// Exercise Routes
Route::middleware('auth')->group(function () {
    Route::get('/exercises', [ExerciseController::class, 'index'])->name('exercises.index');
    Route::get('/exercises/create', [ExerciseController::class, 'create'])->name('exercises.create');
    Route::post('/exercises', [ExerciseController::class, 'store'])->name('exercises.store');
    Route::get('/exercises/{exercise}/edit', [ExerciseController::class, 'edit'])->name('exercises.edit')
        ->can('edit', 'exercise');
    Route::patch('/exercises/{exercise}', [ExerciseController::class, 'update'])->name('exercises.update');
//        ->can('update', 'exercise');
    Route::post('/workouts/{workout}/duplicate', [WorkoutController::class, 'duplicate'])->middleware('auth');
    Route::delete('/exercises/{exercise}', [ExerciseController::class, 'destroy'])->name('exercises.destroy');
//        ->can('destroy', 'exercise');
});

// Workout Routes
Route::middleware('auth')->group(function () {
    Route::get('/workouts', [WorkoutController::class, 'index'])->name('workouts.index');
    Route::get('/workouts/create', [WorkoutController::class, 'create'])->name('workouts.create');
    Route::post('/workouts', [WorkoutController::class, 'store'])->name('workouts.store');
    Route::get('/workouts/{workout}', [WorkoutController::class, 'show'])->name('workouts.show')
        ->can('show', 'workout');
    Route::get('/workouts/{workout}/edit', [WorkoutController::class, 'edit'])->name('workouts.edit')
        ->can('edit', 'workout');
    Route::patch('/workouts/{workout}', [WorkoutController::class, 'update'])->name('workouts.update');
    Route::delete('/workouts/{workout}', [WorkoutController::class, 'destroy'])->name('workouts.destroy');
});

// Template Routes
Route::middleware('auth')->group(function () {
    Route::get('/templates', [TemplateController::class, 'index'])->name('templates.index');
    Route::get('/templates/create', [TemplateController::class, 'create'])->name('templates.create');
    Route::post('/templates', [TemplateController::class, 'store'])->name('templates.store');
    Route::get('/templates/{template}', [TemplateController::class, 'show'])->name('templates.show');
    Route::get('/templates/{template}/edit', [TemplateController::class, 'edit'])->name('templates.edit');
    Route::patch('/templates/{template}', [TemplateController::class, 'update'])->name('templates.update');
    Route::delete('/templates/{template}', [TemplateController::class, 'destroy'])->name('templates.destroy');
    Route::get('/templates/{template}/create-workout', [TemplateController::class, 'createWorkout'])->name('templates.create-workout');
});

// Broadcast Routes
//Route::middleware('auth')->group(function () {
//    Route::get('broadcasts', function () {
//        WorkoutRecorded::dispatch();
//
//        event(new Workout);
//    });
//});

Route::get('/broadcasts', [BroadcastController::class, 'index'])->name('broadcasts');

//Profile and password routes
Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Password routes
    Route::get('/profile/password', [ProfileController::class, 'editPassword'])->name('password.edit');
    Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('password.update');
});

// Mail routes
Route::get('test', function () {
    \Illuminate\Support\Facades\Mail::to('otis@klever.co.uk')->send(
        new \App\Mail\UserCreated()
    );

    return 'done';
});

// Authentication Routes
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');

// Password Reset Routes
Route::get('/forgot-password', [ResetPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [ResetPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'reset'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [ResetPasswordController::class, 'update'])
    ->middleware('guest')
    ->name('password.update');
