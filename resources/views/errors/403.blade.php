<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accesso Negato - 403</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eaf5d0;
            margin: 0;
            padding: 0;
        }

        .container-403 {
            max-width: 700px;
            margin: 60px auto;
            background: #fff;
            padding: 36px 30px 30px 30px;
            border-radius: 24px;
            box-shadow: 0 8px 32px #c6e27b, 0 1.5px 4px #eaf5d0;
            text-align: center;
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

        .error-title {
            color: #b30000;
            font-size: 2.5em;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .error-msg {
            color: #829B22;
            font-size: 1.3em;
            margin-bottom: 24px;
        }

        .back-btn {
            background: #829B22;
            color: #fff;
            padding: 12px 36px;
            border-radius: 12px;
            text-decoration: none;
            font-size: 1.1em;
            font-weight: bold;
            box-shadow: none;
            transition: background 0.2s, box-shadow 0.2s, transform 0.1s;
            border: none;
            display: inline-block;
            margin-top: 10px;
            cursor: pointer;
            letter-spacing: 1px;
        }

        .back-btn:hover {
            background: #6b7e1a;
            box-shadow: 0 4px 16px #b3baff;
            transform: translateY(-2px) scale(1.03);
        }
    </style>
</head>

<body>
    <div class="container-403">
        <div class="links">
            <a href="/" class="nav-link">Home</a>
            <a href="{{ route('calendario') }}" class="nav-link">Calendario</a>
            @auth('lavoratori')
                <a href="{{ route('dashboard.lavoratore') }}" class="nav-link">Dashboard Lavoratore</a>
                <a href="{{ route('profile.lavoratore.edit') }}" class="nav-link">Profilo</a>
            @elseauth
                <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
                <a href="{{ route('profile.edit') }}" class="nav-link">Profilo</a>
            @endauth
        </div>
        <div class="error-title">403 - Accesso Negato</div>
        <div class="error-msg">Non hai i permessi per accedere a questa pagina.<br>Se pensi sia un errore, contatta
            l'amministratore.</div>
        <a href="/" class="back-btn">Torna alla Home</a>
    </div>
</body>

</html>