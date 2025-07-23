<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione - TechnoService</title>
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #eaf5d0;
            margin: 0;
            padding: 0;
        }

        .links {
            text-align: center;
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

        .container-login {
            max-width: 700px;
            margin: 40px auto 40px auto;
            background: #fff;
            padding: 36px 30px 30px 30px;
            border-radius: 24px;
            box-shadow: 0 8px 32px #c6e27b, 0 1.5px 4px #eaf5d0;
        }

        .login-title-main {
            text-align: center;
            color: #829B22;
            font-size: 2.1em;
            font-weight: bold;
            margin-bottom: 10px;
            letter-spacing: 1px;
        }

        label,
        .input-label {
            color: #829B22;
            font-weight: bold;
            font-size: 1.08em;
            margin-bottom: 4px;
            display: block;
        }

        input[type="email"],
        input[type="password"],
        input[type="text"],
        .block.mt-1.w-full {
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

        input[type="email"]:focus,
        input[type="password"]:focus,
        input[type="text"]:focus,
        .block.mt-1.w-full:focus {
            border-color: #829B22 !important;
            box-shadow: 0 2px 8px #829B22;
            outline: none;
            background: #fff;
        }

        .input-error {
            color: #b30000;
            font-size: 0.98em;
            margin-bottom: 8px;
        }

        .register-btn {
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

        .register-btn:hover,
        .register-btn:focus {
            background: #6b7e1a;
            box-shadow: 0 4px 16px #b3baff;
            transform: translateY(-2px) scale(1.03);
        }

        .mt-4 {
            margin-top: 1.2em !important;
        }

        .mt-2 {
            margin-top: 0.7em !important;
        }

        @media (max-width: 900px) {
            .container-login {
                padding: 18px 2vw;
            }
        }
    </style>
</head>

<body>
    <div class="container-login">
        <div class="login-title-main">Registrazione cittadino</div>
        <div class="links" style="text-align:center; margin-bottom:30px;">
            <a href="/" class="nav-link">Home</a>
            <a href="{{ route('login') }}" class="nav-link">Accedi</a>
            <a href="{{ route('register') }}" class="nav-link">Registrati</a>
            <a href="{{ route('calendario') }}" class="nav-link">Calendario</a>
        </div>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div>
                <label for="nome" class="input-label">Nome</label>
                <x-text-input id="nome" class="block mt-1 w-full" type="text" name="nome" :value="old('nome')" required
                    autofocus />
                <x-input-error :messages="$errors->get('nome')" class="input-error mt-2" />
            </div>
            <div class="mt-4">
                <label for="cognome" class="input-label">Cognome</label>
                <x-text-input id="cognome" class="block mt-1 w-full" type="text" name="cognome" :value="old('cognome')"
                    required />
                <x-input-error :messages="$errors->get('cognome')" class="input-error mt-2" />
            </div>
            <div class="mt-4">
                <label for="email" class="input-label">Email</label>
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required />
                <x-input-error :messages="$errors->get('email')" class="input-error mt-2" />
            </div>
            <div class="mt-4">
                <label for="password" class="input-label">Password</label>
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="input-error mt-2" />
            </div>
            <div class="mt-4">
                <label for="password_confirmation" class="input-label">Conferma Password</label>
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="input-error mt-2" />
            </div>
            <button type="submit" class="register-btn">Registrati</button>
        </form>
    </div>
</body>

</html>