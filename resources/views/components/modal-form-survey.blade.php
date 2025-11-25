<div class="bg-white shadow-lg border-t-4 border-green-500 rounded-lg p-6 mb-8">

    <form method="POST" action="{{ route('survey.store') }}">
        @csrf

        <h2 class="text-2xl font-bold text-gray-800 mb-6">Créer un Nouveau Sondage</h2>

        <div class="mb-4">
            <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Titre du sondage</label>
            <input type="text" id="title"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                name="title" value="{{ old('title') }}" placeholder="Ex : Sondage sur la satisfaction des employés"
                required />
            @error('title')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
            <textarea id="description" rows="4"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="Décrivez brièvement le but de votre sondage..." name="description"
                required>{{ old('description') }}</textarea>
            @error('description')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6 flex items-center">
            <input type="hidden" name="is_anonymous" value="0">
            <input id="is_anonymous_checkbox" type="checkbox" name="is_anonymous" value="1" {{ old('is_anonymous') == '1' ? 'checked' : '' }}
                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500" />
            <label for="is_anonymous_checkbox" class="ms-2 text-sm font-medium text-gray-900">Rendre ce sondage
                **Anonyme**</label>
        </div>

        <div class="grid md:grid-cols-2 md:gap-6 mb-6">
            <div>
                <label for="start_date" class="block mb-2 text-sm font-medium text-gray-900">Date de début</label>
                <input type="datetime-local" id="start_date" name="start_date"
                    value="{{ old('start_date') ?? Carbon\Carbon::now()->format('Y-m-d\TH:i') }}"
                    min="{{ Carbon\Carbon::now()->format('Y-m-d\TH:i') }}"
                    max="{{ Carbon\Carbon::now()->addYears(1)->format('Y-m-d\TH:i') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    required />
                @error('start_date')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="end_date" class="block mb-2 text-sm font-medium text-gray-900">Date de fin</label>
                <input type="datetime-local" id="end_date" name="end_date"
                    value="{{ old('end_date') ?? Carbon\Carbon::now()->addDay()->format('Y-m-d\TH:i') }}"
                    min="{{ Carbon\Carbon::now()->format('Y-m-d\TH:i') }}"
                    max="{{ Carbon\Carbon::now()->addYears(1)->format('Y-m-d\TH:i') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    required />
                @error('end_date')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <input type="hidden" name="organization_id" value="{{ $organization->id}}">

        <button type="submit"
            class="w-full text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            Confirmer votre sondage
        </button>
    </form>
</div>