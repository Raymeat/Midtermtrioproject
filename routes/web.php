<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FilmController;

// 1. Rute HOMEPAGE (Bisa diakses semua orang)
Route::get('/', function () {
    return view('home');
})->name('home');


// 2. GRUP INI HANYA UNTUK YANG BELUM LOGIN (TAMU)
Route::middleware('guest:web,admin')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

    Route::post('/login', [UserController::class, 'login'])->name('login.action');
    Route::post('/register', [UserController::class, 'register'])->name('register.action');
});


// 3. GRUP INI UNTUK YANG SUDAH LOGIN (Maksimal satu dari dua guard harus lolos: web/admin)
Route::middleware('auth:web,admin')->group(function() {
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});


// 4. RUTE DASHBOARD USER (sudah merangkap list film)
// SEMUA RUTE USER YANG DI-PROTECT HARUS DI SINI
Route::prefix('user')->middleware('auth:web')->group(function () {
    // Dashboard User (sekarang jadi list film)
    Route::get('/dashboard', [FilmController::class, 'listUserFilms'])->name('user.dashboard');
    
    // Halaman Settings (TAMBAHAN LU DISINI)
    Route::get('/settings', function () {
        return view('user.settings');
    })->name('user.settings');

    // Rute untuk memproses perubahan PROFIL (Nama & Email)
    Route::post('/update-profile', [UserController::class, 'updateProfile'])->name('user.updateProfile');

    // Rute untuk memproses perubahan PASSWORD
    Route::post('/update-password', [UserController::class, 'updatePassword'])->name('user.updatePassword');
    
    // Halaman Nonton Trailer/Detail
    Route::get('/films/{film}', [FilmController::class, 'showUser'])->name('user.films.show');

    // Watchlist (Memori Tersimpan)
    Route::post('/films/{film}/watchlist', [FilmController::class, 'handleWatchlist'])->name('user.films.watchlist');
    Route::get('/watchlist', [FilmController::class, 'showWatchlist'])->name('user.films.showWatchlist');
});

    
// 5. RUTE DASHBOARD ADMIN (CRUD FILM)
Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // CRUD FILM (Resource Route yang disederhanakan)
    Route::get('/films', [FilmController::class, 'index'])->name('admin.films.index');
    Route::get('/films/create', [FilmController::class, 'create'])->name('admin.films.create');
    Route::post('/films', [FilmController::class, 'store'])->name('admin.films.store');
    Route::get('/films/{film}/edit', [FilmController::class, 'edit'])->name('admin.films.edit');
    Route::put('/films/{film}', [FilmController::class, 'update'])->name('admin.films.update');
    Route::delete('/films/{film}', [FilmController::class, 'destroy'])->name('admin.films.destroy');
});

// BLOK DUPLIKASI INI SUDAH DIHAPUS
// Route::prefix('user')->middleware('auth:web')->group(function () { ... });