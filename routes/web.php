<?php
// routes/web.php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudyRoomController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-zoom', [StudyRoomController::class, 'testZoom'])->middleware('auth');
Route::get('/debug-zoom', [StudyRoomController::class, 'debugZoom'])->middleware('auth');

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes
Route::middleware('auth')->group(function () {
    Route::get('/rooms', [StudyRoomController::class, 'index'])->name('rooms.index');
    Route::get('/rooms/create', [StudyRoomController::class, 'create'])->name('rooms.create');
    Route::post('/rooms', [StudyRoomController::class, 'store'])->name('rooms.store');
    Route::get('/rooms/{id}', [StudyRoomController::class, 'show'])->name('rooms.show');
    Route::post('/rooms/{id}/join', [StudyRoomController::class, 'join'])->name('rooms.join');
    Route::post('/rooms/{id}/leave', [StudyRoomController::class, 'leave'])->name('rooms.leave');
});