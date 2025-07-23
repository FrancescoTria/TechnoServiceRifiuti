<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calendario;

class CalendarioController extends Controller
{
    public function update(Request $request)
    {
        $data = $request->input('calendario', []);
        foreach ($data as $id => $row) {
            $cal = Calendario::find($id);
            if ($cal) {
                $cal->giorno = $row['giorno'];
                $cal->rifiuto = array_key_exists('rifiuto', $row) && $row['rifiuto'] !== '' ? $row['rifiuto'] : null;
                $cal->fascia_oraria = array_key_exists('fascia_oraria', $row) && $row['fascia_oraria'] !== '' ? $row['fascia_oraria'] : null;
                $cal->save();
            }
        }
        return redirect()->route('calendario.edit')->with('success', 'Calendario aggiornato con successo!');
    }
}