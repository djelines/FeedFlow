
<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-3xl font-extrabold text-gray-900">
            Créer un compte
        </h2>
        <p class="mt-2 text-sm text-gray-600">
            Rejoignez-nous en quelques secondes
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div>
                <x-input-label for="last_name" :value="__('Nom de famille')" />
                <x-text-input id="last_name"
                              class="block mt-1 w-full bg-gray-50 focus:bg-white transition duration-150 ease-in-out"
                              type="text"
                              name="last_name"
                              :value="old('last_name')"
                              required
                              autofocus
                              autocomplete="family-name"
                              placeholder="Dupont" />
                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="first_name" :value="__('Prénom')" />
                <x-text-input id="first_name"
                              class="block mt-1 w-full bg-gray-50 focus:bg-white transition duration-150 ease-in-out"
                              type="text"
                              name="first_name"
                              :value="old('first_name')"
                              required
                              autocomplete="given-name"
                              placeholder="Jean" />
                <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
            </div>
        </div>

        <div>
            <x-input-label for="email" :value="__('Adresse mail')" />
            <x-text-input id="email"
                          class="block mt-1 w-full bg-gray-50 focus:bg-white transition duration-150 ease-in-out"
                          type="email"
                          name="email"
                          :value="old('email')"
                          required
                          autocomplete="username"
                          placeholder="jean.dupont@exemple.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Mot de passe')" />
            <x-text-input id="password"
                          class="block mt-1 w-full bg-gray-50 focus:bg-white transition duration-150 ease-in-out"
                          type="password"
                          name="password"
                          required
                          autocomplete="new-password"
                          placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />
            <x-text-input id="password_confirmation"
                          class="block mt-1 w-full bg-gray-50 focus:bg-white transition duration-150 ease-in-out"
                          type="password"
                          name="password_confirmation"
                          required
                          autocomplete="new-password"
                          placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex flex-col-reverse items-center justify-between gap-4 pt-4 sm:flex-row">
            <a class="text-sm text-gray-600 hover:text-indigo-600 transition-colors duration-200 underline decoration-gray-300 underline-offset-4 hover:decoration-indigo-600"
               href="{{ route('login') }}">
                {{ __('Déja un compte ?') }}
            </a>

            <x-primary-button class="w-full sm:w-auto justify-center px-6 py-3">
                {{ __("S'inscrire") }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>


