<div class="bg-surface dark:bg-surface-soft-dark border border-t-4 border-accent dark:border-accent-dark rounded-2xl shadow-2xl p-6 mb-8">

    <form method="POST" action="{{ route('survey.store') }}">
        @csrf

        <h2 class="text-2xl font-semibold text-text-primary dark:text-text-primary-dark mb-6">
            Créer un Nouveau Sondage
        </h2>

        <div class="mb-4">
            <label for="title" class="block mb-2 text-sm font-medium text-text-primary dark:text-text-primary-dark">
                Titre du sondage
            </label>
            <input
                type="text"
                id="title"
                name="title"
                value="{{ old('title') }}"
                placeholder="Ex : Sondage sur la satisfaction des employés"
                required
                class="bg-background dark:bg-background-dark border border-bordercolor dark:border-bordercolor-dark
                       text-text-primary dark:text-text-primary-dark text-sm rounded-lg block w-full px-3 py-2.5
                       transition-all duration-150
                       hover:border-accent dark:hover:border-accent-dark
                       focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary
                       focus:-translate-y-[1px] focus:shadow-md
                       placeholder:text-black/50
                       dark:placeholder:text-white/50"
            />
            @error('title')
            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block mb-2 text-sm font-medium text-text-primary dark:text-text-primary-dark">
                Description
            </label>
            <textarea
                id="description"
                rows="4"
                name="description"
                required
                placeholder="Décrivez brièvement le but de votre sondage..."
                class="bg-background dark:bg-background-dark border border-bordercolor dark:border-bordercolor-dark
                       text-text-primary dark:text-text-primary-dark text-sm rounded-lg block w-full px-3 py-2.5 resize-none
                       transition-all duration-150
                       hover:border-accent dark:hover:border-accent-dark
                       focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary
                       focus:-translate-y-[1px] focus:shadow-md
                       placeholder:text-black/50
                       dark:placeholder:text-white/50"
            >{{ old('description') }}</textarea>
            @error('description')
            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6 flex items-center">
            <input type="hidden" name="is_anonymous" value="0">
            <input
                id="is_anonymous_checkbox"
                type="checkbox"
                name="is_anonymous"
                value="1"
                {{ old('is_anonymous') == '1' ? 'checked' : '' }}
                class="w-4 h-4 text-primary bg-background dark:bg-background-dark
                       border border-bordercolor dark:border-bordercolor-dark rounded
                       focus:ring-2 focus:ring-primary focus:outline-none
                       transition-transform duration-150 hover:scale-105"
            />
            <label for="is_anonymous_checkbox" class="ms-2 text-sm font-medium text-text-primary dark:text-text-primary-dark">
                Autoriser les Anonymes
            </label>
        </div>

        <div class="grid md:grid-cols-2 md:gap-6 mb-6">
            <div>
                <label for="start_date" class="block mb-2 text-sm font-medium text-text-primary dark:text-text-primary-dark">
                    Date de début
                </label>
                <input
                    type="datetime-local"
                    id="start_date"
                    name="start_date"
                    value="{{ old('start_date') ?? Carbon\Carbon::now()->format('Y-m-d\TH:i') }}"
                    min="{{ Carbon\Carbon::now()->format('Y-m-d\TH:i') }}"
                    max="{{ Carbon\Carbon::now()->addYears(1)->format('Y-m-d\TH:i') }}"
                    required
                    class="bg-background dark:bg-background-dark border border-bordercolor dark:border-bordercolor-dark
                           text-text-primary dark:text-text-primary-dark text-sm rounded-lg block w-full px-3 py-2.5
                           transition-all duration-150 cursor-pointer dark:datetime-icon-dark
                           hover:border-accent dark:hover:border-accent-dark
                           focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary
                           focus:-translate-y-[1px] focus:shadow-md"
                />

                @error('start_date')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="end_date" class="block mb-2 text-sm font-medium text-text-primary dark:text-text-primary-dark">
                    Date de fin
                </label>
                <input
                    type="datetime-local"
                    id="end_date"
                    name="end_date"
                    value="{{ old('end_date') ?? Carbon\Carbon::now()->addDay()->format('Y-m-d\TH:i') }}"
                    min="{{ Carbon\Carbon::now()->format('Y-m-d\TH:i') }}"
                    max="{{ Carbon\Carbon::now()->addYears(1)->format('Y-m-d\TH:i') }}"
                    required
                    class="bg-background dark:bg-background-dark border border-bordercolor dark:border-bordercolor-dark
                           text-text-primary dark:text-text-primary-dark text-sm rounded-lg block w-full px-3 py-2.5
                           transition-all duration-150 dark:datetime-icon-dark
                           hover:border-accent dark:hover:border-accent-dark
                           focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary
                           focus:-translate-y-[1px] focus:shadow-md"
                />
                @error('end_date')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <input type="hidden" name="organization_id" value="{{ $organization->id}}">

        <button
            type="submit"
            class="relative overflow-hidden inline-flex items-center justify-center w-full text-sm font-medium text-white rounded-lg px-5 py-2.5
                   shadow-md transition-transform duration-150
                   hover:-translate-y-[1px]
                   bg-gradient-to-r from-primary to-accent dark:from-primary-dark dark:to-accent-dark
                   before:absolute before:inset-0 before:-z-10
                   before:bg-primary-noise dark:before:bg-primary-noise-dark
                   before:bg-[length:260%_260%] before:bg-center
                   before:opacity-0 before:transition-opacity before:duration-200
                   hover:before:opacity-100 hover:before:animate-gradient-noise
                   focus:outline-none focus:ring-2 focus:ring-primary"
        >
            Confirmer votre sondage
        </button>
    </form>
</div>
