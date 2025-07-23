<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profilo Lavoratore - TechnoService</title>
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
            max-width: 400px;
            margin: 0 auto;
            background: #f8fbe9;
            border-radius: 18px;
            box-shadow: 0 2px 8px #eaf5d0;
            padding: 28px 18px 18px 18px;
            margin-bottom: 18px;
        }

        .profile-btn {
            background: #829B22;
            color: #fff;
            padding: 14px 0;
            border-radius: 12px;
            text-decoration: none;
            font-size: 1.2em;
            font-weight: bold;
            box-shadow: none;
            transition: background 0.2s, box-shadow 0.2s, transform 0.1s;
            border: none;
            display: block;
            width: 100%;
            margin-top: 10px;
            cursor: pointer;
            letter-spacing: 1px;
        }

        .profile-btn:hover,
        .profile-btn:focus {
            background: #6b7e1a;
            box-shadow: 0 4px 16px #b3baff;
            transform: translateY(-2px) scale(1.03);
        }

        .profile-form-label {
            color: #829B22;
            font-weight: bold;
            font-size: 1.08em;
            margin-bottom: 4px;
            display: block;
        }

        .profile-form-input {
            border: 2px solid #c6e27b !important;
            border-radius: 7px;
            padding: 10px;
            font-size: 1.08em;
            width: 100%;
            max-width: 100%;
            margin-bottom: 8px;
            box-shadow: 0 1px 4px #e0e7ff;
            transition: border 0.2s, box-shadow 0.2s;
            background: #fff;
            box-sizing: border-box;
        }

        .profile-form-input:focus {
            border-color: #829B22 !important;
            box-shadow: 0 2px 8px #829B22;
            outline: none;
            background: #fff;
        }

        .profile-form-error {
            color: #b30000;
            font-size: 0.98em;
            margin-bottom: 8px;
        }

        .section-divider {
            border: none;
            border-top: 1.5px dashed #829B22;
            margin: 36px 0 28px 0;
        }

        .icon {
            font-size: 2.2em;
            color: #829B22;
            margin-bottom: 8px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Profilo Lavoratore</h1>
        <div class="links" style="text-align:center; margin-bottom:30px;">
            <a href="/" class="nav-link">Home</a>
            <a href="{{ route('calendario') }}" class="nav-link">Calendario</a>
            <a href="{{ route('dashboard.lavoratore') }}" class="nav-link">Dashboard Lavoratore</a>
            <a href="{{ route('profile.lavoratore.edit') }}" class="nav-link">Profilo</a>
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
        <form method="POST" action="{{ route('profile.lavoratore.update') }}">
            @csrf
            <div>
                <label for="nome" class="profile-form-label">Nome</label>
                <input type="text" name="nome" id="nome" class="profile-form-input"
                    value="{{ old('nome', $lavoratore->nome) }}" required>
            </div>
            <div class="mt-4">
                <label for="cognome" class="profile-form-label">Cognome</label>
                <input type="text" name="cognome" id="cognome" class="profile-form-input"
                    value="{{ old('cognome', $lavoratore->cognome) }}" required>
            </div>
            <div class="mt-4">
                <label for="email" class="profile-form-label">Email</label>
                <input type="email" name="email" id="email" class="profile-form-input"
                    value="{{ old('email', $lavoratore->email) }}" required>
            </div>
            <div class="mt-4">
                <label for="password" class="profile-form-label">Nuova password (opzionale)</label>
                <input type="password" name="password" id="password" class="profile-form-input">
            </div>
            <div class="mt-4">
                <label for="password_confirmation" class="profile-form-label">Conferma password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="profile-form-input">
            </div>
            <button type="submit" class="profile-btn">Salva modifiche</button>
        </form>
        <hr class="section-divider">
        <span class="icon">🗑️</span>
        <section style="margin-top: 30px;">
            <h2 style="color:#829B22; font-size:1.3em; letter-spacing:1px;">Elimina account</h2>
            <p style="color:#555;">Una volta eliminato l'account, tutti i dati saranno persi. Conferma la tua
                password per procedere.</p>
            <form method="POST" action="{{ route('profile.lavoratore.destroy') }}" style="margin-top:18px;">
                @csrf
                @method('DELETE')
                <label for="delete_password" class="profile-form-label">Password</label>
                <input id="delete_password" name="password" type="password" class="profile-form-input"
                    placeholder="Password" required />
                @if($errors->has('deleteLavoratore'))
                    <div class="profile-form-error">{{ $errors->first('deleteLavoratore') }}</div>
                @endif
                <button type="submit" class="profile-btn" style="margin-top: 1.5rem; background:#b30000;">Elimina
                    account</button>
            </form>
        </section>

    </div>
</body>

</html>