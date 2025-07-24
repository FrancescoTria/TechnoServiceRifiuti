<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Indirizzi;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $indirizzi = Indirizzi::all();
        return view('profile.edit', [
            'user' => $request->user(),
            'indirizzi' => $indirizzi,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        // Controllo che la via esista
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
        $user->id_indirizzo = $indirizzo->id_indirizzo;

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
