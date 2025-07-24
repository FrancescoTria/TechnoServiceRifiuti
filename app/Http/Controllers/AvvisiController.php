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
            'categoria' => $request->input('categoria'),
            'messaggio' => $request->input('messaggio'),
            'data_invio' => Carbon::now(),
            'id_cliente' => Auth::id(),
            'id_lavoratore' => $request->input('id_lavoratore'),
            'oggetto' => $request->input('oggetto'),
        ]);
        Log::info('Avviso creato', ['avviso' => $avviso]);

        return redirect()->back()->with('success', 'Avviso inviato con successo!');
    }

    // Mostra tutti gli avvisi inviati dal cittadino autenticato
    public function index()
    {
        $avvisi = Avvisi::where('id_cliente', Auth::id())
            ->where('categoria', 'Richiesta')
            ->orderByDesc('data_invio')->get();
        return view('avvisi.index', compact('avvisi'));
    }

    // Mostra il form per inviare un avviso a un cittadino (da lavoratore)
    public function createAvvisoCliente()
    {
        // Solo lavoratori autenticati
        $lavoratore = Auth::guard('lavoratori')->user();
        if (!$lavoratore) {
            abort(403);
        }
        $clienti = \App\Models\User::orderBy('cognome')->orderBy('nome')->get();
        return view('avvisi.crea_avviso_cliente', compact('clienti'));
    }

    // Salva l'avviso inviato dal lavoratore a un cittadino
    public function storeAvvisoCliente(Request $request)
    {
        $lavoratore = Auth::guard('lavoratori')->user();
        if (!$lavoratore) {
            abort(403);
        }
        $request->validate([
            'id_cliente' => 'required|exists:users,id',
            'messaggio' => 'required|string',
        ]);
        $avviso = Avvisi::create([
            'categoria' => 'Avviso',
            'messaggio' => $request->input('messaggio'),
            'data_invio' => now(),
            'id_cliente' => $request->input('id_cliente'),
            'id_lavoratore' => ($lavoratore instanceof \App\Models\Lavoratori) ? $lavoratore->id_lavoratore : null,
            'oggetto' => 'Avviso rifiuto non conforme',
        ]);
        return redirect()->route('avvisi.create-avviso-cliente')->with('success', 'Avviso inviato al cittadino!');
    }

    // Mostra tutti gli avvisi inviati dal lavoratore autenticato
    public function indexLavoratore()
    {
        $lavoratore = Auth::guard('lavoratori')->user();
        if (!$lavoratore)
            abort(403);
        $idLavoratore = ($lavoratore instanceof \App\Models\Lavoratori) ? $lavoratore->id_lavoratore : null;
        $avvisi = \App\Models\Avvisi::where('id_lavoratore', $idLavoratore)
            ->where('categoria', 'Avviso')
            ->orderByDesc('data_invio')->get();
        return view('avvisi.index_lavoratore', compact('avvisi'));
    }

    // Mostra tutte le richieste inviate dai clienti (solo per admin lavoratore)
    public function indexAdmin()
    {
        $lavoratore = Auth::guard('lavoratori')->user();
        if (!$lavoratore || !($lavoratore instanceof \App\Models\Lavoratori) || $lavoratore->admin != 1)
            abort(403);
        $avvisi = \App\Models\Avvisi::where('categoria', 'Richiesta')->orderByDesc('data_invio')->get();
        return view('avvisi.index_admin', compact('avvisi'));
    }

    // Mostra tutti gli avvisi ricevuti dal cittadino autenticato (categoria = 'Avviso')
    public function indexRicevuti()
    {
        $user = Auth::user();
        if (!$user)
            abort(403);
        $avvisi = \App\Models\Avvisi::where('id_cliente', $user->id)
            ->where('categoria', 'Avviso')
            ->orderByDesc('data_invio')->get();
        return view('avvisi.ricevuti', compact('avvisi'));
    }
}