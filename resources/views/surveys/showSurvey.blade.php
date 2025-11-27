<x-app-layout>
    <div x-data="{
        modalOpen: {{ $errors->any() ? 'true' : 'false' }},
        isEditMode: false,
        questionId: null,
        formAction: '{{ route('survey.question.store') }}',
        formMethod: 'POST',

        title: '{{ old('title') }}',
        type: '{{ old('question_type', 'text') }}',
        options: {{ old('options') ? json_encode(old('options')) : '[\'\', \'\']' }},

        openAddModal() {
            this.isEditMode = false;
            this.formAction = '{{ route('survey.question.store') }}';
            this.formMethod = 'POST';
            this.resetForm();
            this.modalOpen = true;
        },

        openEditModal(question, updateUrl) {
            this.isEditMode = true;
            this.formAction = updateUrl;
            this.formMethod = 'PUT';

            this.questionId = question.id;
            this.title = question.title;
            this.type = question.question_type;
            this.options = question.options ? question.options : ['', ''];
            this.modalOpen = true;
        },

        resetForm() {
            this.title = '';
            this.type = 'text';
            this.options = ['', ''];
            this.questionId = null;
        },

        // Gestion des options dynamiques (déplacé ici pour être accessible partout)
        addOption() { this.options.push(''); },
        removeOption(index) { this.options.splice(index, 1); }
    }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 dark:border-gray-700">
                <div
                    class="p-8 border-b border-gray-200 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $survey->title }}</h1>
                        <p class="mt-2 text-lg text-gray-500 dark:text-gray-400">{{ $survey->description }}</p>
                    </div>
                    <div class="flex flex-col space-y-2">
                        @can('createQuestion', $survey)
                            <button data-modal-target="modalUpdate" data-modal-toggle="modalUpdate"
                                class="inline-flex items-center px-5 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg shadow-md transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                                Modifier le sondage
                            </button>

                            <button @click="openAddModal()"
                                class="inline-flex items-center px-5 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg shadow-md transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                                Ajouter une question
                            </button>

                        @endcan
                        <button @click="window.location='{{ route('survey.view.questions', $survey->id) }}'"
                            class="inline-flex items-center px-5 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg shadow-md transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4"></path>
                            </svg>
                            Faire le sondage
                        </button>

                        <button @click="window.location='{{ route('survey.view.results', $survey->id) }}'"
                            class="inline-flex items-center px-5 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg shadow-md transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4"></path>
                            </svg>
                            Voir les statistiques
                        </button>

                        @can('view', $survey)
                                <button x-data="{ copied: false }" @click="
                            navigator.clipboard.writeText('{{ $url }}');
                            copied = true;
                            setTimeout(() => copied = false, 2000);
                        " :class="copied ? 'bg-green-600 hover:bg-green-700' : 'bg-indigo-600 hover:bg-indigo-700'"
                                        class="inline-flex items-center px-5 py-3 text-white font-medium rounded-lg shadow-md transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">

                                    <template x-if="!copied">
                                        <div class="inline-flex items-center">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            Copier le lien
                                        </div>
                                    </template>

                                    <template x-if="copied">
                                        <div class="inline-flex items-center">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Lien copié !
                                        </div>
                                    </template>
                                </button>
                        @endcan
                    </div>

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
                            @can('createQuestion', $survey)
                                <div class="flex flex-col gap-2">

                                    <div class="ml-auto">
                                        <button
                                            @click="openEditModal({{ json_encode($question) }}, '{{ route('survey.question.update', $question) }}')"
                                            class="p-2 text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200 rounded-full hover:bg-blue-50 dark:hover:bg-blue-900/20"
                                            title="Modifier la question">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                                <path
                                                    d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="ml-auto">
                                        <form action="{{ route('survey.question.destroy', $question) }}" method="POST"
                                            onsubmit="return confirm('Êtes-vous sûr ?');">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-gray-400 hover:text-red-600 rounded-full hover:bg-red-50">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endcan
                        </div>
                    @empty
                        <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                            Aucune question pour le moment.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        @include('surveys.questionSurveyModal')
        @include('surveys.updateSurveyModal')

    </div>
</x-app-layout>
