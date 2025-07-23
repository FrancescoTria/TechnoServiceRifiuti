<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage - Calendario Settimanale</title>
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
            padding: 38px 30px 30px 30px;
            border-radius: 24px;
            box-shadow: 0 8px 32px #c6e27b, 0 1.5px 4px #eaf5d0;
        }

        h1 {
            text-align: center;
            color: #829B22;
            font-size: 2.7em;
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
            text-decoration: none;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            table-layout: fixed;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
            width: calc(100% / 7);
            word-break: break-word;
            font-size: 1rem;
        }

        th {
            background: #829B22;
            color: #fff;
            letter-spacing: 1px;
        }

        .feature-list {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
            margin: 30px 0 10px 0;
        }

        .feature-item {
            background: #eaf5d0;
            border-radius: 16px;
            box-shadow: 0 2px 8px #c6e27b;
            padding: 26px 18px 18px 18px;
            min-width: 170px;
            max-width: 220px;
            text-align: center;
            font-size: 1.13em;
            margin-bottom: 10px;
            transition: box-shadow 0.2s, background 0.2s;
            color: #4a5a1c;
        }

        .feature-item:hover {
            background: #c6e27b;
            box-shadow: 0 4px 16px #b3baff;
        }

        .feature-emoji {
            font-size: 2.1em;
            margin-bottom: 8px;
            display: block;
        }

        .cta-btn {
            background: linear-gradient(90deg, #829B22 60%, #b3baff 100%);
            color: #fff;
            padding: 18px 48px;
            border-radius: 12px;
            text-decoration: none;
            font-size: 1.4em;
            font-weight: bold;
            box-shadow: 0 2px 12px #b3baff;
            transition: background 0.2s, box-shadow 0.2s;
            border: none;
            display: inline-block;
            margin: 30px 0 0 0;
        }

        .cta-btn:hover {
            background: linear-gradient(90deg, #b3baff 0%, #829B22 100%);
            box-shadow: 0 4px 24px #b3baff;
        }

        .faq-section strong {
            color: #829B22;
        }

        .contact-form input,
        .contact-form textarea {
            border: 1px solid #b3baff;
            border-radius: 5px;
            padding: 7px;
            margin-bottom: 10px;
            font-size: 1em;
        }

        .contact-form button {
            background: #2a3990;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 4px;
            font-size: 1em;
            width: 100%;
            margin-top: 5px;
            transition: background 0.2s;
        }

        .contact-form button:hover {
            background: #ff9800;
        }
    </style>
</head>

<body>
    <div class="container">
        <div style="text-align:center; margin-bottom: 24px;">
            <x-application-logo style="margin:0 auto; display:block; width: 180px; height: 180px;" />
        </div>

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

            x-application-logo svg,
            x-application-logo img {
                width: 180px !important;
                height: 180px !important;
                display: block;
                margin: 0 auto;
            }
        </style>

        <!-- Sezione motivazionale -->
        <div class="feature-item"
            style="background:#eaf5d0; border-radius:16px; box-shadow:0 2px 8px #c6e27b; padding:1px 18px 18px 18px; min-width:170px; max-width:600px; text-align:center; font-size:1.13em; margin:36px auto 0 auto; color:#4a5a1c;">
            <h3 style="color:#829B22; font-size:1.35em; margin-bottom:10px;">Insieme per una città più pulita e
                sostenibile</h3>
            <p style="color:#4a5a1c; font-size:1.13em; max-width:600px; margin:0 auto;">
                Ogni piccolo gesto conta! Con TechnoService puoi contribuire attivamente a migliorare la qualità della
                vita nella tua comunità.<br>
                Restiamo aggiornati, rispettiamo l'ambiente e costruiamo un futuro più verde, giorno dopo giorno.
            </p>
        </div>
        <div style="margin: 40px 0; text-align: center;">
            <h3 style="color:#829B22; font-size:1.35em; margin-bottom:10px;">Perchè scegliere TechnoService?</h3>
            <div class="feature-list">
                <div class="feature-item"><span class="feature-emoji">📅</span>Consulta facilmente il calendario della
                    raccolta rifiuti</div>
                <div class="feature-item"><span class="feature-emoji">🔔</span>Per qualsiasi problema contattaci tramite
                    la sezione richieste! </div>
                <div class="feature-item"><span class="feature-emoji">📱</span>Accedi da qualsiasi dispositivo</div>
                <div class="feature-item"><span class="feature-emoji">🌱</span>Rispetta l'ambiente con info aggiornate
                </div>
                <div class="feature-item"><span class="feature-emoji">💸</span>Servizio gratuito e sempre disponibile
                </div>
            </div>
        </div>


    </div>
</body>

</html>