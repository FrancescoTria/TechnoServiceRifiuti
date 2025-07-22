<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Calendario;
use App\Http\Controllers\AuthLavoratoriController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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

require __DIR__ . '/auth.php';
