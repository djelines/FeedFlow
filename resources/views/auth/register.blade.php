<x-guest-layout>
    {{-- Title --}}
    <div class="mb-6 text-center space-y-1">
        <h2 class="text-2xl font-bold text-text-primary tracking-tight">
            Créer un compte
        </h2>
        <p class="text-sm text-text-secondary">
            Rejoignez-nous en quelques secondes.
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        {{-- Names --}}
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div class="space-y-1">
                <x-input-label for="last_name" :value="__('Nom de famille')" class="text-sm font-medium text-text-primary" />
                <x-text-input
                    id="last_name"
                    class="block mt-1 w-full bg-background border border-bordercolor rounded-lg px-3 py-2.5 text-sm
                           text-text-primary placeholder:text-black/50
                           transition-all duration-150
                           hover:border-accent
                           focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary
                           focus:-translate-y-[1px] focus:shadow-md"
                    type="text"
                    name="last_name"
                    :value="old('last_name')"
                    required
                    autofocus
                    autocomplete="family-name"
                    placeholder="Dupont"
                />
                <x-input-error :messages="$errors->get('last_name')" class="mt-2 text-xs" />
            </div>

            <div class="space-y-1">
                <x-input-label for="first_name" :value="__('Prénom')" class="text-sm font-medium text-text-primary" />
                <x-text-input
                    id="first_name"
                    class="block mt-1 w-full bg-background border border-bordercolor rounded-lg px-3 py-2.5 text-sm
                           text-text-primary placeholder:text-black/50
                           transition-all duration-150
                           hover:border-accent
                           focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary
                           focus:-translate-y-[1px] focus:shadow-md"
                    type="text"
                    name="first_name"
                    :value="old('first_name')"
                    required
                    autocomplete="given-name"
                    placeholder="Jean"
                />
                <x-input-error :messages="$errors->get('first_name')" class="mt-2 text-xs" />
            </div>
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
                       focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary
                       focus:-translate-y-[1px] focus:shadow-md"
                type="email"
                name="email"
                :value="old('email')"
                required
                autocomplete="username"
                placeholder="jean.dupont@exemple.com"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs" />
        </div>

        {{-- Password --}}
        <div class="space-y-1">
            <x-input-label for="password" :value="__('Mot de passe')" class="text-sm font-medium text-text-primary" />
            <x-text-input
                id="password"
                class="block mt-1 w-full bg-background border border-bordercolor rounded-lg px-3 py-2.5 text-sm
                       text-text-primary placeholder:text-black/50
                       transition-all duration-150
                       hover:border-accent
                       focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary
                       focus:-translate-y-[1px] focus:shadow-md"
                type="password"
                name="password"
                required
                autocomplete="new-password"
                placeholder="••••••••"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs" />
        </div>

        {{-- Password confirmation --}}
        <div class="space-y-1">
            <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" class="text-sm font-medium text-text-primary" />
            <x-text-input
                id="password_confirmation"
                class="block mt-1 w-full bg-background border border-bordercolor rounded-lg px-3 py-2.5 text-sm
                       text-text-primary placeholder:text-black/50
                       transition-all duration-150
                       hover:border-accent
                       focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary
                       focus:-translate-y-[1px] focus:shadow-md"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
                placeholder="••••••••"
            />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs" />
        </div>

        {{-- Links + submit --}}
        <div class="flex flex-col-reverse items-center justify-between gap-4 pt-4 sm:flex-row">
            <a
                class="text-sm text-text-secondary hover:text-text-primary underline underline-offset-2 transition"
                href="{{ route('login') }}"
            >
                {{ __('Déjà un compte ?') }}
            </a>

            <x-primary-button
                class="relative overflow-hidden inline-flex w-full sm:w-auto justify-center px-6 py-2.5 text-sm font-medium
                       rounded-lg text-white shadow-md transition-transform duration-150
                       bg-gradient-to-r from-primary to-accent dark:from-primary-dark dark:to-accent-dark
                       hover:-translate-y-[1px]
                       before:absolute before:inset-0 before:-z-10
                       before:bg-primary-noise dark:before:bg-primary-noise-dark
                       before:bg-[length:260%_260%] before:bg-center
                       before:opacity-0 before:transition-opacity before:duration-200
                       hover:before:opacity-100 hover:before:animate-gradient-noise
                       focus:outline-none focus:ring-2 focus:ring-primary"
            >
                {{ __("S'inscrire") }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
