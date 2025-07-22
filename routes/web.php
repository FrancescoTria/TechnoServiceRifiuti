<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Calendario;
use App\Http\Controllers\AuthLavoratoriController;
use App\Http\Controllers\AvvisiController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard-lavoratore', function () {
    return view('dashboard');
})->middleware(['auth:lavoratori'])->name('dashboard.lavoratore');

Route::get('/calendario', function () {
    $ordineGiorni = ['Lunedì', 'Martedì', 'Mercoledì', 'Giovedì', 'Venerdì', 'Sabato', 'Domenica'];
    $giorni = \App\Models\Calendario::all()->sortBy(function ($item) use ($ordineGiorni) {
        return array_search($item->giorno, $ordineGiorni);
    });
    return view('calendario', ['giorni' => $giorni]);
})->name('calendario');

Route::post('/login-lavoratori', [AuthLavoratoriController::class, 'store'])->name('login.lavoratori');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/avvisi/crea', [AvvisiController::class, 'create'])->name('avvisi.create');
    Route::post('/avvisi', [AvvisiController::class, 'store'])->name('avvisi.store');
    Route::get('/avvisi', [AvvisiController::class, 'index'])->name('avvisi.index');
});

// Rotte per lavoratore admin (protette da auth:lavoratori)
Route::middleware(['auth:lavoratori'])->group(function () {
    Route::get('/profile-lavoratore', [\App\Http\Controllers\ProfileLavoratoreController::class, 'edit'])->name('profile.lavoratore.edit');
    Route::post('/profile-lavoratore', [\App\Http\Controllers\ProfileLavoratoreController::class, 'update'])->name('profile.lavoratore.update');
    Route::get('/lavoratori/aggiungi', function () {
        return view('lavoratori.create'); })->name('lavoratori.create');
    Route::get('/calendario/modifica', function () {
        return view('calendario.edit'); })->name('calendario.edit');
});

require __DIR__ . '/auth.php';
