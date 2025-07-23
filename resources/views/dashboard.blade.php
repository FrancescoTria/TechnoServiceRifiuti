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
            transition: color 0.2s, background 0.2s;
            padding: 8px 18px;
            border-radius: 8px;
            display: inline-block;
        }

        .links a:hover,
        .links a:focus {
            background: #eaf5d0;
            color: #5d6e18;
            text-decoration: none;
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

        .dashboard-btn-group {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 24px 32px;
            margin-top: 32px;
            justify-items: center;
        }

        .dashboard-btn-group .profile-btn {
            font-size: 1.22em;
            padding: 20px 0;
            border-radius: 16px;
            margin-bottom: 0;
            box-shadow: 0 4px 24px #b3baff, 0 1.5px 4px #eaf5d0;
            min-width: 220px;
            max-width: 320px;
            width: 100%;
            transition: background 0.2s, box-shadow 0.2s, transform 0.13s;
        }

        .dashboard-btn-group .profile-btn:hover,
        .dashboard-btn-group .profile-btn:focus {
            background: #6b7e1a;
            color: #fff;
            box-shadow: 0 8px 32px #b3baff, 0 2px 8px #eaf5d0;
            transform: translateY(-4px) scale(1.04);
        }
    </style>
</head>

<body>
    <div class="container">
        @php
            $isCittadino = Auth::user() instanceof \App\Models\User;
            $isLavoratore = Auth::user() instanceof \App\Models\Lavoratori;
        @endphp
        <h1>{{ $isLavoratore ? 'Dashboard Lavoratore' : 'Dashboard' }}</h1>
        <div class="links" style="text-align:center; margin-bottom:30px;">
            <a href="/" class="nav-link">Home</a>
            <a href="{{ route('calendario') }}" class="nav-link">Calendario</a>
            @php
                $isAdmin = $isLavoratore && Auth::user()->admin == 1;
                $isLavoratoreBase = $isLavoratore && Auth::user()->admin == 0;
                $profileRoute = $isLavoratore ? route('profile.lavoratore.edit') : route('profile.edit');
            @endphp
            <a href="{{ $profileRoute }}" class="nav-link">Profilo</a>
            @if($isLavoratore)
                <a href="{{ route('logout.lavoratori') }}" class="nav-link"
                    onclick="event.preventDefault(); document.getElementById('logout-form-lavoratore').submit();">Logout</a>
                <form id="logout-form-lavoratore" action="{{ route('logout.lavoratori') }}" method="POST"
                    style="display: none;">@csrf</form>
            @else
                <a href="{{ route('logout') }}" class="nav-link"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
            @endif
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
                <div class="dashboard-btn-group">
                    <a href="{{ route('avvisi.create') }}" class="profile-btn">Invia una richiesta</a>
                    <a href="{{ route('avvisi.index') }}" class="profile-btn">Le tue richieste</a>
                    <a href="{{ route('avvisi.ricevuti') }}" class="profile-btn">Visualizza avvisi</a>
                </div>
            @elseif($isLavoratoreBase)
                <p>Benvenuto nell'area lavoratore. Qui puoi inviare avvisi ai cittadini.</p>
                <div class="dashboard-btn-group">
                    <a href="{{ route('avvisi.create-avviso-cliente') }}" class="profile-btn">Invia avviso a cittadino</a>
                    <a href="{{ route('avvisi.lavoratore') }}" class="profile-btn">Visualizza avvisi inviati</a>
                    <a href="#" class="profile-btn"
                        style="background:#b3baff; color:#fff; cursor: not-allowed;">Funzionalità in arrivo</a>
                </div>
            @elseif($isAdmin)
                <p>Benvenuto nell'area amministratore. Puoi gestire lavoratori e calendario, oltre a inviare avvisi ai
                    cittadini.</p>
                <div class="dashboard-btn-group">
                    <a href="{{ route('avvisi.create-avviso-cliente') }}" class="profile-btn">Invia avviso a cittadino</a>
                    <a href="{{ route('avvisi.lavoratore') }}" class="profile-btn">Visualizza avvisi inviati</a>
                    <a href="{{ route('avvisi.admin') }}" class="profile-btn">Visualizza richieste clienti</a>
                    <a href="{{ route('lavoratori.create') }}" class="profile-btn">Aggiungi lavoratore</a>
                    <a href="{{ route('calendario.edit') }}" class="profile-btn">Modifica calendario</a>
                    <a href="#" class="profile-btn"
                        style="background:#b3baff; color:#fff; cursor: not-allowed;">Funzionalità in arrivo</a>
                </div>
            @endif
        </div>
    </div>
</body>

</html>