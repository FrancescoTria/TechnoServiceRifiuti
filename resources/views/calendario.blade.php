<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario Raccolta Rifiuti - TechnoService</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eaf5d0;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 8px 32px #eaf5d0, 0 1.5px 4px #eaf5d0;
        }

        h1 {
            text-align: center;
            color: #829B22;
            font-size: 2.5em;
            letter-spacing: 2px;
            margin-bottom: 10px;
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            table-layout: auto;
        }

        th,
        td {
            border: 2px solid #829B22;
            padding: 10px;
            text-align: center;
            font-size: 1rem;
        }

        th {
            background: #829B22;
            color: #fff;
            letter-spacing: 1px;
        }

        tr:nth-child(even) {
            background: #eaf5d0;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: #829B22;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Calendario Settimanale Raccolta Rifiuti</h1>
        <div class="links" style="text-align:center; margin-bottom:30px;">
            <a href="/" class="nav-link">Home</a>
            @auth('lavoratori')
                <a href="{{ route('dashboard.lavoratore') }}" class="nav-link">Dashboard Lavoratore</a>
                <a href="{{ route('profile.lavoratore.edit') }}" class="nav-link">Profilo</a>
                <a href="{{ route('calendario') }}" class="nav-link">Calendario</a>
                <a href="{{ route('logout.lavoratori') }}" class="nav-link"
                    onclick="event.preventDefault(); document.getElementById('logout-form-lavoratore').submit();">Logout</a>
                <form id="logout-form-lavoratore" action="{{ route('logout.lavoratori') }}" method="POST"
                    style="display: none;">@csrf</form>
            @else
                @auth
                    <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
                    <a href="{{ route('profile.edit') }}" class="nav-link">Profilo</a>
                    <a href="{{ route('calendario') }}" class="nav-link">Calendario</a>
                    <a href="{{ route('logout') }}" class="nav-link"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                @else
                    <a href="{{ route('login') }}" class="nav-link">Accedi</a>
                    <a href="{{ route('register') }}" class="nav-link">Registrati</a>
                    <a href="{{ route('calendario') }}" class="nav-link">Calendario</a>
                @endauth
            @endauth
        </div>
        <form method="GET" action="{{ route('calendario') }}" style="margin-bottom: 24px; text-align:center;">
            <label for="cap" style="font-weight:bold; color:#829B22; font-size:1.1em;">Inserisci il CAP:</label>
            <select id="cap" name="cap"
                style="padding:8px; border-radius:6px; border:2px solid #829B22; margin:0 10px; width:140px;">
                <option value="">Seleziona CAP</option>
                @foreach(\App\Models\Calendario::select('CAP')->distinct()->orderBy('CAP')->get() as $cap)
                    <option value="{{ $cap->CAP }}" @if(request('cap') == $cap->CAP) selected @endif>{{ $cap->CAP }}</option>
                @endforeach
            </select>
            <button type="submit"
                style="background:#829B22; color:#fff; border:none; border-radius:8px; padding:8px 18px; font-weight:bold;">Cerca</button>
        </form>
        @if(isset($errore_cap))
            <div style="color:#b30000; text-align:center; margin-bottom:20px; font-weight:bold;">{{ $errore_cap }}</div>
        @endif
        @if(isset($calendario))
            <table style="margin-top: 10px; table-layout: fixed; width: 100%;">
                <tr>
                    <th style="width: 20%;">Giorno</th>
                    <th style="width: 40%;">Rifiuto</th>
                </tr>
                @php
                    $giorniSettimana = ['lunedì', 'martedì', 'mercoledì', 'giovedì', 'venerdì', 'sabato', 'domenica'];
                @endphp
                @foreach($calendario as $row)
                    @foreach($giorniSettimana as $giorno)
                        <tr>
                            <td style="width: 20%; text-transform: capitalize;">{{ $giorno }}</td>
                            <td style="width: 40%;">{{ $row->$giorno }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </table>
            @php
                $fasce = $calendario->pluck('fascia_oraria_')->unique()->filter();
            @endphp
            @if($fasce->count())
                <div style="margin-top: 18px; text-align: center; color: #333; font-weight:bold;">
                    Fascia oraria: {{ $fasce->implode(' / ') }}
                </div>
            @endif
            <div style="margin-top: 30px; text-align: center; color: #333;">
                <p>Consulta sempre il calendario per una raccolta differenziata corretta.<br>
                    Per variazioni o festività, controlla le comunicazioni nella tua area riservata.</p>
            </div>
        @endif
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
    </div>
</body>

</html>