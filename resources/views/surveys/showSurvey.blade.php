<x-app-layout>
    <div x-data="{
        modalOpen: {{ old('form') === 'question' && $errors->any() ? 'true' : 'false' }},
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
                            @click="window.location='{{ route('survey.view.questions', $survey->hash_id) }}'"
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
        @can('view', $survey)
                        {{-- View stats --}}
                        <button
                            @click="window.location='{{ route('survey.view.results', $survey->hash_id) }}'"
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

                                    {{-- Edit question --}}
                                    <div class="ml-auto">
                                        <button
                                            @click="openEditModal({{ json_encode($question) }}, '{{ route('survey.question.update', $question->hash_id) }}')"
                                            class="p-2 rounded-lg
                                                   text-text-secondary dark:text-text-secondary-dark
                                                   transition-all duration-150
                                                   hover:text-primary dark:hover:text-primary-dark
                                                   hover:scale-110 hover:shadow-md"
                                            title="Modifier la question"
                                        >
                                            <i class="fa-solid fa-pen-to-square text-[15px]"></i>
                                        </button>
                                    </div>

                                    {{-- Delete question --}}
                                    <div class="ml-auto">
                                        <form
                                            action="{{ route('survey.question.destroy', $question->hash_id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Êtes-vous sûr ?');"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                type="submit"
                                                class="p-2 rounded-lg
                                                       text-text-secondary dark:text-text-secondary-dark
                                                       transition-all duration-150
                                                       hover:text-red-500 dark:hover:text-red-400
                                                        hover:scale-110 hover:shadow-md"
                                                title="Supprimer la question"
                                            >
                                                <i class="fa-solid fa-trash text-[15px]"></i>
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
