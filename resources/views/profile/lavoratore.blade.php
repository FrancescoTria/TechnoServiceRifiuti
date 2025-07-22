@extends('layouts.app')

@section('content')
    <div class="container"
        style="max-width:600px; margin:40px auto; background:#fff; border-radius:16px; box-shadow:0 8px 32px #eaf5d0, 0 1.5px 4px #eaf5d0; padding:32px;">
        <h1 style="color:#829B22; text-align:center; font-size:2em; font-weight:bold; margin-bottom:24px;">Profilo
            lavoratore</h1>
        @if(session('success'))
            <div
                style="background:#eaf5d0; color:#4a5a1c; padding:12px; border-radius:8px; margin-bottom:18px; text-align:center; font-weight:bold; box-shadow:0 1px 4px #c6e27b;">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div style="background:#ffdddd; color:#b30000; padding:12px; border-radius:8px; margin-bottom:18px;">
                <ul style="margin:0; padding-left:18px; text-align:left;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('profile.lavoratore.update') }}">
            @csrf
            <div class="mb-4">
                <label for="nome" style="color:#829B22; font-weight:bold;">Nome</label>
                <input type="text" name="nome" id="nome" class="profile-form-input"
                    value="{{ old('nome', $lavoratore->nome) }}" required>
            </div>
            <div class="mb-4">
                <label for="cognome" style="color:#829B22; font-weight:bold;">Cognome</label>
                <input type="text" name="cognome" id="cognome" class="profile-form-input"
                    value="{{ old('cognome', $lavoratore->cognome) }}" required>
            </div>
            <div class="mb-4">
                <label for="email" style="color:#829B22; font-weight:bold;">Email</label>
                <input type="email" name="email" id="email" class="profile-form-input"
                    value="{{ old('email', $lavoratore->email) }}" required>
            </div>
            <div class="mb-4">
                <label for="password" style="color:#829B22; font-weight:bold;">Nuova password (opzionale)</label>
                <input type="password" name="password" id="password" class="profile-form-input">
            </div>
            <div class="mb-4">
                <label for="password_confirmation" style="color:#829B22; font-weight:bold;">Conferma password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="profile-form-input">
            </div>
            <button type="submit" class="profile-btn" style="width:100%; margin-top:18px;">Salva modifiche</button>
        </form>
    </div>
@endsection