<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Lavoratori;

class ProfileLavoratoreController extends Controller
{
    public function edit(Request $request)
    {
        $lavoratore = Auth::guard('lavoratori')->user();
        return view('profile.lavoratore', compact('lavoratore'));
    }

    public function update(Request $request)
    {
        $lavoratore = Auth::guard('lavoratori')->user();
        $request->validate([
            'nome' => 'required|string|max:255',
            'cognome' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:lavoratori,email,' . $lavoratore->id_lavoratore . ',id_lavoratore',
            'password' => 'nullable|min:8|confirmed',
        ]);
        $lavoratore->nome = $request->nome;
        $lavoratore->cognome = $request->cognome;
        $lavoratore->email = $request->email;
        if ($request->filled('password')) {
            $lavoratore->password = Hash::make($request->password);
        }
        $lavoratore->save();
        return redirect()->route('profile.lavoratore.edit')->with('success', 'Profilo aggiornato con successo!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cognome' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:lavoratori,email',
            'password' => 'required|string|min:8',
        ]);
        $lavoratore = new \App\Models\Lavoratori();
        $lavoratore->nome = $request->nome;
        $lavoratore->cognome = $request->cognome;
        $lavoratore->email = $request->email;
        $lavoratore->password = $request->password;
        $lavoratore->admin = 0;
        $lavoratore->save();
        return redirect()->route('lavoratori.create')->with('success', 'Lavoratore aggiunto con successo!');
    }

    public function destroy(Request $request)
    {
        $lavoratore = Auth::guard('lavoratori')->user();
        $request->validate([
            'password' => ['required'],
        ]);
        // Verifica la password
        if (!Hash::check($request->password, $lavoratore->password)) {
            return back()->withErrors(['deleteLavoratore' => 'Password errata'])->withInput();
        }
        // Il metodo delete() è disponibile perché Lavoratori estende Eloquent\Model tramite Authenticatable
        Auth::guard('lavoratori')->logout();
        $lavoratore->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}