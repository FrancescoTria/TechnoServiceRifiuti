<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - TechnoService</title>
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
            border-radius: 20px;
            box-shadow: 0 8px 32px #c6e27b, 0 1.5px 4px #eaf5d0;
        }

        h1 {
            text-align: center;
            color: #829B22;
            font-size: 2.3em;
            letter-spacing: 2px;
            margin-bottom: 10px;
            font-weight: bold;
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

        .welcome {
            margin: 40px 0;
            text-align: center;
        }

        .welcome h2 {
            color: #829B22;
            font-size: 1.7em;
            margin-bottom: 12px;
            font-weight: bold;
        }

        .welcome p {
            font-size: 1.13em;
            color: #4a5a1c;
        }

        .profile-btn {
            background: #829B22;
            color: #fff;
            border: none;
            border-radius: 14px;
            font-size: 1.15em;
            font-weight: bold;
            padding: 12px 36px;
            box-shadow: 0 0 12px 1px #829B2233;
            transition: box-shadow 0.18s, transform 0.12s;
            outline: none;
            letter-spacing: 1px;
            margin: 0 8px;
            display: inline-block;
            text-decoration: none;
        }

        .profile-btn:hover,
        .profile-btn:focus {
            background: #829B22;
            color: #fff;
            box-shadow: 0 0 24px 2px #829B2255;
            transform: translateY(-2px) scale(1.03);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="links">
            <a href="/">Home</a>
            <a href="{{ route('calendario') }}">Calendario</a>
            @php
                $isCittadino = Auth::user() instanceof \App\Models\User;
                $isLavoratore = Auth::user() instanceof \App\Models\Lavoratori;
                $isAdmin = $isLavoratore && Auth::user()->admin == 1;
                $isLavoratoreBase = $isLavoratore && Auth::user()->admin == 0;
                $profileRoute = $isLavoratore ? route('profile.lavoratore.edit') : route('profile.edit');
            @endphp
            <a href="{{ $profileRoute }}">Profilo</a>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
        </div>
        <h1>Dashboard</h1>
        <div class="welcome">
            <h2>Ciao {{ Auth::user()->nome }} {{ Auth::user()->cognome }}!</h2>
            @php
                // Determina se è cittadino (tabella users) o lavoratore (tabella lavoratori)
                $isCittadino = Auth::user() instanceof \App\Models\User;
                $isLavoratore = Auth::user() instanceof \App\Models\Lavoratori;
                $isAdmin = $isLavoratore && Auth::user()->admin == 1;
                $isLavoratoreBase = $isLavoratore && Auth::user()->admin == 0;
            @endphp
            @if($isCittadino)
                <p>Benvenuto nella tua area riservata. Qui puoi gestire il tuo profilo, consultare il calendario e inviare
                    richieste.</p>
                <a href="{{ route('avvisi.create') }}" class="profile-btn mt-4">Invia una richiesta</a>
                <a href="{{ route('avvisi.index') }}" class="profile-btn mt-4">Le tue richieste</a>
            @elseif($isLavoratoreBase)
                <p>Benvenuto nell'area lavoratore. Qui puoi inviare avvisi ai cittadini.</p>
                <a href="{{ route('avvisi.create') }}" class="profile-btn mt-4">Invia avviso a cittadino</a>
            @elseif($isAdmin)
                <p>Benvenuto nell'area amministratore. Puoi gestire lavoratori e calendario, oltre a inviare avvisi ai
                    cittadini.</p>
                <a href="{{ route('avvisi.create') }}" class="profile-btn mt-4">Invia avviso a cittadino</a>
                <a href="{{ route('lavoratori.create') }}" class="profile-btn mt-4">Aggiungi lavoratore</a>
                <a href="{{ route('calendario.edit') }}" class="profile-btn mt-4">Modifica calendario</a>
            @endif
        </div>
    </div>
</body>

</html>