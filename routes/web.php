<?php

use Illuminate\Support\Facades\Route;

// Admin
use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Admin\Penilaian;
use App\Http\Controllers\Admin\Student;

//Student
use App\Http\Controllers\Student\LihatNilai;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->group(function () {
    Route::get('dashboard', [Dashboard::class, 'index'])->name('admin/dashboard');

    //Penilaian
    Route::get('penilaian', [Penilaian::class, 'index'])->name('admin/penilaian');
    Route::get('penilaian-fetch', [Penilaian::class, 'fetch'])->name('admin/penilaianFetch');
    Route::post('penilaian-store', [Penilaian::class, 'store'])->name('admin/penilaianStore');
    Route::get('penilaian-edit/{id}', [Penilaian::class, 'edit']);
    Route::put('penilaian-update/{id}', [Penilaian::class, 'update'])->name('admin/penilaianUpdate');

    //Siswa
    Route::get('student', [Student::class, 'index'])->name('admin/student');
    Route::get('student-fetch', [Student::class, 'fetch'])->name('admin/studentFetch');
    Route::post('student-store', [Student::class, 'store'])->name('admin/studentStore');
    Route::get('student-edit/{id}', [Student::class, 'edit']);
    Route::put('student-update/{id}', [Student::class, 'update']);
    Route::delete('student-delete/{id}', [Student::class, 'destroy']);
});

Route::prefix('student')->group(function () {
    Route::get('lihat-nilai', [LihatNilai::class, 'index'])->name('student/LihatNilai');
    // Route::get('lihat-profile', [Profile::class, 'index'])->name('student/LihatProfile');
});