<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TechnoService</title>
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
            max-width: 950px;
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

        .login-motiv {
            text-align: center;
            color: #4a5a1c;
            font-size: 1.13em;
            margin-bottom: 32px;
        }

        .login-flex {
            display: flex;
            gap: 40px;
            justify-content: center;
            align-items: flex-start;
            flex-wrap: wrap;
        }

        .login-box {
            flex: 1;
            min-width: 320px;
            max-width: 400px;
            background: #f8fbe9;
            border-radius: 18px;
            box-shadow: 0 2px 8px #eaf5d0;
            padding: 28px 18px 18px 18px;
            margin-bottom: 18px;
        }

        .login-title {
            text-align: center;
            color: #829B22;
            font-size: 1.3em;
            margin-bottom: 18px;
            font-weight: bold;
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
        .block.mt-1.w-full:focus {
            border-color: #829B22 !important;
            box-shadow: 0 2px 8px #829B22;
            outline: none;
            background: #fff;
        }

        .remember-label {
            color: #829B22;
            font-size: 1em;
            font-weight: normal;
            margin-left: 4px;
        }

        .login-btn {
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

        .login-btn:hover,
        .login-btn:focus {
            background: #6b7e1a;
            box-shadow: 0 4px 16px #b3baff;
            transform: translateY(-2px) scale(1.03);
        }

        .forgot-link {
            color: #829B22;
            font-size: 1em;
            text-decoration: underline;
            margin-right: 12px;
        }

        .forgot-link:hover {
            color: #5d6e18;
        }

        .input-error {
            color: #b30000;
            font-size: 0.98em;
            margin-bottom: 8px;
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

            .login-flex {
                flex-direction: column;
                gap: 0;
            }

            .login-box {
                max-width: 100%;
                margin-bottom: 18px;
            }
        }
    </style>
</head>

<body>
    <div class="container-login">
        <div class="login-title-main">Portale di accesso</div>
        <div class="links" style="text-align:center; margin-bottom:30px;">
            <a href="/" class="nav-link">Home</a>
            <a href="{{ route('login') }}" class="nav-link">Accedi</a>
            <a href="{{ route('register') }}" class="nav-link">Registrati</a>
            <a href="{{ route('calendario') }}" class="nav-link">Calendario</a>
        </div>
        <div class="login-flex">
            <div class="login-box">
                <div class="login-title">Accesso cittadini</div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div>
                        <label for="email" class="input-label">Email</label>
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="input-error mt-2" />
                    </div>
                    <div class="mt-4">
                        <label for="password" class="input-label">Password</label>
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                            autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="input-error mt-2" />
                    </div>
                    <div class="flex items-center justify-between mt-4">
                        <div style="flex:1; display:flex; align-items:center; justify-content:space-between;">
                            <label for="remember_me" class="inline-flex items-center" style="margin-bottom:0;">
                                <input id="remember_me" type="checkbox"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                    name="remember">
                                <span class="remember-label">Ricordami</span>
                            </label>
                            @if (Route::has('password.request'))
                                <a class="forgot-link" href="{{ route('password.request') }}">Password dimenticata?</a>
                            @endif
                        </div>
                        <button type="submit" class="login-btn">Accedi</button>
                    </div>
                </form>
            </div>
            <div class="login-box">
                <div class="login-title">Accesso lavoratori</div>
                <form method="POST" action="{{ route('login.lavoratori') }}">
                    @csrf
                    <div>
                        <label for="email_lav" class="input-label">Email</label>
                        <x-text-input id="email_lav" class="block mt-1 w-full" type="email" name="email_lav" required
                            autofocus autocomplete="username" :value="old('email_lav')" />
                        <x-input-error :messages="$errors->lavoratore->get('email_lav')" class="input-error mt-2" />
                    </div>
                    <div class="mt-4">
                        <label for="password_lav" class="input-label">Password</label>
                        <x-text-input id="password_lav" class="block mt-1 w-full" type="password" name="password_lav"
                            required autocomplete="current-password" />
                    </div>
                    <div class="flex items-center justify-between mt-4">
                        <div style="flex:1; display:flex; align-items:center; justify-content:space-between;">
                            <label for="remember_me_lav" class="inline-flex items-center" style="margin-bottom:0;">
                                <input id="remember_me_lav" type="checkbox"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                    name="remember">
                                <span class="remember-label">Ricordami</span>
                            </label>
                            <span class="forgot-link">Password dimenticata?</span>
                        </div>
                        <button type="submit" class="login-btn">Accedi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>