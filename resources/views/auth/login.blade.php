<x-guest-layout>
    <div
        style="display: flex; gap: 40px; justify-content: center; align-items: flex-start; flex-wrap: wrap; position:relative;">
        <!-- Login Cittadini -->
        <div style="flex:1; min-width:320px; max-width:400px;">
            <h2 style="text-align:center; color:#829B22; font-size:1.3em; margin-bottom:18px;">Accesso cittadini</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                        required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox"
                            class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                            name="remember">
                        <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                    </label>
                </div>
                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="link-nice" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                    <x-primary-button class="ms-3">{{ __('Log in') }}</x-primary-button>
                </div>
            </form>
        </div>
        <!-- Divisore verticale -->
        <div
            style="width:6px; background:#829B22; min-height:420px; align-self:stretch; border-radius:8px; margin:0 18px; display:block; box-shadow:0 0 12px #c6e27b;">
        </div>
        <!-- Login Lavoratori -->
        <div style="flex:1; min-width:320px; max-width:400px;">
            <h2 style="text-align:center; color:#829B22; font-size:1.3em; margin-bottom:18px;">Accesso lavoratori</h2>
            <form method="POST" action="{{ route('login.lavoratori') }}">
                @csrf
                <!-- Email Address -->
                <div>
                    <x-input-label for="email_lav" :value="__('Email')" />
                    <x-text-input id="email_lav" class="block mt-1 w-full" type="email" name="email" required autofocus
                        autocomplete="username" />
                </div>
                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password_lav" :value="__('Password')" />
                    <x-text-input id="password_lav" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="current-password" />
                </div>
                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me_lav" class="inline-flex items-center">
                        <input id="remember_me_lav" type="checkbox"
                            class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                            name="remember">
                        <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                    </label>
                </div>
                <div class="flex items-center justify-end mt-4">
                    <a class="link-nice" href="#"
                        onclick="alert('Contatta l\'amministratore per il reset della password lavoratore.'); return false;">{{ __('Forgot your password?') }}</a>
                    <x-primary-button class="ms-3">{{ __('Log in') }}</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>