<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FuturismController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\StudentController;
use App\Models\Achievement;
use App\Models\Announcement;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/',                                     [GeneralController::class, 'index'])->name('home');
Route::post('/section/update',                      [GeneralController::class, 'updateSection'])->name('section.update');


Route::get('/about',                                [AboutController::class, 'index'])->name('about');
Route::get('/mission',                              [AboutController::class, 'mission'])->name('mission');
Route::get('/vision',                               [AboutController::class, 'vision'])->name('vision');
Route::get('/objectives',                           [AboutController::class, 'objective'])->name('objectives');
Route::get('/org-chart',                            [AboutController::class, 'orgChart'])->name('org-chart');
Route::post('/about/update',                        [AboutController::class, 'update'])->name('about.update');

Route::get('/contactus', function () {
    return Inertia::render('Contact');
})->name('contact');

// Route::get('/student', function () {
//     return Inertia::render('Student/Index');
// });

// Route::get('/student/post', function () {
//     return Inertia::render('Student/Post');
// });

Route::get('/dashboard',                        [DashboardController::class,    'index'])->middleware(['auth', 'verified', 'isAdmin'])->name('dashboard');

Route::middleware(['auth', 'isAdmin'])->prefix('admin')->group(function () {
    Route::get('/semester',                     [SemesterController::class,     'index'])->name('semester.index');
    Route::get('/semester/student/register',    [SemesterController::class,     'registerStudentIndex'])->name('semester.register_student');
    Route::get('/semester/enrolled/student',    [SemesterController::class,     'enrolledStudentIndex'])->name('semester.enrolled_student');
    Route::post('/semester/save',               [SemesterController::class,     'storeSemester'])->name('semester.store');
    Route::post('/semester/student/register',   [SemesterController::class,     'registerStudent'])->name('semester.register_student_save');
    Route::patch('/semester/update',            [SemesterController::class,     'updateSemester'])->name('semester.update');

    Route::get('/student',                      [StudentController::class,      'index'])->name('admin.student.index');
    Route::post('/student/save',                [StudentController::class,      'storeStudent'])->name('admin.student.store');
    Route::patch('/student/update',             [StudentController::class,      'updateStudent'])->name('admin.student.update');

    Route::get('/post',                         [PostController::class,         'index'])->name('admin.post.index');
    Route::post('/post/save',                   [PostController::class,         'storePost'])->name('admin.post.store');
    Route::patch('/post/update',                [PostController::class,         'updatePost'])->name('admin.post.update');
    Route::delete('/post/delete',                [PostController::class,         'deletePost'])->name('admin.post.delete');
    Route::post('/post/update/image',           [PostController::class,         'handleImageUpdate'])->name('admin.post.update_image');

    Route::get('/futurism',                     [FuturismController::class,     'index'])->name('admin.futurism.index');
    Route::post('/futurism/save',               [FuturismController::class,     'storePost'])->name('admin.futurism.store');
    Route::patch('/futurism/update',            [FuturismController::class,     'updatePost'])->name('admin.futurism.update');
    Route::post('/post/update/image',           [FuturismController::class,     'handleImageUpdate'])->name('admin.futurism.update_image');
    Route::delete('/futurism/delete',           [FuturismController::class,     'deleteFuturism'])->name('admin.futurism.delete');

    // Route::get('/achievement',               [AchievementController::class, 'index'])->name('admin.achievement.index');
    // Route::get('/announcement',              [AnnouncementController::class, 'index'])->name('admin.announcement.index');

    Route::get('/category',                     [CategoryController::class, 'index'])->name('admin.category.index');
    Route::post('/category/save',               [CategoryController::class, 'storeCategory'])->name('admin.category.store');
    Route::patch('/category/save',              [CategoryController::class, 'updateCategory'])->name('admin.category.update');

    Route::get('/material',                     [MaterialController::class, 'index'])->name('admin.material.index');
    Route::post('/material/save',               [MaterialController::class, 'storeMaterial'])->name('admin.material.store');
    Route::post('/material/update',             [MaterialController::class, 'updateMaterial'])->name('admin.material.update');

    Route::get('/logs',                         [DashboardController::class,    'logs'])->name('admin.logs');
    Route::get('/update-password',              [GeneralController::class,      'updatePassword'])->name('admin.password');
    Route::put('password',                      [PasswordController::class,     'update'])->name('password.update');
    Route::patch('/contact/update',             [GeneralController::class,      'updateContact'])->name('admin.contact.update');
});

Route::get('/achievements',                  [AchievementController::class, 'index'])->name('achievement.index');
Route::get('/achievement/{id}',              [AchievementController::class, 'getSingleAchievement'])->name('achievement.id');
Route::get('/announcements',                 [AnnouncementController::class, 'index'])->name('announcement.index');
Route::get('/announcement/{id}',             [AnnouncementController::class, 'getSingleAnnouncement'])->name('announcement.id');
Route::get('/futurism/index/{category}',     [FuturismController::class, 'indexPublic'])->name('futurism.index');
Route::get('/futurism/{id}',                 [FuturismController::class, 'getSingleFuturism'])->name('futurism.id');

Route::get('/research',                      [MaterialController::class, 'indexPublic'])->middleware(['auth'])->name('research.index_public');
Route::get('/research/{id}',                 [MaterialController::class, 'getSingleMaterial'])->middleware(['auth'])->name('research.id');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('login',                             [LoginController::class, 'create'])->name('login');
Route::post('login',                            [LoginController::class, 'store']);
Route::post('logout',                           [LoginController::class, 'destroy'])->name('logout');

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});

Route::get('/artisan/migrate', function () {
    Artisan::call('migrate');
});
// require __DIR__.'/auth.php';
