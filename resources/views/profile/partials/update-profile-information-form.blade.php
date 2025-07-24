{{-- @var $user \App\Models\User|\Illuminate\Contracts\Auth\MustVerifyEmail --}}
<section>
    <heade>
        <span class="icon" style="font-size:2.2em; color:#829B22; display:block; margin-bottom:8px;">👤</span>
        <h2 class="text-lg font-medium text-gray-900" style="color:#829B22; font-size:1.3em; letter-spacing:1px;">
            Modifica profilo</h2>
        <p class="mt-1 text-sm" style="color:#555;">Aggiorna le informazioni del tuo account e l'indirizzo email.</p>
        </header>

        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
            @csrf
            @method('patch')

            <div>
                <label for="nome" class="profile-form-label">Nome</label>
                <input id="nome" name="nome" type="text" class="profile-form-input"
                    value="{{ old('nome', $user->nome) }}" required autofocus autocomplete="given-name" />
                @if($errors->get('nome'))
                    <div class="profile-form-error">{{ $errors->first('nome') }}</div>
                @endif
            </div>
            <div>
                <label for="cognome" class="profile-form-label">Cognome</label>
                <input id="cognome" name="cognome" type="text" class="profile-form-input"
                    value="{{ old('cognome', $user->cognome) }}" required autocomplete="family-name" />
                @if($errors->get('cognome'))
                    <div class="profile-form-error">{{ $errors->first('cognome') }}</div>
                @endif
            </div>
            <div>
                <label for="email" class="profile-form-label">Email</label>
                <input id="email" name="email" type="email" class="profile-form-input"
                    value="{{ old('email', $user->email) }}" required autocomplete="username" />
                @if($errors->get('email'))
                    <div class="profile-form-error">{{ $errors->first('email') }}</div>
                @endif

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                    {{-- Messaggio email non verificata rimosso --}}
                @endif
            </div>
            <div class="indirizzo-row"
                style="display: flex; flex-wrap: wrap; gap: 16px; align-items: flex-end; margin-bottom: 1em;">
                <div style="flex:2; min-width:180px;">
                    <label for="indirizzo" class="profile-form-label">Indirizzo</label>
                    <input list="indirizzi-list" id="indirizzo" name="indirizzo" class="profile-form-input"
                        placeholder="Inizia a digitare la via..."
                        value="{{ old('indirizzo', $user->indirizzo?->nome_indirizzo ?? '') }}" autocomplete="off">
                    <datalist id="indirizzi-list">
                        @if(isset($indirizzi))
                            @foreach($indirizzi as $indirizzo)
                                <option value="{{ $indirizzo->nome_indirizzo }}">
                                    {{ $indirizzo->nome_indirizzo }}{{ $indirizzo->civico ? ', ' . $indirizzo->civico : '' }}{{ $indirizzo->CAP ? ' (' . $indirizzo->CAP . ')' : '' }}
                                </option>
                            @endforeach
                        @endif
                    </datalist>
                    @if($errors->get('indirizzo'))
                        <div class="profile-form-error">{{ $errors->first('indirizzo') }}</div>
                    @endif
                </div>
                <div style="flex:1; min-width:100px;">
                    <label for="civico" class="profile-form-label">Civico</label>
                    <input id="civico" name="civico" type="text" class="profile-form-input" placeholder="Civico"
                        value="{{ old('civico', $user->indirizzo?->civico ?? '') }}">
                    @if($errors->get('civico'))
                        <div class="profile-form-error">{{ $errors->first('civico') }}</div>
                    @endif
                </div>
                <div style="flex:1; min-width:100px;">
                    <label for="CAP" class="profile-form-label">CAP</label>
                    <input id="CAP" name="CAP" type="text" class="profile-form-input" placeholder="CAP"
                        value="{{ old('CAP', $user->indirizzo?->CAP ?? '') }}">
                    @if($errors->get('CAP'))
                        <div class="profile-form-error">{{ $errors->first('CAP') }}</div>
                    @endif
                </div>
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button class="profile-btn" style="margin-top: 1rem;">Salva</x-primary-button>

                @if (session('status') === 'profile-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                @endif
            </div>
        </form>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const viaInput = document.getElementById('indirizzo');
        const civicoInput = document.getElementById('civico');
        const capInput = document.getElementById('CAP');

        // Trasforma i campi CAP e civico in select dinamiche
        let capSelect = null;
        let civicoSelect = null;
        function renderCapSelect(options) {
            if (!capSelect) {
                capSelect = document.createElement('select');
                capSelect.id = 'CAP';
                capSelect.name = 'CAP';
                capSelect.className = capInput.className;
                capInput.parentNode.replaceChild(capSelect, capInput);
            }
            capSelect.innerHTML = '';
            options.forEach(function (cap) {
                let opt = document.createElement('option');
                opt.value = cap;
                opt.textContent = cap;
                capSelect.appendChild(opt);
            });
        }
        function renderCapInput() {
            if (capSelect) {
                capSelect.parentNode.replaceChild(capInput, capSelect);
                capSelect = null;
            }
        }
        function renderCivicoSelect(options) {
            if (!civicoSelect) {
                civicoSelect = document.createElement('select');
                civicoSelect.id = 'civico';
                civicoSelect.name = 'civico';
                civicoSelect.className = civicoInput.className;
                civicoInput.parentNode.replaceChild(civicoSelect, civicoInput);
            }
            civicoSelect.innerHTML = '';
            options.forEach(function (civico) {
                let opt = document.createElement('option');
                opt.value = civico;
                opt.textContent = civico;
                civicoSelect.appendChild(opt);
            });
        }
        function renderCivicoInput() {
            if (civicoSelect) {
                civicoSelect.parentNode.replaceChild(civicoInput, civicoSelect);
                civicoSelect = null;
            }
        }

        if (viaInput && civicoInput && capInput) {
            viaInput.addEventListener('change', function () {
                fetch(`/indirizzi/suggerimenti?nome_indirizzo=${encodeURIComponent(viaInput.value)}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length === 1) {
                            renderCivicoInput();
                            civicoInput.value = data[0].civico || '';
                            renderCapInput();
                            capInput.value = data[0].CAP || '';
                        } else if (data.length > 1) {
                            let civici = [...new Set(data.map(i => i.civico).filter(Boolean))];
                            let caps = [...new Set(data.map(i => i.CAP).filter(Boolean))];
                            if (civici.length > 1) {
                                renderCivicoSelect(civici);
                            } else {
                                renderCivicoInput();
                                civicoInput.value = civici[0] || '';
                            }
                            if (caps.length > 1) {
                                renderCapSelect(caps);
                            } else {
                                renderCapInput();
                                capInput.value = caps[0] || '';
                            }
                        } else {
                            renderCivicoInput();
                            civicoInput.value = '';
                            renderCapInput();
                            capInput.value = '';
                        }
                    });
            });
        }
    });
</script>

<style>
    .profile-form-label {
        color: #2a3990;
        font-weight: bold;
        font-size: 1.13em;
        margin-bottom: 4px;
        display: block;
        letter-spacing: 1px;
    }

    .profile-form-input {
        border: 2px solid #b3baff;
        border-radius: 7px;
        padding: 10px;
        font-size: 1.08em;
        width: 100%;
        margin-bottom: 8px;
        box-shadow: 0 1px 4px #e0e7ff;
        transition: border 0.2s, box-shadow 0.2s;
    }

    .profile-form-input:focus {
        border-color: #2a3990;
        box-shadow: 0 2px 8px #b3baff;
        outline: none;
    }

    .profile-form-btn {
        background: linear-gradient(90deg, #2a3990 60%, #ff9800 100%);
        color: #fff;
        padding: 12px 36px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 1.13em;
        font-weight: bold;
        box-shadow: 0 2px 8px #b3baff;
        transition: background 0.2s, box-shadow 0.2s, transform 0.1s;
        border: none;
        display: inline-block;
        margin-top: 10px;
        cursor: pointer;
        letter-spacing: 1px;
    }

    .profile-form-btn:hover {
        background: linear-gradient(90deg, #ff9800 0%, #2a3990 100%);
        box-shadow: 0 4px 16px #b3baff;
        transform: translateY(-2px) scale(1.03);
    }

    .profile-form-error {
        color: #ff9800;
        font-size: 0.98em;
        margin-bottom: 8px;
    }

    @media (max-width: 700px) {
        .indirizzo-row {
            flex-direction: column;
            gap: 0.5em;
        }
    }
</style>