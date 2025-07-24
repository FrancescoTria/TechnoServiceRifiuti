<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Calendario;
use App\Http\Controllers\AuthLavoratoriController;
use App\Http\Controllers\AvvisiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Indirizzi;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/dashboard-lavoratore', function () {
    return view('dashboard');
})->middleware(['auth:lavoratori'])->name('dashboard.lavoratore');

Route::get('/calendario', function (Request $request) {
    $cap = $request->query('cap');
    $calendario = null;
    $errore_cap = null;
    if ($cap) {
        $calendario = Calendario::where('CAP', $cap)->get();
        if ($calendario->isEmpty()) {
            $errore_cap = 'Nessun calendario trovato per il CAP inserito.';
            $calendario = null;
        }
    }
    return view('calendario', compact('calendario', 'errore_cap'));
})->name('calendario');

Route::post('/login-lavoratori', [AuthLavoratoriController::class, 'store'])->name('login.lavoratori');
Route::post('/logout-lavoratori', [App\Http\Controllers\AuthLavoratoriController::class, 'logoutLavoratore'])->name('logout.lavoratori');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/avvisi/ricevuti', [AvvisiController::class, 'indexRicevuti'])->name('avvisi.ricevuti');
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
    Route::delete('/profile-lavoratore', [\App\Http\Controllers\ProfileLavoratoreController::class, 'destroy'])->name('profile.lavoratore.destroy');
    Route::get('/lavoratori/aggiungi', function () {
        $user = Auth::guard('lavoratori')->user();
        if (!$user || !($user instanceof \App\Models\Lavoratori) || $user->admin != 1)
            abort(403);
        return view('lavoratori.create');
    })->name('lavoratori.create');
    Route::post('/lavoratori/aggiungi', function (\Illuminate\Http\Request $request) {
        $user = Auth::guard('lavoratori')->user();
        if (!$user || !($user instanceof \App\Models\Lavoratori) || $user->admin != 1)
            abort(403);
        return app(\App\Http\Controllers\ProfileLavoratoreController::class)->store($request);
    })->name('lavoratori.store');
    Route::get('/calendario/modifica', function (Request $request) {
        $user = Auth::guard('lavoratori')->user();
        if (!$user || !($user instanceof \App\Models\Lavoratori) || $user->admin != 1)
            abort(403);
        $cap = $request->query('cap');
        $calendario = null;
        if ($cap) {
            $calendario = \App\Models\Calendario::where('CAP', $cap)->get();
            if ($calendario->isEmpty()) {
                $calendario = null;
            }
        }
        return view('calendario.edit', compact('calendario'));
    })->name('calendario.edit');
    Route::post('/calendario/modifica', function (\Illuminate\Http\Request $request) {
        $user = Auth::guard('lavoratori')->user();
        if (!$user || !($user instanceof \App\Models\Lavoratori) || $user->admin != 1)
            abort(403);
        return app(\App\Http\Controllers\CalendarioController::class)->update($request);
    })->name('calendario.update');
    // Avviso da lavoratore a cittadino
    Route::get('/avvisi/cliente/crea', [AvvisiController::class, 'createAvvisoCliente'])->name('avvisi.create-avviso-cliente');
    Route::post('/avvisi/cliente/crea', [AvvisiController::class, 'storeAvvisoCliente'])->name('avvisi.store-avviso-cliente');
    Route::get('/avvisi/lavoratore', [AvvisiController::class, 'indexLavoratore'])->name('avvisi.lavoratore');
    Route::get('/avvisi/admin', [AvvisiController::class, 'indexAdmin'])->name('avvisi.admin');
});

// Endpoint suggerimenti civico+CAP per una via
Route::get('/indirizzi/suggerimenti', function (Request $request) {
    $nome = $request->query('nome_indirizzo');
    $indirizzi = Indirizzi::where('nome_indirizzo', $nome)->get(['civico', 'CAP']);
    return response()->json($indirizzi);
});

require __DIR__ . '/auth.php';
