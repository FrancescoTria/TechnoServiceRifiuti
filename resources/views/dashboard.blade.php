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
    </style>
</head>

<body>
    <div class="container">
        <div class="links">
            <a href="/">Home</a>
            <a href="{{ route('calendario') }}">Calendario</a>
            <a href="{{ route('profile.edit') }}">Profilo</a>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
        </div>
        <h1>Dashboard</h1>
        <div class="welcome">
            <h2>Ciao {{ Auth::user()->nome }} {{ Auth::user()->cognome }}!</h2>
            <p>Benvenuto nella tua area riservata. Qui puoi gestire il tuo profilo e consultare il calendario della
                raccolta rifiuti.</p>
        </div>
    </div>
</body>

</html>