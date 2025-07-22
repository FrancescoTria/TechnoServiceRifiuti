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

        .links a {
            margin: 0 15px;
            text-decoration: none;
            color: #829B22;
            font-weight: bold !important;
            /* Forza il grassetto come in dashboard */
            font-size: 1.1em;
            transition: color 0.2s;
        }

        .links a:hover {
            color: #829B22;
        }
    </style>
    <div class="container-avvisi-list">
        <div class="links">
            <a href="/">Home</a>
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('calendario') }}">Calendario</a>
            <a href="{{ route('profile.edit') }}">Profilo</a>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
        </div>
        <h1 class="avvisi-title">Le tue richieste</h1>
        @if($avvisi->isEmpty())
            <div class="no-avvisi">Non hai ancora inviato nessun avviso.</div>
        @else
            <table class="avvisi-table">
                <thead>
                    <tr>
                        <th>Data invio</th>
                        <th>Oggetto</th>
                        <th>Messaggio</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($avvisi as $avviso)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($avviso->data_invio)->format('d/m/Y H:i') }}</td>
                            <td>{{ $avviso->oggetto }}</td>
                            <td>{{ $avviso->messaggio }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection