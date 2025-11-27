<x-guest-layout>
    {{-- Session status --}}
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" >
        @csrf

        {{-- Title --}}
        <div class="space-y-1 text-center mb-2">
            <h1 class="text-2xl font-bold text-text-primary tracking-tight">
                Se connecter
            </h1>
            <p class="text-sm text-text-secondary">
                Accédez à votre espace en entrant vos identifiants.
            </p>
        </div>

        {{-- Email --}}
        <div class="space-y-1">
            <x-input-label for="email" :value="__('Adresse mail')" class="text-sm font-medium text-text-primary" />

            <x-text-input
                id="email"
                class="block mt-1 w-full bg-background border border-bordercolor rounded-lg px-3 py-2.5 text-sm
                       text-text-primary placeholder:text-black/50
                       transition-all duration-150
                       hover:border-accent
                       focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary focus:-translate-y-[1px] focus:shadow-md"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                autocomplete="username"
                placeholder="exemple@domaine.com"
            />

            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs" />
        </div>

        {{-- Password --}}
        <div class="mt-2 space-y-1">
            <x-input-label for="password" :value="__('Mot de passe')" class="text-sm font-medium text-text-primary" />

            <x-text-input
                id="password"
                class="block mt-1 w-full bg-background border border-bordercolor rounded-lg px-3 py-2.5 text-sm
                       text-text-primary placeholder:text-black/50
                       transition-all duration-150
                       hover:border-accent
                       focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary focus:-translate-y-[1px] focus:shadow-md"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="Votre mot de passe"
            />

            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs" />
        </div>

        {{-- Remember me --}}
        <div class="block mt-2">
            <label for="remember_me" class="inline-flex items-center">
                <input
                    id="remember_me"
                    type="checkbox"
                    class="rounded border-bordercolor text-primary shadow-sm focus:ring-primary"
                    name="remember"
                >
                <span class="ms-2 text-sm text-text-secondary">
                    {{ __('Se souvenir de moi') }}
                </span>
            </label>
        </div>

        {{-- Links + submit --}}
        <div class="flex flex-col gap-3 items-stretch mt-4">

            @if (Route::has('password.request'))
                <a
                    class="text-sm text-text-secondary hover:text-text-primary underline underline-offset-2 transition"
                    href="{{ route('password.request') }}"
                >
                    {{ __('Mot de passe oublié ?') }}
                </a>
            @endif

            <a
                class="text-sm text-text-secondary hover:text-text-primary underline underline-offset-2 transition"
                href="{{ route('register') }}"
            >
                {{ __('Pas de compte ? Créer un compte') }}
            </a>

            <x-primary-button class="relative overflow-hidden inline-flex w-full justify-center px-4 py-2.5 text-sm font-medium
                                   rounded-lg text-white shadow-md transition-transform duration-150 sm:col-start-2
                                   bg-gradient-to-r from-primary to-accent dark:from-primary-dark dark:to-accent-dark
                                   hover:-translate-y-[1px]
                                   before:absolute before:inset-0 before:-z-10
                                   before:bg-primary-noise dark:before:bg-primary-noise-dark
                                   before:bg-[length:260%_260%] before:bg-center
                                   before:opacity-0 before:transition-opacity before:duration-200
                                   hover:before:opacity-100 hover:before:animate-gradient-noise
                                   focus:outline-none focus:ring-2 focus:ring-primary">
                {{ __('Se connecter') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
