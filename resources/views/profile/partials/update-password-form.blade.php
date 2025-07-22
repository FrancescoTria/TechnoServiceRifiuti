<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900" style="color:#829B22; font-size:1.3em; letter-spacing:1px;">
            Aggiorna password</h2>
        <p class="mt-1 text-sm" style="color:#555;">Assicurati di usare una password lunga e sicura.</p>
    </header>
    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')
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
        <div>
            <label for="update_password_current_password" class="profile-form-label">Password attuale</label>
            <input id="update_password_current_password" name="current_password" type="password"
                class="profile-form-input" autocomplete="current-password" />
            @if($errors->updatePassword->get('current_password'))
                <div class="profile-form-error">{{ $errors->updatePassword->first('current_password') }}</div>
            @endif
        </div>
        <div>
            <label for="update_password_password" class="profile-form-label">Nuova password</label>
            <input id="update_password_password" name="password" type="password" class="profile-form-input"
                autocomplete="new-password" />
            @if($errors->updatePassword->get('password'))
                <div class="profile-form-error">{{ $errors->updatePassword->first('password') }}</div>
            @endif
        </div>
        <div>
            <label for="update_password_password_confirmation" class="profile-form-label">Conferma password</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                class="profile-form-input" autocomplete="new-password" />
            @if($errors->updatePassword->get('password_confirmation'))
                <div class="profile-form-error">{{ $errors->updatePassword->first('password_confirmation') }}</div>
            @endif
        </div>
        <div class="flex items-center gap-4">
            <x-primary-button class="profile-btn" style="margin-top: 1rem;">Salva</x-primary-button>
            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">Salvata.</p>
            @endif
        </div>
    </form>
</section>