<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AccountController;

Route::get('/', function () {
	return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
	Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
	Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
	Route::get('/account', [AccountController::class, 'edit'])->name('account.settings');
	Route::put('/account', [AccountController::class, 'update'])->name('account.update');

	Route::prefix('admin')->name('admin.')->group(function () {
		Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
		Route::resource('siswa', StudentController::class)->parameters([
			'siswa' => 'siswa'
		])->names('siswa');
	});
});
