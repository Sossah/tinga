<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SouscriptionController;


// Route pour la page d'accueil
Route::get('/', function () {
    return view('auth.login');
})->name('home');

//Auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// User management routes
Route::middleware(['auth'])->group(function () {
    // Users management
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    
    // Roles
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/{role}', [RoleController::class, 'show'])->name('roles.show');
    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
    
    // Permissions
    Route::resource('permissions', PermissionController::class);
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
});

Route::get('/search', [App\Http\Controllers\SearchController::class, 'index'])->name('search');

// Routes pour les souscriptions
Route::get('/souscriptions', [App\Http\Controllers\SouscriptionController::class, 'index'])->name('souscriptions.index');
Route::get('/souscriptions/create', [App\Http\Controllers\SouscriptionController::class, 'create'])->name('souscriptions.create');
Route::post('/souscriptions/create-step1', [App\Http\Controllers\SouscriptionController::class, 'storeStep1'])->name('souscriptions.store.step1');
Route::get('/souscriptions/create-step2', [App\Http\Controllers\SouscriptionController::class, 'createStep2'])->name('souscriptions.create.step2');
Route::post('/souscriptions/create-step2', [App\Http\Controllers\SouscriptionController::class, 'storeStep2'])->name('souscriptions.store.step2');

Route::get('/souscriptions/create', [SouscriptionController::class, 'create'])->name('souscriptions.create');
Route::post('/souscriptions/store-step1', [SouscriptionController::class, 'storeStep1'])->name('souscriptions.store.step1');
Route::get('/souscriptions/create-step2', [SouscriptionController::class, 'createStep2'])->name('souscriptions.create.step2');
Route::post('/souscriptions/store-step2', [SouscriptionController::class, 'storeStep2'])->name('souscriptions.store.step2');
Route::get('/souscriptions/confirmation/{id}', [App\Http\Controllers\SouscriptionController::class, 'confirmation'])->name('souscriptions.confirmation');
Route::get('/souscriptions/{id}', [App\Http\Controllers\SouscriptionController::class, 'show'])->name('souscriptions.show');
Route::get('/souscriptions/{id}/edit', [App\Http\Controllers\SouscriptionController::class, 'edit'])->name('souscriptions.edit');
Route::put('/souscriptions/{id}', [App\Http\Controllers\SouscriptionController::class, 'update'])->name('souscriptions.update');
Route::delete('/souscriptions/{id}', [App\Http\Controllers\SouscriptionController::class, 'destroy'])->name('souscriptions.destroy');

// Ajouter ces routes avec les autres routes de souscription
Route::put('/souscriptions/{id}/validate', [App\Http\Controllers\SouscriptionController::class, 'validateSouscription'])->name('souscriptions.validate');
Route::put('/souscriptions/{id}/reject', [App\Http\Controllers\SouscriptionController::class, 'rejectSouscription'])->name('souscriptions.reject');

// Routes pour les rapports
Route::get('/rapports', [App\Http\Controllers\RapportController::class, 'index'])->name('rapports.index');
Route::get('/rapports/souscriptions', [App\Http\Controllers\RapportController::class, 'souscriptions'])->name('rapports.souscriptions');
Route::get('/rapports/financiers', [App\Http\Controllers\RapportController::class, 'financiers'])->name('rapports.financiers');