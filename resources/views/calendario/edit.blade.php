@extends('layouts.app')

@section('content')
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eaf5d0;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 32px auto;
            background: #fff;
            padding: 2px 32px 2px 32px;
            border-radius: 16px;
            box-shadow: 0 8px 32px #eaf5d0, 0 1.5px 4px #eaf5d0;
        }

        h1 {
            text-align: center;
            color: #829B22;
            font-size: 2.7em;
            letter-spacing: 2px;
            margin-bottom: 18px;
            font-weight: bold;
        }

        .success-msg {
            background: #eaf5d0;
            color: #4a5a1c;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 18px;
            text-align: center;
            font-weight: bold;
            box-shadow: 0 1px 4px #c6e27b;
        }

        table.calendario-edit {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-bottom: 24px;
            background: #f8fbe9;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 2px 8px #eaf5d0;
        }

        table.calendario-edit th {
            background: #829B22;
            color: #fff;
            letter-spacing: 1px;
            font-size: 1.13em;
            padding: 14px 8px;
            border: none;
        }

        table.calendario-edit td {
            padding: 10px 8px;
            text-align: center;
            background: #fff;
            border-bottom: 1.5px solid #eaf5d0;
            font-size: 1.08em;
        }

        table.calendario-edit tr:last-child td {
            border-bottom: none;
        }

        table.calendario-edit tr:nth-child(even) td {
            background: #f3f8e6;
        }

        .giorno-label {
            font-weight: bold;
            color: #829B22;
            font-size: 1.08em;
        }

        select,
        input[type="time"] {
            width: 100%;
            padding: 8px;
            border-radius: 8px;
            border: 2px solid #b3baff;
            font-size: 1.08em;
            background: #f8fbe9;
            transition: border 0.2s, box-shadow 0.2s;
        }

        select:disabled,
        input[type="time"]:disabled {
            background: #f3f3f3;
            color: #aaa;
        }

        .nessun-ritiro-checkbox {
            width: 20px;
            height: 20px;
            accent-color: #829B22;
            margin-right: 6px;
        }

        .nessun-ritiro-label {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            font-size: 1.08em;
            color: #829B22;
            font-weight: bold;
            cursor: pointer;
            user-select: none;
        }

        .profile-btn {
            background: #829B22;
            color: #fff;
            border: none;
            border-radius: 14px;
            font-size: 1.15em;
            font-weight: bold;
            padding: 14px 36px;
            box-shadow: 0 0 12px 1px #829B2233;
            transition: box-shadow 0.18s, transform 0.12s, background 0.18s;
            outline: none;
            letter-spacing: 1px;
            margin: 0 8px;
            display: inline-block;
        }

        .profile-btn:hover,
        .profile-btn:focus {
            background: #5d6e18;
            color: #fff;
            box-shadow: 0 0 24px 2px #829B2255;
            transform: translateY(-2px) scale(1.03);
        }
    </style>
    <div class="container">
        <h1>Modifica Calendario</h1>
        <div class="links" style="text-align:center; margin-bottom:30px;">
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
            <div class="success-msg">{{ session('success') }}</div>
        @endif
        <form method="POST" action="{{ route('calendario.update') }}">
            @csrf
            <table class="calendario-edit">
                <tr>
                    <th>Giorno</th>
                    <th>Rifiuto</th>
                    <th>Fascia oraria</th>
                    <th></th>
                </tr>
                @foreach($giorni as $giorno)
                    <tr>
                        <td class="giorno-label">{{ $giorno->giorno }}</td>
                        <input type="hidden" name="calendario[{{ $giorno->giorno }}][giorno]" value="{{ $giorno->giorno }}">
                        <td>
                            <select name="calendario[{{ $giorno->giorno }}][rifiuto]" @if(empty($giorno->rifiuto)) disabled
                            @endif>
                                <option value="Organico" @if($giorno->rifiuto == 'Organico') selected @endif>Organico</option>
                                <option value="Vetro" @if($giorno->rifiuto == 'Vetro') selected @endif>Vetro</option>
                                <option value="Carta" @if($giorno->rifiuto == 'Carta') selected @endif>Carta</option>
                                <option value="Plastica" @if($giorno->rifiuto == 'Plastica') selected @endif>Plastica</option>
                                <option value="Indifferenziato" @if($giorno->rifiuto == 'Indifferenziato') selected @endif>
                                    Indifferenziato</option>
                            </select>
                        </td>
                        <td style="min-width:120px;">
                            <input type="time" name="calendario[{{ $giorno->giorno }}][fascia_oraria]"
                                value="{{ $giorno->fascia_oraria }}" @if(empty($giorno->fascia_oraria)) disabled @endif>
                        </td>
                        <td style="text-align:center;">
                            <label class="nessun-ritiro-label">
                                <input type="checkbox" class="nessun-ritiro-checkbox" data-row="{{ $giorno->giorno }}"
                                    @if(empty($giorno->rifiuto) && empty($giorno->fascia_oraria)) checked @endif>
                                Nessun ritiro
                            </label>
                        </td>
                    </tr>
                @endforeach
            </table>
            <button type="submit" class="profile-btn" style="width:100%; margin-top:18px;">Salva modifiche</button>
        </form>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.nessun-ritiro-checkbox').forEach(function (checkbox) {
            const rowKey = checkbox.getAttribute('data-row');
            const tr = checkbox.closest('tr');
            const select = tr.querySelector('select');
            const timeInput = tr.querySelector('input[type="time"]');
            checkbox.addEventListener('change', function () {
                if (checkbox.checked) {
                    select.value = '';
                    select.disabled = true;
                    timeInput.value = '';
                    timeInput.disabled = true;
                } else {
                    select.disabled = false;
                    select.value = select.querySelector('option[value="Organico"]') ? 'Organico' : '';
                    timeInput.disabled = false;
                    timeInput.value = '00:00';
                }
            });
        });
    });
</script>