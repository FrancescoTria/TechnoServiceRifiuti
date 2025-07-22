<?php

namespace App\Http\Controllers;

use App\Models\Avvisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class AvvisiController extends Controller
{
    // Mostra il form per creare un nuovo avviso
    public function create()
    {
        return view('avvisi.create');
    }

    // Salva un nuovo avviso inviato dal cittadino
    public function store(Request $request)
    {
        $request->validate([
            'categoria' => 'required|in:Richiesta,Avviso',
            'messaggio' => 'required|string',
            'id_lavoratore' => 'nullable|exists:lavoratori,id_lavoratore',
            'oggetto' => 'required',
        ]);

        Log::info('Dati ricevuti per avviso', $request->all());
        $avviso = Avvisi::create([
            'categoria' => $request->categoria,
            'messaggio' => $request->messaggio,
            'data_invio' => Carbon::now(),
            'id_cliente' => Auth::id(),
            'id_lavoratore' => $request->id_lavoratore,
            'oggetto' => $request->oggetto,
        ]);
        Log::info('Avviso creato', ['avviso' => $avviso]);

        return redirect()->back()->with('success', 'Avviso inviato con successo!');
    }

    // Mostra tutti gli avvisi inviati dal cittadino autenticato
    public function index()
    {
        $avvisi = Avvisi::where('id_cliente', Auth::id())->orderByDesc('data_invio')->get();
        return view('avvisi.index', compact('avvisi'));
    }
}