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
        <div class="max-w-7xl pt-10 mx-auto px-8 space-y-6">

            <div
                class="bg-surface dark:bg-surface-dark overflow-hidden rounded-xl shadow-sm border border-bordercolor dark:border-bordercolor-dark">
                <div
                    class="p-8 border-b border-bordercolor dark:border-bordercolor-dark bg-background/60 dark:bg-background-dark/40 flex flex-col gap-6">

                    {{-- Title + description + organization --}}
                    <div class="flex flex-col gap-3 md:flex-row md:items-start md:justify-between">
                        <div>
                            <h1 class="text-3xl font-bold text-text-primary dark:text-text-primary-dark">
                                {{ $survey->title }}
                            </h1>
                            <p class="mt-2 text-lg text-text-secondary dark:text-text-secondary-dark">
                                {{ $survey->description }}
                            </p>
                        </div>

                        <span
                            class="inline-flex mt-1 md:mt-0 px-3 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200">
                            {{ $survey->organization->name ?? 'Organisation no exista ?? si si bueno' }}
                        </span>
                    </div>



                    {{-- Actions --}}
                    <div class="flex flex-wrap gap-3">

                        @can('createQuestion', $survey)
                            {{-- Edit survey --}}
                            <button
                                data-modal-target="modalUpdate"
                                data-modal-toggle="modalUpdate"
                                class="relative overflow-hidden inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium
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
                                <i class="fa-solid fa-pen-to-square mr-2 text-sm"></i>
                                Modifier le sondage
                            </button>

                            {{-- Add question --}}
                            <button
                                @click="openAddModal()"
                                class="relative overflow-hidden inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium
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
                                <i class="fa-solid fa-circle-plus mr-2 text-sm"></i>
                                Ajouter une question
                            </button>
                        @endcan

                        {{-- Do survey --}}
                        <button
                            @click="window.location='{{ route('survey.view.questions', $survey->id) }}'"
                            class="relative overflow-hidden inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium
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
                            <i class="fa-solid fa-play mr-2 text-sm"></i>
                            Faire le sondage
                        </button>

                        {{-- View stats --}}
                        <button
                            @click="window.location='{{ route('survey.view.results', $survey->id) }}'"
                            class="relative overflow-hidden inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium
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
                            <i class="fa-solid fa-chart-line mr-2 text-sm"></i>
                            Voir les statistiques
                        </button>

                        {{-- Copy link --}}
                        <button
                            x-data="{ copied: false }"
                            @click="
                                    navigator.clipboard.writeText('{{ $url }}');
                                    copied = true;
                                    setTimeout(() => copied = false, 2000);
                                    "
                            class="relative overflow-hidden inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium
                                   rounded-lg text-white shadow-md transition-transform duration-150
                                   bg-gradient-to-r from-primary to-accent dark:from-primary-dark dark:to-accent-dark
                                   hover:-translate-y-[1px]
                                   before:absolute before:inset-0 before:-z-10
                                   before:bg-primary-noise dark:before:bg-primary-noise-dark
                                   before:bg-[length:260%_260%] before:bg-center
                                   before:opacity-0 before:transition-opacity before:duration-200
                                   hover:before:opacity-100 hover:before:animate-gradient-noise
                                   focus:outline-none focus:ring-2 focus:ring-primary"
                            :class="copied ? 'from-primary to-accent' : ''"
                        >
                            <template x-if="!copied">
                                <div class="inline-flex items-center">
                                    <i class="fa-regular fa-copy mr-2 text-sm"></i>
                                    Copier le lien
                                </div>
                            </template>

                            <template x-if="copied">
                                <div class="inline-flex items-center">
                                    <i class="fa-solid fa-check mr-2 text-sm"></i>
                                    Lien copié !
                                </div>
                            </template>
                        </button>
                    </div>
                </div>
            </div>


            <div
                class="bg-surface dark:bg-surface-dark overflow-hidden rounded-xl shadow-sm border border-bordercolor dark:border-bordercolor-dark
                        p-8 border-b dark:bg-background-dark/40">
                <h2 class="text-xl font-semibold mb-6 text-gray-900 dark:text-white flex items-center justify-between">
                    <span>Questions de ce sondage :</span>
                    <span
                        class="ml-3 px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200">
                        {{ $survey->questions->count() }} Questions
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
