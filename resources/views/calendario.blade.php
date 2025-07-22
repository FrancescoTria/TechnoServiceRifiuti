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
        <h1>Calendario Settimanale Raccolta Rifiuti</h1>
        <table>
            <tr>
                <th>Giorno</th>
                <th>Rifiuto</th>
                <th>Fascia oraria</th>
            </tr>
            @foreach($giorni as $riga)
                <tr>
                    <td>{{ $riga->giorno }}</td>
                    <td>{{ $riga->rifiuto }}</td>
                    <td>{{ $riga->fascia_oraria ? \Carbon\Carbon::createFromFormat('H:i:s', $riga->fascia_oraria)->format('H:i') : '' }}
                    </td>
                </tr>
            @endforeach
        </table>
        <div style="margin-top: 30px; text-align: center; color: #333;">
            <p>Consulta sempre il calendario per una raccolta differenziata corretta.<br>
                Per variazioni o festività, controlla le comunicazioni nella tua area riservata.</p>
        </div>
    </div>
</body>

</html>