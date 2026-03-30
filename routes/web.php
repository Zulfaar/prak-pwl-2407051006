<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserManagementController;

Route::get('/user-management', [UserManagementController::class, 'index']);
Route::get('/user-management/create', [UserManagementController::class, 'create'])->name('user-management.create');
Route::post('/user-management', [UserManagementController::class, 'store'])->name('user-management.store');


Route::get('/', function () {
    return view('welcome');
});
