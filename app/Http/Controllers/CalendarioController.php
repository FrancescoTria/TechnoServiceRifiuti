<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calendario;

class CalendarioController extends Controller
{
    public function update(Request $request)
    {
        $cap = $request->input('cap');
        $row = \App\Models\Calendario::where('CAP', $cap)->first();
        if ($row) {
            $giorniSettimana = ['lunedì', 'martedì', 'mercoledì', 'giovedì', 'venerdì', 'sabato', 'domenica'];
            foreach ($giorniSettimana as $giorno) {
                $row->$giorno = $request->input("calendario.$cap.$giorno");
            }
            // Salva la fascia oraria come stringa "HH:MM-HH:MM"
            $start = $request->input('fascia_oraria_start');
            $end = $request->input('fascia_oraria_end');
            $row->fascia_oraria_ = ($start && $end) ? ($start . '-' . $end) : null;
            $row->save();
        }
        return redirect()->route('calendario.edit', ['cap' => $cap])->with('success', 'Calendario aggiornato con successo!');
    }
}