<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Indirizzi;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $indirizzi = Indirizzi::all();
        return view('auth.register', compact('indirizzi'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'cognome' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'indirizzo' => ['required', 'string', 'max:255'],
        ]);

        // Trova indirizzi con quel nome
        $indirizzi = Indirizzi::where('nome_indirizzo', $request->input('indirizzo'))->get();
        if ($indirizzi->isEmpty()) {
            return back()->withErrors(['indirizzo' => 'La via selezionata non esiste.'])->withInput();
        }
        // Trova o crea l'indirizzo (con civico e CAP)
        $indirizzo = Indirizzi::firstOrCreate([
            'nome_indirizzo' => $request->input('indirizzo'),
            'civico' => $request->input('civico'),
            'CAP' => $request->input('CAP'),
        ]);

        $user = User::create([
            'nome' => $request->input('nome'),
            'cognome' => $request->input('cognome'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'id_indirizzo' => $indirizzo->getAttribute('id_indirizzo'),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
