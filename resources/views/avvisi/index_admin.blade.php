@extends('layouts.app')

@section('content')
    <style>
        .container-avvisi-list {
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
            font-size: 2.3em;
            letter-spacing: 2px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .avvisi-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 24px;
        }

        .avvisi-table th,
        .avvisi-table td {
            border: 2px solid #c6e27b;
            padding: 10px;
            text-align: center;
            font-size: 1em;
        }

        .avvisi-table th {
            background: #829B22;
            color: #fff;
            letter-spacing: 1px;
        }

        .avvisi-table tr:nth-child(even) {
            background: #eaf5d0;
        }

        .no-avvisi {
            text-align: center;
            color: #4a5a1c;
            margin-top: 30px;
            font-size: 1.15em;
        }

        .links {
            text-align: center;
            margin-bottom: 30px;
        }

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
    <div class="container-avvisi-list">
        <h1 class="avvisi-title">Tutte le richieste dei clienti</h1>
        <div class="links">
            <a href="/" class="nav-link">Home</a>
            <a href="{{ route('dashboard.lavoratore') }}" class="nav-link">Dashboard Lavoratore</a>
            <a href="{{ route('calendario') }}" class="nav-link">Calendario</a>
            <a href="{{ route('profile.lavoratore.edit') }}" class="nav-link">Profilo</a>
            <a href="{{ route('logout.lavoratori') }}" class="nav-link"
                onclick="event.preventDefault(); document.getElementById('logout-form-lavoratore').submit();">Logout</a>
            <form id="logout-form-lavoratore" action="{{ route('logout.lavoratori') }}" method="POST"
                style="display: none;">@csrf</form>
        </div>
        @if($avvisi->isEmpty())
            <div class="no-avvisi">Nessuna richiesta trovata.</div>
        @else
            <table class="avvisi-table">
                <thead>
                    <tr>
                        <th>Data invio</th>
                        <th>Cliente</th>
                        <th>Email</th>
                        <th>Oggetto</th>
                        <th>Messaggio</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($avvisi as $avviso)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($avviso->data_invio)->format('d/m/Y H:i') }}</td>
                            <td>
                                @if($avviso->cliente)
                                    {{ $avviso->cliente->cognome }} {{ $avviso->cliente->nome }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if($avviso->cliente)
                                    {{ $avviso->cliente->email }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $avviso->oggetto }}</td>
                            <td>{{ $avviso->messaggio }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection