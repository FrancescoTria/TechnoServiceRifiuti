<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiungi Lavoratore - TechnoService</title>
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
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12), 0 1.5px 4px rgba(0, 0, 0, 0.08);
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

        .profile-forms {
            max-width: 600px;
            margin: 0 auto;
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
        }

        .profile-btn:hover,
        .profile-btn:focus {
            background: #829B22;
            color: #fff;
            box-shadow: 0 0 24px 2px #829B2255;
            transform: translateY(-2px) scale(1.03);
        }

        .profile-form-label {
            color: #829B22;
            font-weight: bold;
            font-size: 1.13em;
            margin-bottom: 4px;
            display: block;
            letter-spacing: 1px;
        }

        .profile-form-input {
            border: 2px solid #829B22 !important;
            border-radius: 7px;
            padding: 10px;
            font-size: 1.08em;
            width: 100%;
            margin-bottom: 8px;
            box-shadow: none;
            transition: border 0.2s, box-shadow 0.2s;
        }

        .profile-form-input:focus {
            border-color: #829B22 !important;
            box-shadow: 0 0 0 2px #c6e27b;
            outline: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Aggiungi lavoratore</h1>
        <div class="links">
            <a href="/" class="nav-link">Home</a>
            <a href="{{ route('calendario') }}" class="nav-link">Calendario</a>
            <a href="{{ route('dashboard.lavoratore') }}" class="nav-link">Dashboard Lavoratore</a>
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
            <div
                style="background:#eaf5d0; color:#4a5a1c; padding:12px; border-radius:8px; margin-bottom:18px; text-align:center; font-weight:bold; box-shadow:0 1px 4px #c6e27b;">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div style="background:#ffdddd; color:#b30000; padding:12px; border-radius:8px; margin-bottom:18px;">
                <ul style="margin:0; padding-left:18px; text-align:left;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="profile-forms">
            <form method="POST" action="{{ route('lavoratori.store') }}">
                @csrf
                <div class="mb-4">
                    <label for="nome" class="profile-form-label">Nome</label>
                    <input type="text" name="nome" id="nome" class="profile-form-input" required>
                </div>
                <div class="mb-4">
                    <label for="cognome" class="profile-form-label">Cognome</label>
                    <input type="text" name="cognome" id="cognome" class="profile-form-input" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="profile-form-label">Email</label>
                    <input type="email" name="email" id="email" class="profile-form-input" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="profile-form-label">Password</label>
                    <input type="password" name="password" id="password" class="profile-form-input" required>
                </div>
                <button type="submit" class="profile-btn" style="width:100%; margin-top:18px;">Aggiungi
                    lavoratore</button>
            </form>
        </div>
    </div>
</body>

</html>