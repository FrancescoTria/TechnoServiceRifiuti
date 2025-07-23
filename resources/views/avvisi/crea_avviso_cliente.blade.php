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

        .avvisi-title {
            text-align: center;
            color: #829B22;
            font-size: 2em;
            letter-spacing: 2px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        label {
            color: #829B22;
            font-weight: bold;
            font-size: 1.08em;
            margin-bottom: 4px;
            display: block;
        }

        select,
        textarea {
            border: 2px solid #c6e27b;
            border-radius: 7px;
            padding: 10px;
            font-size: 1.08em;
            width: 100%;
            margin-bottom: 8px;
            box-shadow: 0 1px 4px #e0e7ff;
            transition: border 0.2s, box-shadow 0.2s;
        }

        select:focus,
        textarea:focus {
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
            box-shadow: none;
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

        .input-error {
            color: #b30000;
            font-size: 0.98em;
            margin-bottom: 8px;
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
        <h1 class="avvisi-title">Invia avviso a cittadino</h1>
        <div class="links" style="text-align:center; margin-bottom:30px;">
            <a href="/" class="nav-link">Home</a>
            <a href="{{ route('calendario') }}" class="nav-link">Calendario</a>
            <a href="{{ route('dashboard.lavoratore') }}" class="nav-link">Dashboard Lavoratore</a>
            <a href="{{ route('profile.lavoratore.edit') }}" class="nav-link">Profilo</a>
            <a href="{{ route('logout.lavoratori') }}" class="nav-link"
                onclick="event.preventDefault(); document.getElementById('logout-form-lavoratore').submit();">Logout</a>
            <form id="logout-form-lavoratore" action="{{ route('logout.lavoratori') }}" method="POST"
                style="display: none;">@csrf</form>
        </div>
        <style>
            .links .nav-link {
                margin: 0 15px;
                text-decoration: none;
                color: #829B22;
                font-weight: bold;
                font-size: 1.1em;
                transition: color 0.2s, background 0.2s;
                padding: 8px 18px;
                border-radius: 8px;
                display: inline-block;
            }

            .links .nav-link:hover,
            .links .nav-link:focus {
                background: #eaf5d0;
                color: #5d6e18;
                text-decoration: none;
            }
        </style>
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
        <form method="POST" action="{{ route('avvisi.store-avviso-cliente') }}">
            @csrf
            <div class="mb-4">
                <label for="id_cliente">Seleziona cittadino</label>
                <select name="id_cliente" id="id_cliente" required>
                    <option value="">Seleziona...</option>
                    @foreach($clienti as $cliente)
                        <option value="{{ $cliente->id }}">{{ $cliente->cognome }} {{ $cliente->nome }} ({{ $cliente->email }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="messaggio">Messaggio</label>
                <textarea name="messaggio" id="messaggio" rows="4" required>{{ old('messaggio') }}</textarea>
                @error('messaggio')<div class="input-error">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label>Oggetto</label>
                <input type="text" value="Avviso rifiuto non conforme" disabled
                    style="width:100%; background:#f3f3f3; color:#829B22; font-weight:bold; border:none; padding:10px; border-radius:7px;">
            </div>
            <button type="submit" class="avvisi-form-btn">Invia Avviso</button>
        </form>
    </div>
@endsection