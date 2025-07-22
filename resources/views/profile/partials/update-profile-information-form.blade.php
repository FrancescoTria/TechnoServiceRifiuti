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
                    <div>
                        <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                            {{ __('Your email address is unverified.') }}

                            <button form="send-verification"
                                class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
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
</style>