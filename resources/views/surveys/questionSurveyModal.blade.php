<div x-show="modalOpen" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">

    <div x-show="modalOpen" x-transition.opacity class="fixed inset-0 bg-gray-900 bg-opacity-75 backdrop-blur-sm" @click="modalOpen = false"></div>

    <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
        <div x-show="modalOpen" 
             x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
             class="relative transform overflow-hidden rounded-xl bg-white dark:bg-gray-800 text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-gray-200 dark:border-gray-700">

            <div class="bg-gray-50 dark:bg-gray-700/50 px-4 py-3 sm:px-6 border-b border-gray-200 dark:border-gray-600 flex justify-between items-center">
                <h3 class="text-lg font-semibold leading-6 text-gray-900 dark:text-white" id="modal-title">
                    <span x-text="isEditMode ? 'Modifier la question' : 'Nouvelle Question'"></span>
                </h3>
                <button @click="modalOpen = false" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>

            <div class="px-4 py-5 sm:p-6">
                @if ($errors->any())
                    <div class="mb-4 bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500 p-4">
                        <ul class="text-sm text-red-700 dark:text-red-300 list-disc list-inside">
                            @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" :action="formAction" class="space-y-5">
                    @csrf
                    
                    <input type="hidden" name="_method" :value="formMethod">
                    
                    <input type="hidden" name="survey_id" value="{{ $survey->id }}">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Intitulé de la question</label>
                        <input type="text" name="title" x-model="title" required class="block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white sm:text-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Type de réponse</label>
                        <select name="question_type" x-model="type" class="block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white sm:text-sm">
                            <option value="text">Texte libre</option>
                            <option value="single_choice">Choix multiple (Unique)</option>
                            <option value="multiple_choice">Cases à cocher (Multiple)</option>
                            <option value="range">Échelle (Range)</option>
                        </select>
                    </div>

                    <div x-show="type === 'multiple_choice' || type === 'single_choice'" style="display: none;" class="space-y-3">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Options de réponse</label>
                        <div class="bg-gray-50 dark:bg-gray-700/50 p-3 rounded-md border border-gray-200 dark:border-gray-600 max-h-48 overflow-y-auto">
                            <template x-for="(option, index) in options" :key="index">
                                <div class="flex items-center gap-2 mb-2">
                                    <input type="text" name="options[]" x-model="options[index]" :disabled="type === 'text' || type === 'range'" required class="block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white sm:text-xs py-1.5" placeholder="Option...">
                                    
                                    <button type="button" @click="removeOption(index)" class="text-gray-400 hover:text-red-500">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                </div>
                            </template>
                            <button type="button" @click="addOption()" class="mt-1 text-xs font-medium text-indigo-600 hover:text-indigo-500 flex items-center">
                                <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                                Ajouter une option
                            </button>
                        </div>
                    </div>

                    <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                        <button type="submit" class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 sm:col-start-2">
                            <span x-text="isEditMode ? 'Mettre à jour' : 'Sauvegarder'"></span>
                        </button>
                        <button type="button" @click="modalOpen = false" class="mt-3 inline-flex w-full justify-center rounded-md bg-white dark:bg-gray-700 px-3 py-2 text-sm font-semibold text-gray-900 dark:text-gray-200 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600 sm:col-start-1 sm:mt-0">
                            Annuler
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>