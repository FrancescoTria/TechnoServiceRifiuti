@extends('layouts.app')

@section('content')
    <style>
        .container-avvisi {
            max-width: 900px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 8px 32px #eaf5d0, 0 1.5px 4px #eaf5d0;
        }

        .links {
            text-align: center;
            margin-bottom: 30px;
        }

        .links a {
            margin: 0 15px;
            text-decoration: none;
            color: #829B22;
            font-weight: bold;
            font-size: 1.1em;
            transition: color 0.2s;
        }

        .links a:hover {
            color: #829B22;
        }

        .avvisi-title {
            text-align: center;
            color: #829B22;
            font-size: 2.3em;
            letter-spacing: 2px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .avvisi-form label {
            color: #829B22;
            font-weight: bold;
        }

        .avvisi-form select,
        .avvisi-form textarea,
        .avvisi-form input[type="number"] {
            border: 2px solid #c6e27b;
            border-radius: 7px;
            padding: 10px;
            font-size: 1.08em;
            width: 100%;
            margin-bottom: 8px;
            box-shadow: 0 1px 4px #e0e7ff;
            transition: border 0.2s, box-shadow 0.2s;
        }

        .avvisi-form select:focus,
        .avvisi-form textarea:focus,
        .avvisi-form input[type="number"]:focus {
            border-color: #829B22;
            box-shadow: 0 2px 8px #829B22;
            outline: none;
        }

        .avvisi-form-btn {
            background: #829B22;
            color: #fff;
            padding: 14px 0;
            border-radius: 12px;
            text-decoration: none;
            font-size: 1.2em;
            font-weight: bold;
            box-shadow: 0 2px 8px #b3baff;
            transition: background 0.2s, box-shadow 0.2s, transform 0.1s;
            border: none;
            display: block;
            width: 100%;
            margin-top: 10px;
            cursor: pointer;
            letter-spacing: 1px;
        }

        .avvisi-form-btn:hover {
            background: #6b7e1a;
            box-shadow: 0 4px 16px #b3baff;
            transform: translateY(-2px) scale(1.03);
        }

        .avvisi-success {
            background: #eaf5d0;
            color: #4a5a1c;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 18px;
            text-align: center;
            font-weight: bold;
            box-shadow: 0 1px 4px #c6e27b;
        }
    </style>
    <div class="container-avvisi">
        <div class="links">
            <a href="/">Home</a>
            @auth
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <a href="{{ route('profile.edit') }}">Profilo</a>
                <a href="{{ route('calendario') }}">Calendario</a>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
            @else
                <a href="{{ route('login') }}">Accedi</a>
                <a href="{{ route('register') }}">Registrati</a>
                <a href="{{ route('calendario') }}">Calendario</a>
            @endauth
        </div>
        <h1 class="avvisi-title">
            @if(Auth::check() && (!isset(Auth::user()->admin) || Auth::user()->admin == 0))
                Invia una richiesta
            @else
                Invia un Avviso
            @endif
        </h1>
        @if(session('success'))
            <div class="avvisi-success">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="avvisi-success" style="background:#ffdddd; color:#b30000;">
                <ul style="margin:0; padding-left:18px; text-align:left;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('avvisi.store') }}" class="avvisi-form">
            @csrf
            <input type="hidden" name="categoria" value="Richiesta">
            @if(Auth::check() && (!isset(Auth::user()->admin) || Auth::user()->admin == 0))
                <input type="hidden" name="id_lavoratore" value="1">
                <div class="mb-4">
                    <label for="oggetto">Oggetto</label>
                    <select name="oggetto" id="oggetto" required>
                        <option value="">Seleziona...</option>
                        <option value="Ritiro rifiuti speciali">Ritiro rifiuti speciali</option>
                        <option value="Invia ticket">Invia ticket</option>
                        <option value="Supporto tecnico">Supporto tecnico</option>
                        <option value="Altro">Altro</option>
                    </select>
                    @error('oggetto')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
            @else
                <div class="mb-4">
                    <label for="id_lavoratore">Lavoratore (opzionale)</label>
                    <input type="number" name="id_lavoratore" id="id_lavoratore" value="{{ old('id_lavoratore', 1) }}">
                    @error('id_lavoratore')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <div class="mb-4">
                    <label for="oggetto">Oggetto</label>
                    <select name="oggetto" id="oggetto" required>
                        <option value="">Seleziona...</option>
                        <option value="Avviso rifiuto non conforme">Avviso rifiuto non conforme</option>
                    </select>
                    @error('oggetto')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
            @endif
            <div class="mb-4">
                <label for="messaggio">Messaggio</label>
                <textarea name="messaggio" id="messaggio" rows="4" required>{{ old('messaggio') }}</textarea>
                @error('messaggio')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
            <button type="submit" class="avvisi-form-btn">Invia Avviso</button>
        </form>
    </div>
@endsection