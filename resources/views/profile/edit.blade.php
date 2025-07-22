<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profilo - TechnoService</title>
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

        .profile-section {
            margin: 40px 0;
            text-align: center;
        }

        .profile-section h2 {
            color: #829B22;
            font-size: 1.7em;
            margin-bottom: 12px;
        }

        .profile-section p {
            font-size: 1.1em;
            color: #333;
        }

        .avatar {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #b3baff;
            margin-bottom: 18px;
            background: #e0e7ff;
            display: inline-block;
        }

        .user-card {
            background: #f6f8ff;
            border-radius: 18px;
            box-shadow: 0 2px 8px #e0e7ff;
            padding: 28px 18px 18px 18px;
            max-width: 350px;
            margin: 0 auto 30px auto;
            text-align: center;
        }

        .user-card h2 {
            color: #829B22;
            font-size: 1.5em;
            margin-bottom: 6px;
        }

        .user-card p {
            color: #555;
            font-size: 1.1em;
            margin-bottom: 0;
        }

        .section-divider {
            border: none;
            border-top: 1.5px dashed #829B22;
            margin: 36px 0 28px 0;
        }

        .profile-forms {
            max-width: 600px;
            margin: 0 auto;
        }

        .icon {
            font-size: 2.2em;
            color: #829B22;
            margin-bottom: 8px;
        }

        /* Stile custom per i bottoni della pagina profilo */
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
        <div class="links">
            <a href="/">Home</a>
            <a href="{{ route('calendario') }}">Calendario</a>
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
        </div>
        <h1>Profilo</h1>

        <div class="profile-forms">
            @include('profile.partials.update-profile-information-form')
            <hr class="section-divider">
            <span class="icon">🔒</span>
            @include('profile.partials.update-password-form')
            <hr class="section-divider">
            <span class="icon">🗑️</span>
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</body>

</html>