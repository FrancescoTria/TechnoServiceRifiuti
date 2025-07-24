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
            text-align: center;
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
            text-align: center;
        }

        select,
        input[type="time"],
        input[type="text"] {
            width: 100%;
            padding: 8px;
            border-radius: 8px;
            border: 2px solid #b3baff;
            font-size: 1.08em;
            background: #f8fbe9;
            transition: border 0.2s, box-shadow 0.2s;
            text-align: center;
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

        <div class="links"
            style="display:flex; justify-content:center; align-items:center; gap:32px; margin-top: 20px; margin-bottom:30px; flex-wrap:nowrap; white-space:nowrap;">
            <a href="/" class="nav-link">Home</a>
            <a href="{{ route('dashboard.lavoratore') }}" class="nav-link">Dashboard Lavoratore</a>
            <a href="{{ route('profile.lavoratore.edit') }}" class="nav-link">Profilo</a>
            <a href="{{ route('calendario') }}" class="nav-link">Calendario</a>
            <a href="{{ route('logout.lavoratori') }}" class="nav-link"
                onclick="event.preventDefault(); document.getElementById('logout-form-lavoratore').submit();">Logout</a>
            <form id="logout-form-lavoratore" action="{{ route('logout.lavoratori') }}" method="POST"
                style="display: none;">@csrf</form>
        </div>
        <style>
            .links .nav-link {
                margin: 0 10px;
                text-decoration: none;
                color: #829B22;
                font-weight: bold;
                font-size: 1.1em;
                transition: color 0.2s, background 0.2s;
                padding: 8px 14px;
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

            @media (max-width: 700px) {
                .links {
                    gap: 10px !important;
                }

                .links .nav-link {
                    font-size: 0.98em;
                    padding: 6px 7px;
                }
            }
        </style>
        <form method="GET" action="{{ route('calendario.edit') }}" style="margin-bottom: 24px; text-align:center;">
            <label for="cap" style="font-weight:bold; color:#829B22; font-size:1.1em;">Seleziona il CAP:</label>
            <select id="cap" name="cap"
                style="padding:8px; border-radius:6px; border:2px solid #829B22; margin:0 10px; width:140px;">
                <option value="">Seleziona CAP</option>
                @foreach(\App\Models\Calendario::select('CAP')->distinct()->orderBy('CAP')->get() as $cap)
                    <option value="{{ $cap->CAP }}" @if(request('cap') == $cap->CAP) selected @endif>{{ $cap->CAP }}</option>
                @endforeach
            </select>
            <button type="submit"
                style="background:#829B22; color:#fff; border:none; border-radius:8px; padding:8px 18px; font-weight:bold;">Cerca</button>
        </form>
        @if(session('success'))
            <div class="success-msg">{{ session('success') }}</div>
        @endif
        @if(isset($calendario))
            <form method="POST" action="{{ route('calendario.update') }}">
                @csrf
                <input type="hidden" name="cap" value="{{ request('cap') }}">
                <table class="calendario-edit">
                    <tr>
                        <th>Giorno</th>
                        <th>Rifiuto</th>
                    </tr>
                    @php
                        $giorniSettimana = ['lunedì', 'martedì', 'mercoledì', 'giovedì', 'venerdì', 'sabato', 'domenica'];
                    @endphp
                    @foreach($calendario as $row)
                        @foreach($giorniSettimana as $giorno)
                            <tr>
                                <td class="giorno-label" style="text-transform: capitalize;">{{ $giorno }}</td>
                                <td>
                                    <select name="calendario[{{ $row->CAP }}][{{ $giorno }}]" class="profile-form-input">
                                        <option value="" @if(empty($row->$giorno)) selected @endif>-- Nessun rifiuto --</option>
                                        <option value="organico" @if($row->$giorno == 'organico') selected @endif>Organico</option>
                                        <option value="plastica" @if($row->$giorno == 'plastica') selected @endif>Plastica</option>
                                        <option value="vetro" @if($row->$giorno == 'vetro') selected @endif>Vetro</option>
                                        <option value="carta" @if($row->$giorno == 'carta') selected @endif>Carta</option>
                                        <option value="indifferenziato" @if($row->$giorno == 'indifferenziato') selected @endif>
                                            Indifferenziato</option>
                                    </select>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </table>
                <div style="margin-top: 18px; text-align: center; color: #333; font-weight:bold;">
                    Fascia oraria:
                    <input type="time" name="fascia_oraria_start"
                        value="{{ isset($calendario[0]) && $calendario[0]->fascia_oraria_ ? explode('-', $calendario[0]->fascia_oraria_)[0] : '' }}"
                        class="profile-form-input" style="width:110px; display:inline-block; margin-left:8px;">
                    -
                    <input type="time" name="fascia_oraria_end"
                        value="{{ isset($calendario[0]) && $calendario[0]->fascia_oraria_ ? explode('-', $calendario[0]->fascia_oraria_)[1] ?? '' : '' }}"
                        class="profile-form-input" style="width:110px; display:inline-block;">
                </div>
                <button type="submit" class="profile-btn" style="width:100%; margin-top:18px;">Salva modifiche</button>
            </form>
        @endif
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