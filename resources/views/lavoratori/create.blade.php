@extends('layouts.app')

@section('content')
    <div class="container"
        style="max-width:600px; margin:40px auto; background:#fff; border-radius:16px; box-shadow:0 8px 32px #eaf5d0, 0 1.5px 4px #eaf5d0; padding:32px;">
        <h1 style="color:#829B22; text-align:center; font-size:2em; font-weight:bold; margin-bottom:24px;">Aggiungi
            lavoratore</h1>
        <form method="POST" action="#">
            @csrf
            <div class="mb-4">
                <label for="nome" style="color:#829B22; font-weight:bold;">Nome</label>
                <input type="text" name="nome" id="nome" class="profile-form-input" required>
            </div>
            <div class="mb-4">
                <label for="cognome" style="color:#829B22; font-weight:bold;">Cognome</label>
                <input type="text" name="cognome" id="cognome" class="profile-form-input" required>
            </div>
            <div class="mb-4">
                <label for="email" style="color:#829B22; font-weight:bold;">Email</label>
                <input type="email" name="email" id="email" class="profile-form-input" required>
            </div>
            <div class="mb-4">
                <label for="password" style="color:#829B22; font-weight:bold;">Password</label>
                <input type="password" name="password" id="password" class="profile-form-input" required>
            </div>
            <button type="submit" class="profile-btn" style="width:100%; margin-top:18px;">Aggiungi lavoratore</button>
        </form>
    </div>
@endsection