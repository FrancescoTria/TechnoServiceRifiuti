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
}