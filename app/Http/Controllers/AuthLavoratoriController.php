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
            'email_lav' => ['required', 'email'],
            'password_lav' => ['required'],
        ], [
            'email_lav.required' => "L'email è obbligatoria",
            'email_lav.email' => 'Inserisci un indirizzo email valido',
            'password_lav.required' => 'La password è obbligatoria',
        ]);

        $lavoratore = Lavoratori::where('email', $request->email_lav)->first();
        if ($lavoratore && Hash::check($request->password_lav, $lavoratore->password)) {
            Auth::guard('lavoratori')->login($lavoratore);
            return redirect()->route('dashboard.lavoratore')->with('status', 'Login lavoratore riuscito!');
        }
        return back()->withErrors(['email_lav' => 'Email o password errati'], 'lavoratore')->withInput();
    }

    public function create()
    {
        if (Auth::guard('lavoratori')->check()) {
            return redirect()->route('dashboard.lavoratore');
        }
        return view('auth.login');
    }

    public function logoutLavoratore(Request $request)
    {
        Auth::guard('lavoratori')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}