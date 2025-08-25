<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Ruta de inicio - página personalizada del restaurante
Route::get('/', function () {
    return view('welcome');
});

// Dashboard principal (requiere autenticación)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas de perfil (requieren autenticación)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas para gestión de usuarios (solo administradores)
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    // CRUD completo de usuarios
    Route::resource('users', UserController::class);
    
    // Rutas adicionales para gestión de usuarios
    Route::patch('/users/{user}/make-admin', [UserController::class, 'makeAdmin'])->name('users.make-admin');
    Route::patch('/users/{user}/make-empleado', [UserController::class, 'makeEmpleado'])->name('users.make-empleado');
    Route::patch('/users/{user}/toggle-role', [UserController::class, 'toggleRole'])->name('users.toggle-role');
});

// Rutas para gestión de productos (administradores y empleados)
Route::middleware(['auth', 'verified', 'role:admin,empleado'])->group(function () {
    // CRUD completo de productos
    Route::resource('products', ProductController::class);
    
    // Rutas adicionales para gestión de productos
    Route::patch('/products/{product}/toggle-availability', [ProductController::class, 'toggleAvailability'])->name('products.toggle-availability');
    Route::post('/products/{product}/duplicate', [ProductController::class, 'duplicate'])->name('products.duplicate');
    Route::get('/products-export', [ProductController::class, 'exportCsv'])->name('products.export');
    
    // API endpoints para búsqueda y filtros
    Route::get('/api/products/search', [ProductController::class, 'apiSearch'])->name('api.products.search');
    Route::get('/api/products/by-category/{category}', [ProductController::class, 'apiByCategory'])->name('api.products.by-category');
});

require __DIR__.'/auth.php';