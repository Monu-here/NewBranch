<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Branch\BranchController as BranchBranchController;
use App\Http\Controllers\Branch\LoginController as BranchLoginController;
use App\Http\Controllers\Branch\StudentController as BranchStudentController;
use App\Http\Controllers\khskjds;
use Illuminate\Support\Facades\Route;



Route::prefix('admin')->name('admin.')->group(function () {
    Route::match(['GET', 'POST'], '', [LoginController::class, 'login'])->name('login');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::prefix('admin-dashboard')->name('admin-dashboard.')->group(function () {
        Route::get('', [AdminController::class, 'index'])->name('index');
        Route::get('profile', [LoginController::class, 'profile'])->name('profile');
        Route::prefix('branch')->name('branch.')->group(function () {
            Route::get('', [BranchController::class, 'index'])->name('index');
            Route::get('show/{slug}', [BranchController::class, 'show'])->name('show');
            Route::match(['GET', 'POST'], 'add', [BranchController::class, 'add'])->name('add');
            Route::match(['GET', 'POST'], 'edit/{slug}', [BranchController::class, 'edit'])->name('edit');
            Route::get('del/{slug}', [BranchController::class, 'del'])->name('del');
        });
        Route::prefix('student')->name('student.')->group(function () {
            Route::get('', [StudentController::class, 'studentIndex'])->name('index');
            Route::get('show/{slug}', [StudentController::class, 'studentShow'])->name('show');
            Route::match(['GET', 'POST'], 'add', [StudentController::class, 'studentAdd'])->name('add');
            Route::match(['GET', 'POST'], 'edit/{slug}', [StudentController::class, 'studentEdit'])->name('edit');
            Route::get('del/{slug}', [StudentController::class, 'studentDel'])->name('del');
        });
    });

    // Branch Login Routes
    Route::prefix('branch-dashboard')->middleware(['auth', 'branch'])->name('branch-dashboard.')->group(function () {
        Route::get('', [BranchBranchController::class, 'index'])->name('index');
        Route::get('profile', [BranchLoginController::class, 'profile'])->name('profile');
        Route::prefix('student')->name('student.')->group(function () {
            Route::get('', [BranchStudentController::class, 'studentIndex'])->name('index');
            Route::get('show/{slug}', [BranchStudentController::class, 'studentShow'])->name('show');
            Route::match(['GET', 'POST'], 'add', [BranchStudentController::class, 'studentAdd'])->name('add');
            Route::match(['GET', 'POST'], 'edit/{slug}', [BranchStudentController::class, 'studentEdit'])->name('edit');
            Route::get('del/{slug}', [BranchStudentController::class, 'studentDel'])->name('del');
        });
    });
});
