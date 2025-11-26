<div x-show="modalOpen" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">

    <div
        x-show="modalOpen"
        x-transition.opacity
        class="fixed inset-0 bg-background-dark/80 backdrop-blur-sm"
        @click="modalOpen = false"
    ></div>

    <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
        <div
            x-show="modalOpen"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            class="relative transform overflow-hidden rounded-2xl bg-surface dark:bg-surface-dark text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-bordercolor dark:border-bordercolor-dark"
        >

            {{-- Header --}}
            <div class="bg-background/70 dark:bg-background-dark/60 px-4 py-3 sm:px-6 border-b border-bordercolor dark:border-bordercolor-dark flex justify-between items-center">
                <h3 class="text-lg font-semibold leading-6 text-text-primary dark:text-text-primary-dark" id="modal-title">
                    <span x-text="isEditMode ? 'Modifier la question' : 'Nouvelle Question'"></span>
                </h3>
                <button
                    @click="modalOpen = false"
                    class="inline-flex items-center justify-center w-8 h-8 rounded-full text-text-secondary dark:text-text-secondary-dark hover:text-primary dark:hover:text-primary-dark hover:bg-primary-soft/60 dark:hover:bg-primary-soft-dark/60 transition"
                >
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>

            {{-- Body --}}
            <div class="px-4 sm:p-6">
                @if ($errors->any())
                    <div class="mb-4 bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500 p-4 rounded-md">
                        <ul class="text-sm text-red-700 dark:text-red-300 list-disc list-inside">
                            @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" :action="formAction" class="">
                    @csrf
                    <input type="hidden" name="_method" :value="formMethod">
                    <input type="hidden" name="survey_id" value="{{ $survey->id }}">

                    {{-- Title --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-text-primary dark:text-text-primary-dark mb-1">
                            Intitulé de la question
                        </label>
                        <input
                            type="text"
                            name="title"
                            x-model="title"
                            required
                            class="block w-full rounded-lg bg-background dark:bg-background-dark border border-bordercolor dark:border-bordercolor-dark
                                   text-text-primary dark:text-text-primary-dark text-sm px-3 py-2.5
                                   transition-all duration-150
                                   hover:border-accent dark:hover:border-accent-dark
                                   focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary
                                   focus:-translate-y-[1px] focus:shadow-md"
                        >
                    </div>

                    {{-- Type --}}
                    <div>
                        <label class="block text-sm font-medium text-text-primary dark:text-text-primary-dark mb-1">
                            Type de réponse
                        </label>
                        <select
                            name="question_type"
                            x-model="type"
                            class="block w-full rounded-lg bg-background dark:bg-background-dark border border-bordercolor dark:border-bordercolor-dark
                                   text-text-primary dark:text-text-primary-dark text-sm px-3 py-2.5
                                   transition-all duration-150
                                   hover:border-accent dark:hover:border-accent-dark
                                   focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary
                                   focus:-translate-y-[1px] focus:shadow-md"
                        >
                            <option value="text">Texte libre</option>
                            <option value="single_choice">Choix multiple (Unique)</option>
                            <option value="multiple_choice">Cases à cocher (Multiple)</option>
                            <option value="range">Échelle (Range)</option>
                        </select>
                    </div>

                    {{-- Options --}}
                    <div
                        x-show="type === 'multiple_choice' || type === 'single_choice'"
                        style="display: none;"
                        class="space-y-3"
                    >
                        <label class="block text-sm font-medium text-text-primary dark:text-text-primary-dark">
                            Options de réponse
                        </label>
                        <div class="bg-background/60 dark:bg-background-dark/40 p-3 rounded-lg border border-bordercolor dark:border-bordercolor-dark max-h-48 overflow-y-auto">
                            <template x-for="(option, index) in options" :key="index">
                                <div class="flex items-center gap-2 mb-2">
                                    <input
                                        type="text"
                                        name="options[]"
                                        x-model="options[index]"
                                        :disabled="type === 'text' || type === 'range'"
                                        required
                                        class="block w-full rounded-md bg-background dark:bg-background-dark border border-bordercolor dark:border-bordercolor-dark
                                               text-text-primary dark:text-text-primary-dark text-xs px-2 py-1.5
                                               transition-all duration-150
                                               hover:border-accent dark:hover:border-accent-dark
                                               focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary"
                                        placeholder="Option..."
                                    >

                                    <button
                                        type="button"
                                        @click="removeOption(index)"
                                        class="inline-flex items-center justify-center w-7 h-7 rounded-full text-text-secondary dark:text-text-secondary-dark hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition"
                                    >
                                    </button>
                                </div>
                            </template>

                            <button
                                type="button"
                                @click="addOption()"
                                class="mt-1 inline-flex items-center text-xs font-medium text-primary dark:text-primary-dark hover:text-accent dark:hover:text-accent-dark transition"
                            >
                                <i class="fa-solid fa-plus pr-2"></i>
                                Ajouter une option
                            </button>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                        {{-- Submit --}}
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
                            <span x-text="isEditMode ? 'Mettre à jour' : 'Sauvegarder'"></span>
                        </button>

                        {{-- Cancel --}}
                        <button
                            type="button"
                            @click="modalOpen = false"
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
