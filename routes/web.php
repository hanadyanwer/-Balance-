<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DailyPlanController;
use App\Http\Controllers\StoryController;

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
Route::get('/recipes', [PageController::class, 'recipes'])->name('recipes');
Route::get('/water-tracking', [PageController::class, 'waterTracking'])->name('water-tracking');

// CSRF Token Refresh Route
Route::get('/refresh-csrf', function() {
    return response()->json(['token' => csrf_token()]);
});

// Profile Setup Routes (للمستخدمين الجدد - يجب أن تكون قبل middleware profile.complete)
Route::middleware('auth')->group(function () {
    Route::get('/profile/setup', [ProfileController::class, 'showSetup'])->name('profile.setup');
    Route::post('/profile/setup', [ProfileController::class, 'saveSetup'])->name('profile.setup.save');
});

// Protected Routes (requires authentication + profile completion)
Route::middleware(['auth', 'profile.complete'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Daily Plan Routes
    Route::get('/daily-plan', [DailyPlanController::class, 'index'])->name('daily-plan');
    Route::post('/daily-plan/regenerate', [DailyPlanController::class, 'regenerate'])->name('daily-plan.regenerate');

    // Story Routes
    Route::post('/stories', [StoryController::class, 'store'])->name('stories.store');
});

Route::get('/reset', [PageController::class, 'reset'])->name('reset');

// المصادقة
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup');
Route::get('/admin/login', [AuthController::class, 'showAdminLogin'])->name('admin.login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login.submit');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// صفحات الإدارة (Admin) - Require Admin Access
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Notifications
    Route::get('/notifications', [AdminController::class, 'getNotifications'])->name('admin.notifications');
    Route::post('/notifications/{id}/read', [AdminController::class, 'markNotificationAsRead'])->name('admin.notifications.read');
    Route::post('/notifications/read-all', [AdminController::class, 'markAllNotificationsAsRead'])->name('admin.notifications.read-all');

    // Recipes Management
    Route::get('/recipes', [AdminController::class, 'recipesIndex'])->name('admin.recipes.index');
    Route::get('/recipes/create', [AdminController::class, 'recipesCreate'])->name('admin.recipes.create');
    Route::post('/recipes', [AdminController::class, 'recipesStore'])->name('admin.recipes.store');
    Route::get('/recipes/{recipe}/edit', [AdminController::class, 'recipesEdit'])->name('admin.recipes.edit');
    Route::put('/recipes/{recipe}', [AdminController::class, 'recipesUpdate'])->name('admin.recipes.update');
    Route::delete('/recipes/{recipe}', [AdminController::class, 'recipesDestroy'])->name('admin.recipes.destroy');

    // Workouts Management
    Route::get('/workouts', [AdminController::class, 'workoutsIndex'])->name('admin.workouts.index');
    Route::get('/workouts/create', [AdminController::class, 'workoutsCreate'])->name('admin.workouts.create');
    Route::post('/workouts', [AdminController::class, 'workoutsStore'])->name('admin.workouts.store');
    Route::get('/workouts/{workout}/edit', [AdminController::class, 'workoutsEdit'])->name('admin.workouts.edit');
    Route::put('/workouts/{workout}', [AdminController::class, 'workoutsUpdate'])->name('admin.workouts.update');
    Route::delete('/workouts/{workout}', [AdminController::class, 'workoutsDestroy'])->name('admin.workouts.destroy');

    // Tips Management
    Route::get('/tips', [AdminController::class, 'tipsIndex'])->name('admin.tips.index');
    Route::get('/tips/create', [AdminController::class, 'tipsCreate'])->name('admin.tips.create');
    Route::post('/tips', [AdminController::class, 'tipsStore'])->name('admin.tips.store');
    Route::get('/tips/{tip}/edit', [AdminController::class, 'tipsEdit'])->name('admin.tips.edit');
    Route::put('/tips/{tip}', [AdminController::class, 'tipsUpdate'])->name('admin.tips.update');
    Route::delete('/tips/{tip}', [AdminController::class, 'tipsDestroy'])->name('admin.tips.destroy');

    // Daily Plans Management
    Route::get('/daily-plans', [AdminController::class, 'dailyPlansIndex'])->name('admin.daily-plans.index');

    // Hydration/Drink Water Management
    Route::get('/hydration', [AdminController::class, 'hydrationIndex'])->name('admin.hydration.index');

    // Stories Management
    Route::get('/stories', [AdminController::class, 'storiesIndex'])->name('admin.stories.index');
    Route::post('/stories/{id}/approve', [AdminController::class, 'storiesApprove'])->name('admin.stories.approve');
    Route::post('/stories/{id}/reject', [AdminController::class, 'storiesReject'])->name('admin.stories.reject');
    Route::delete('/stories/{id}', [AdminController::class, 'storiesDestroy'])->name('admin.stories.destroy');
});
