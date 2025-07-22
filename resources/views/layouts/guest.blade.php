<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
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
            margin-top: 0;
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

        .link-nice {
            color: #829B22;
            font-weight: 500;
            text-decoration: none;
            padding: 4px 10px;
            border-radius: 6px;
            transition: color 0.2s, background 0.2s;
            font-size: 1em;
        }

        .link-nice:hover {
            color: #829B22;
            text-decoration: none;
        }

        label {
            color: #829B22;
            font-weight: bold;
        }

        input,
        select,
        textarea {
            border: 2px solid #829B22;
            border-radius: 5px;
            padding: 7px;
            margin-bottom: 10px;
            font-size: 1em;
            width: 100%;
            box-sizing: border-box;
            transition: border 0.2s, box-shadow 0.2s;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: #829B22;
            box-shadow: 0 0 0 2px #c6e27b;
            outline: none;
        }

        button,
        .btn,
        .primary-button,
        [type="submit"] {
            background: #829B22;
            color: #fff;
            padding: 12px 32px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 1.1em;
            font-weight: bold;
            box-shadow: 0 2px 8px #b3baff;
            transition: background 0.2s, box-shadow 0.2s, transform 0.1s;
            border: none;
            display: inline-block;
            margin-top: 10px;
            cursor: pointer;
            letter-spacing: 1px;
        }

        button:hover,
        .btn:hover,
        .primary-button:hover,
        [type="submit"]:hover {
            box-shadow: 0 4px 16px #b3baff;
            transform: translateY(-2px) scale(1.03);
        }

        .error {
            color: #ff9800;
            font-size: 0.95em;
            margin-bottom: 8px;
        }

        .logo-small {
            width: 60px;
            height: 60px;
            display: inline-block;
        }

        input[type="checkbox"] {
            accent-color: #829B22;
            width: 18px;
            height: 18px;
            margin-right: 8px;
            vertical-align: middle;
            border-radius: 4px;
            border: 1.5px solid #b3baff;
            box-shadow: 0 1px 2px #e0e7ff;
            cursor: pointer;
        }

        .remember-label {
            font-size: 1em;
            color: #829B22;
            font-weight: 500;
            vertical-align: middle;
            cursor: pointer;
            user-select: none;
        }

        .guest-content {
            margin-top: 40px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="links">
            <a href="/">Home</a>
            <a href="{{ route('login') }}">Accedi</a>
            <a href="{{ route('register') }}">Registrati</a>
            <a href="{{ route('calendario') }}">Calendario</a>
        </div>
        <div class="guest-content">
            {{ $slot }}
        </div>
    </div>
</body>

</html>