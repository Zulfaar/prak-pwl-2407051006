<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserManagementController;

Route::get('/user-management', [UserManagementController::class, 'index'])->name('user-management.index');
Route::get('/user-management/create', [UserManagementController::class, 'create'])->name('user-management.create');
Route::post('/user-management', [UserManagementController::class, 'store'])->name('user-management.store');
Route::put('/user-management/{id}', [UserManagementController::class, 'update'])->name('user-management.update');
Route::delete('/user-management/{id}', [UserManagementController::class, 'destroy'])->name('user-management.destroy');


Route::get('/', function () {
    return view('welcome');
});
