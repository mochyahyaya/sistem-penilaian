<?php

use Illuminate\Support\Facades\Route;

// Admin
use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Admin\Penilaian;
use App\Http\Controllers\Admin\LaporanPenilaian;
use App\Http\Controllers\Admin\Student;

//Student
use App\Http\Controllers\Student\LihatNilai;
use App\Http\Controllers\Student\Profile;
use App\Http\Controllers\Student\StudentDashboard;
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
    return view('auth/login');
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
    
    //Laporan Penilaian
    Route::get('laporan-penilaian', [LaporanPenilaian::class, 'index'])->name('admin/laporan-penilaian');
    Route::get('laporan-penilaian-fetch', [LaporanPenilaian::class, 'fetch'])->name('admin/laporanFetch');

    //Siswa
    Route::get('student', [Student::class, 'index'])->name('admin/student');
    Route::get('student-fetch', [Student::class, 'fetch'])->name('admin/studentFetch');
    Route::post('student-store', [Student::class, 'store'])->name('admin/studentStore');
    Route::get('student-edit/{id}', [Student::class, 'edit']);
    Route::put('student-update/{id}', [Student::class, 'update']);
    Route::delete('student-delete/{id}', [Student::class, 'destroy']);
});

Route::prefix('student')->group(function () {
    Route::get('dashboard', [StudentDashboard::class, 'index'])->name('student/dashboard');

    Route::get('lihat-nilai', [LihatNilai::class, 'index'])->name('student/LihatNilai');
    Route::get('lihat-nilai-fetch', [LihatNilai::class, 'fetch'])->name('student/nilaiFetch');
    Route::post('input-nilai', [LihatNilai::class, 'store'])->name('student/nilaiStore');
    Route::get('input-nilai-edit/{id}', [LihatNilai::class, 'edit']);
    Route::put('input-nilai-update/{id}', [LihatNilai::class, 'update']);
    Route::delete('input-nilai-delete/{id}', [LihatNilai::class, 'destroy']);

    Route::get('lihat-profile', [Profile::class, 'index'])->name('student/profile');
    Route::put('update-profile', [Profile::class, 'update'])->name('student/profileUpdate');
});