<div id="create-survey-modal" tabindex="-1" aria-hidden="true"
     class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto bg-black/50">

    {{-- Modal wrapper --}}
    <div class="relative w-full max-w-3xl">

        {{-- Modal panel --}}
        <div
            class="relative transform overflow-hidden rounded-2xl bg-surface dark:bg-surface-dark text-left shadow-2xl
                   transition-all border border-bordercolor dark:border-bordercolor-dark"
        >

            {{-- Modal header --}}
            <div class="bg-background/70 dark:bg-background-dark/60 px-4 py-3 sm:px-6 border-b border-bordercolor dark:border-bordercolor-dark flex justify-between items-center">
                <h2 class="text-lg sm:text-xl font-semibold leading-6 text-text-primary dark:text-text-primary-dark">
                    Créer un Nouveau Sondage
                </h2>

                {{-- Close icon button --}}
                <button
                    type="button"
                    data-modal-hide="create-survey-modal"
                    class="inline-flex items-center justify-center w-8 h-8 rounded-full
                           text-text-secondary dark:text-text-secondary-dark
                           hover:text-primary dark:hover:text-primary-dark
                           hover:bg-primary-soft/60 dark:hover:bg-primary-soft-dark/60
                           transition"
                >
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>

            {{-- Modal body --}}
            <div class="px-4 py-4 sm:p-6">

                {{-- Create survey form --}}
                <form method="POST" action="{{ route('survey.store') }}">
                    @csrf

                    {{-- Title field --}}
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
                                   transition-all duration-150 hover:border-accent dark:hover:border-accent-dark
                                   focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary
                                   focus:-translate-y-[1px] focus:shadow-md placeholder:text-black/40 dark:placeholder:text-white/40"
                        />
                        @error('title')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Description field --}}
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
                                   transition-all duration-150 hover:border-accent dark:hover:border-accent-dark
                                   focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary
                                   focus:-translate-y-[1px] focus:shadow-md placeholder:text-black/40 dark:placeholder:text-white/40"
                        >{{ old('description') }}</textarea>
                        @error('description')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Anonymous toggle --}}
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
                                   focus:ring-2 focus:ring-primary focus:outline-none transition-transform duration-150 hover:scale-105"
                        />
                        <label for="is_anonymous_checkbox" class="ms-2 text-sm font-medium text-text-primary dark:text-text-primary-dark">
                            Autoriser les Anonymes
                        </label>
                    </div>

                    {{-- AI helper section (toggle + fields) --}}
                    <div x-data="{ aiEnabled: {{ old('isAi') == '1' ? 'true' : 'false' }} }">

                        {{-- AI toggle --}}
                        <div class="mb-6 flex items-center">
                            <input type="hidden" name="isAi" value="0">

                            <input
                                id="isAi"
                                type="checkbox"
                                name="isAi"
                                value="1"
                                x-model="aiEnabled"
                                @change="if(!aiEnabled) { $refs.prompt.value = ''; $refs.number.value = ''; }"
                                class="w-4 h-4 text-primary bg-background dark:bg-background-dark
                                       border border-bordercolor dark:border-bordercolor-dark rounded
                                       focus:ring-2 focus:ring-primary focus:outline-none transition-transform duration-150 hover:scale-105"
                            />
                            <label for="isAi" class="ms-2 text-sm font-medium text-text-primary dark:text-text-primary-dark">
                                Création des questions avec l'assistant AI
                            </label>
                        </div>

                        {{-- AI fields --}}
                        <div
                            x-show="aiEnabled"
                            x-transition.opacity
                            class="mb-6 grid gap-4 sm:grid-cols-2 p-4 rounded-lg border border-bordercolor dark:border-bordercolor-dark bg-background/60 dark:bg-background-dark/40"
                            style="display: none;"
                        >
                            {{-- AI question count --}}
                            <div>
                                <label for="ai_count" class="block mb-2 text-sm font-medium text-text-primary dark:text-text-primary-dark">
                                    Nombre de questions
                                </label>
                                <input
                                    x-ref="number"
                                    type="number"
                                    name="ai_question_count"
                                    id="ai_count"
                                    value="{{ old('ai_question_count') }}"
                                    placeholder="Ex: 5"
                                    min="1"
                                    class="bg-background dark:bg-background-dark border border-bordercolor dark:border-bordercolor-dark
                                           text-text-primary dark:text-text-primary-dark text-sm rounded-lg block w-full px-3 py-2.5
                                           transition-all duration-150 hover:border-accent dark:hover:border-accent-dark
                                           focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary
                                           focus:-translate-y-[1px] focus:shadow-md placeholder:text-black/40 dark:placeholder:text-white/40"
                                >
                                @error('ai_question_count')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- AI prompt --}}
                            <div class="sm:col-span-2">
                                <label for="ai_prompt" class="block mb-2 text-sm font-medium text-text-primary dark:text-text-primary-dark">
                                    Instructions pour l'IA (Prompt)
                                </label>
                                <textarea
                                    x-ref="prompt"
                                    name="ai_prompt"
                                    id="ai_prompt"
                                    rows="3"
                                    placeholder="Ex: Génère des questions sur l'anatomie rénale..."
                                    class="bg-background dark:bg-background-dark border border-bordercolor dark:border-bordercolor-dark
                                           text-text-primary dark:text-text-primary-dark text-sm rounded-lg block w-full px-3 py-2.5 resize-none
                                           transition-all duration-150 hover:border-accent dark:hover:border-accent-dark
                                           focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary
                                           focus:-translate-y-[1px] focus:shadow-md placeholder:text-black/40 dark:placeholder:text-white/40"
                                >{{ old('ai_prompt') }}</textarea>

                                @error('ai_prompt')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                    </div>

                    {{-- Dates grid --}}
                    <div class="grid md:grid-cols-2 md:gap-6 mb-6">
                        {{-- Start date --}}
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

                        {{-- End date --}}
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

                    {{-- Hidden organization id --}}
                    <input type="hidden" name="organization_id" value="{{ $organization->id}}">

                    {{-- Actions: submit + cancel --}}
                    <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                        {{-- Submit button --}}
                        <button
                            type="submit"
                            class="relative overflow-hidden inline-flex w-full justify-center px-4 py-2.5 text-sm font-medium
                                   rounded-lg text-white shadow-md transition-transform duration-150 sm:col-start-2
                                   bg-gradient-to-r from-primary to-accent dark:from-primary-dark dark:to-accent-dark
                                   hover:-translate-y-[1px]
                                   before:absolute before:inset-0 before:-z-10
                                   before:bg-primary-noise dark:before:bg-primary-noise-dark
                                   before:bg-[length:260%_260%] before:bg-center
                                   before:opacity-0 before:transition-opacity before:duration-200
                                   hover:before:opacity-100 hover:before:animate-gradient-noise
                                   focus:outline-none focus:ring-2 focus:ring-primary"
                        >
                            Confirmer votre sondage
                        </button>

                        {{-- Cancel button --}}
                        <button
                            type="button"
                            data-modal-hide="create-survey-modal"
                            class="mt-3 inline-flex w-full justify-center rounded-lg bg-surface dark:bg-surface-dark px-4 py-2.5 text-sm font-medium
                                   text-text-primary dark:text-text-primary-dark shadow-sm border border-bordercolor/80 dark:border-bordercolor-dark/80
                                   transition-all duration-150 sm:col-start-1 sm:mt-0
                                   hover:bg-primary-soft dark:hover:bg-primary-soft-dark
                                   hover:text-text-primary dark:hover:text-text-primary-dark
                                   focus:outline-none focus:ring-2 focus:ring-primary"
                        >
                            Annuler
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
