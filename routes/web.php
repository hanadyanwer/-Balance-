<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// الصفحات الرئيسية
Route::get('/', [PageController::class, 'index'])->name('index');
Route::get('/home', [PageController::class, 'home'])->name('home');
Route::get('/workouts', [PageController::class, 'workouts'])->name('workouts');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/daily-plan', [PageController::class, 'dailyPlan'])->name('daily-plan');
Route::get('/recipes', [PageController::class, 'recipes'])->name('recipes');
Route::get('/profile', [PageController::class, 'profile'])->name('profile');
Route::get('/reset', [PageController::class, 'reset'])->name('reset');

// المصادقة
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// صفحات الإدارة (Admin)
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/daily', [AdminController::class, 'dailyAdmin'])->name('admin.daily');
    Route::get('/workouts', [AdminController::class, 'workoutAdmin'])->name('admin.workouts');
    Route::get('/drinks', [AdminController::class, 'drinksAdmin'])->name('admin.drinks');
    Route::get('/recipes', [AdminController::class, 'recipesAdmin'])->name('admin.recipes');
    Route::get('/tips', [AdminController::class, 'tipsAdmin'])->name('admin.tips');
    Route::get('/login', [AdminController::class, 'loginAdmin'])->name('admin.login');
    Route::get('/reset', [AdminController::class, 'resetAdmin'])->name('admin.reset');
});
