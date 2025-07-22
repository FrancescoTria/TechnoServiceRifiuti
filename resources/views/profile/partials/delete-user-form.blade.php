<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900" style="color:#829B22; font-size:1.3em; letter-spacing:1px;">
            Elimina account</h2>
        <p class="mt-1 text-sm" style="color:#555;">Una volta eliminato l'account, tutti i dati saranno persi. Conferma
            la tua password per procedere.</p>
    </header>
    <style>
        .profile-form-label {
            color: #829B22;
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
            border-color: #829B22;
            box-shadow: 0 2px 8px #829B22;
            outline: none;
        }

        .profile-form-btn {
            background: #829B22;
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
            background: #829B22;
            box-shadow: 0 4px 16px #b3baff;
            transform: translateY(-2px) scale(1.03);
        }

        .profile-form-error {
            color: #ff9800;
            font-size: 0.98em;
            margin-bottom: 8px;
        }
    </style>
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <div class="mt-6">
                <label for="password" class="profile-form-label">Password</label>
                <input id="password" name="password" type="password" class="profile-form-input"
                    placeholder="Password" />
                @if($errors->userDeletion->get('password'))
                    <div class="profile-form-error">{{ $errors->userDeletion->first('password') }}</div>
                @endif
            </div>
            <div class="mt-6 flex justify-end">

                <x-primary-button class="profile-btn" style="margin-top: 1.5rem;">Elimina account</x-primary-button>
            </div>
        </form>
    </x-modal>
</section>