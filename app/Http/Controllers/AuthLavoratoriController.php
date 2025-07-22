<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Lavoratori;
use Illuminate\Support\Facades\Hash;

class AuthLavoratoriController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $lavoratore = Lavoratori::where('email', $request->email)->first();
        if ($lavoratore && Hash::check($request->password, $lavoratore->password)) {
            // Qui puoi gestire la sessione custom o autenticazione lavoratori
            // Per ora redirect con messaggio di successo
            return redirect('/')->with('status', 'Login lavoratore riuscito!');
        }
        return back()->withErrors(['email' => 'Credenziali non valide'])->withInput();
    }
}