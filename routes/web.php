<?php

use App\Http\Controllers\AchievementController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\StudentController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/student', function () {
    return Inertia::render('Student/Index');
});

Route::get('/student/post', function () {
    return Inertia::render('Student/Post');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/semester',             [SemesterController::class,     'index'])->name('semester.index');
    Route::post('/semester/save',       [SemesterController::class,     'storeSemester'])->name('semester.store');
    Route::patch('/semester/update',    [SemesterController::class,     'updateSemester'])->name('semester.update');
    Route::get('/student',              [StudentController::class,      'index'])->name('admin.student.index');
    Route::post('/student/save',        [StudentController::class,      'storeStudent'])->name('admin.student.store');
    Route::patch('/student/update',     [StudentController::class,      'updateStudent'])->name('admin.student.update');
    Route::get('/post',                 [PostController::class,         'index'])->name('admin.post.index');
    Route::post('/post/save',           [PostController::class,         'storePost'])->name('admin.post.store');
    Route::patch('/post/update',        [PostController::class,         'updatePost'])->name('admin.post.update');
    Route::post('/post/update/image',   [PostController::class,         'handleImageUpdate'])->name('admin.post.update_image');
    // Route::get('/achievement',          [AchievementController::class, 'index'])->name('admin.achievement.index');
    // Route::get('/announcement',         [AnnouncementController::class, 'index'])->name('admin.announcement.index');
    Route::get('/category',             [CategoryController::class, 'index'])->name('admin.category.index');
    Route::get('/material',             [MaterialController::class, 'index'])->name('admin.material.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
