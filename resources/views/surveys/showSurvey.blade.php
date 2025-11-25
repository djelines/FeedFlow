<x-app-layout>
    <div x-data="{ modalOpen: {{ $errors->any() ? 'true' : 'false' }} }" class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 dark:border-gray-700">
                <div
                    class="p-8 border-b border-gray-200 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50 flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $survey->title }}</h1>
                        <p class="mt-2 text-lg text-gray-500 dark:text-gray-400">{{ $survey->description }}</p>
                    </div>

                    <button @click="modalOpen = true"
                        class="inline-flex items-center px-5 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg shadow-md transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        Ajouter une question
                    </button>
                </div>
            </div>

            <div
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 dark:border-gray-700 p-8">
                <h2 class="text-xl font-semibold mb-6 text-gray-900 dark:text-white flex items-center">
                    Questions existantes
                    <span
                        class="ml-3 px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200">
                        {{ $survey->questions->count() }}
                    </span>
                </h2>

                <div class="space-y-4">
                    @forelse ($survey->questions as $index => $question)
                        <div
                            class="flex items-start gap-4 p-4 rounded-lg border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/30 group">

                            <div
                                class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-full bg-indigo-100 dark:bg-indigo-900 text-indigo-600 dark:text-indigo-300 font-bold text-sm">
                                {{ $index + 1 }}
                            </div>

                            <div class="flex-1">
                                <h3 class="font-medium text-gray-900 dark:text-white">{{ $question->title }}</h3>
                                <span class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    {{ ucfirst(str_replace('_', ' ', $question->question_type)) }}
                                </span>
                                @if($question->options)
                                    <p class="text-xs text-gray-400 mt-1">
                                        Options:
                                        {{ is_array($question->options) ? implode(', ', $question->options) : $question->options }}
                                    </p>
                                @endif
                            </div>
                            <div class="flex flex-col">
                                <div class="ml-auto">
                                    <form action="{{ route('survey.question.destroy', $question) }}" method="POST">
                                        @csrf
                                        @method('UPDATE')

                                        <button type="submit"
                                            class="p-2 text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200 rounded-full hover:bg-blue-50 dark:hover:bg-blue-900/20"
                                            title="Supprimer la question">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                                <path
                                                    d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                                <div class="ml-auto">
                                    <form action="{{ route('survey.question.destroy', $question) }}" method="POST"
                                        onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette question ?');">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="p-2 text-gray-400 hover:text-red-600 dark:hover:text-red-400 transition-colors duration-200 rounded-full hover:bg-red-50 dark:hover:bg-red-900/20"
                                            title="Supprimer la question">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                            Aucune question pour le moment. Cliquez sur "Ajouter une question" pour commencer.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div x-show="modalOpen" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto"
            aria-labelledby="modal-title" role="dialog" aria-modal="true">

            <div x-show="modalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-gray-900 bg-opacity-75 backdrop-blur-sm transition-opacity"
                @click="modalOpen = false"></div>

            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <div x-show="modalOpen" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="relative transform overflow-hidden rounded-xl bg-white dark:bg-gray-800 text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-gray-200 dark:border-gray-700">

                    <div
                        class="bg-gray-50 dark:bg-gray-700/50 px-4 py-3 sm:px-6 border-b border-gray-200 dark:border-gray-600 flex justify-between items-center">
                        <h3 class="text-lg font-semibold leading-6 text-gray-900 dark:text-white" id="modal-title">
                            Nouvelle Question
                        </h3>
                        <button @click="modalOpen = false" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                            <span class="sr-only">Fermer</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
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

                        <div x-data="{ 
                                type: '{{ old('question_type', 'text') }}', 
                                options: {{ old('options') ? json_encode(old('options')) : '[\'\', \'\']' }},
                                addOption() { this.options.push(''); },
                                removeOption(index) { this.options.splice(index, 1); }
                            }">

                            <form method="POST" action="{{ route('survey.question.store') }}" class="space-y-5">
                                @csrf
                                <input type="hidden" name="survey_id" value="{{ $survey->id }}">

                                <div>
                                    <label
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Intitulé
                                        de la question</label>
                                    <input type="text" name="title" value="{{ old('title') }}" required
                                        class="block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white sm:text-sm"
                                        placeholder="Ex: Quel est votre avis ?">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Type
                                        de réponse</label>
                                    <select name="question_type" x-model="type"
                                        class="block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white sm:text-sm">
                                        <option value="text">Texte libre</option>
                                        <option value="multiple_choice">Choix multiple (Unique)</option>
                                        <option value="checkbox">Cases à cocher (Multiple)</option>
                                        <option value="range">Échelle (Range)</option>
                                    </select>
                                </div>

                                <div x-show="type === 'multiple_choice' || type === 'checkbox'" style="display: none;"
                                    class="space-y-3">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Options de
                                        réponse</label>
                                    <div
                                        class="bg-gray-50 dark:bg-gray-700/50 p-3 rounded-md border border-gray-200 dark:border-gray-600 max-h-48 overflow-y-auto">
                                        <template x-for="(option, index) in options" :key="index">
                                            <div class="flex items-center gap-2 mb-2">
                                                <input type="text" name="options[]" x-model="options[index]"
                                                    :disabled="type === 'text' || type === 'range'" required
                                                    class="block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white sm:text-xs py-1.5"
                                                    placeholder="Option...">
                                                <button type="button" @click="removeOption(index)"
                                                    class="text-gray-400 hover:text-red-500">
                                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </template>
                                        <button type="button" @click="addOption()"
                                            class="mt-1 text-xs font-medium text-indigo-600 hover:text-indigo-500 flex items-center">
                                            <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                            Ajouter une option
                                        </button>
                                    </div>
                                </div>

                                <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                                    <button type="submit"
                                        class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:col-start-2">
                                        Sauvegarder
                                    </button>
                                    <button type="button" @click="modalOpen = false"
                                        class="mt-3 inline-flex w-full justify-center rounded-md bg-white dark:bg-gray-700 px-3 py-2 text-sm font-semibold text-gray-900 dark:text-gray-200 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600 sm:col-start-1 sm:mt-0">
                                        Annuler
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>