<x-app-layout>

    @php
        $initialState = [];

        foreach ($surveyQuestions as $question) {
            $key = 'q_' . $question->id;
            $oldVal = old('questions.' . $key);

            if ($question->question_type === 'checkbox' && !is_array($oldVal)) {
                $oldVal = [];
            }

            $initialState[$key] = [
                'question_id' => $question->id,
                'survey_id'   => $question->survey_id,
                'type'        => $question->question_type,
                'response'    => $oldVal
            ];
        }
    @endphp

    <div
        x-data="{
            questions: @js($initialState),

            // Met à jour une réponse texte ou radio
            updateResponse(key, value) {
                this.questions[key].response = value;
            },

            // Met à jour une réponse checkbox (tableau)
            updateCheckbox(key, value, checked) {
                // S'assure que c'est un tableau
                if (!Array.isArray(this.questions[key].response)) {
                    this.questions[key].response = [];
                }

                let list = this.questions[key].response;
                if (checked) {
                    if (!list.includes(value)) list.push(value);
                } else {
                    list = list.filter(item => item !== value);
                }
                this.questions[key].response = list;
            }
        }"
        class="max-w-4xl mx-auto py-10 px-6 space-y-6"
    >

        {{-- Header / titre --}}
        <div class="bg-surface dark:bg-surface-dark rounded-xl shadow-sm border border-bordercolor dark:border-bordercolor-dark p-6">
            <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">

                <div class="flex-1 space-y-2">
                    <div class="flex items-center gap-3">
                        <div class="inline-flex h-9 w-9 items-center justify-center rounded-xl bg-primary-soft dark:bg-primary-soft-dark text-primary">
                            <i class="fa-solid fa-clipboard-list text-sm"></i>
                        </div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-text-secondary dark:text-text-secondary-dark">
                            Répondre au sondage !
                        </p>
                    </div>

                    {{-- Titre --}}
                    <h1 class="text-2xl font-bold text-text-primary dark:text-text-primary-dark tracking-tight">
                        {{ isset($survey) ? $survey->title : 'Répondre au sondage' }}
                    </h1>

                    {{-- Description --}}
                    @if(isset($survey) && !empty($survey->description))
                        <p class="text-sm text-text-secondary dark:text-text-secondary-dark leading-relaxed">
                            Description : {{ $survey->description }}
                        </p>
                    @endif
                </div>

                {{-- Badge organisation --}}
                @if(isset($organization))
                    <div class="flex items-start">
                        <span
                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold
                                   bg-background dark:bg-background-dark
                                   text-text-secondary dark:text-text-secondary-dark
                                   border border-bordercolor/70 dark:border-bordercolor-dark/70"
                        >
                            <i class="fa-solid fa-sitemap text-[11px] text-primary"></i>
                            <span class="uppercase tracking-wide">Organisation :</span>
                            <span class="font-medium text-text-primary dark:text-text-primary-dark">
                                {{ $organization->name }}
                            </span>
                        </span>
                    </div>
                @endif
            </div>

            @if (isset($errors) && count($errors))
                <div class="mt-4 bg-red-50 dark:bg-red-900/20 border border-red-300 dark:border-red-500/60 text-red-700 dark:text-red-200 px-4 py-3 rounded-lg text-sm flex items-start gap-2">
                    <i class="fa-solid fa-circle-exclamation mt-[2px] text-xs"></i>
                    <div>
                        <p class="font-semibold">Il y a des erreurs dans le formulaire.</p>
                        <p class="text-xs opacity-80">Merci de vérifier vos réponses puis de renvoyer.</p>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="mt-4 bg-red-50 dark:bg-red-900/20 border border-red-300 dark:border-red-500/60 text-red-700 dark:text-red-200 px-4 py-3 rounded-lg text-sm flex items-start gap-2" role="alert">
                    <i class="fa-solid fa-triangle-exclamation mt-[2px] text-xs"></i>
                    <div>
                        <strong class="font-semibold">Oups !</strong>
                        <span class="block sm:inline ml-1">{{ session('error') }}</span>
                    </div>
                </div>
            @endif
        </div>

        <form method="POST" action="{{ Auth::check() ? route('survey.store.answers', ['id' => $survey_id]) : $url }}" class="space-y-6">
            @csrf

            <input type="hidden" name="answers" :value="JSON.stringify(questions)">
            <input type="hidden" name="survey_id" value="{{ $survey_id }}">

            <div class="space-y-6">

                @forelse($surveyQuestions as $question)
                    @php
                        $key = 'q_' . $question->id;
                        $oldValue = old('questions.' . $key);
                    @endphp

                    {{-- CARD QUESTION --}}
                    <div class="bg-surface dark:bg-surface-dark p-6 rounded-xl shadow-sm border border-bordercolor dark:border-bordercolor-dark space-y-4">
                        <div class="flex items-start justify-between gap-3">
                            <label class="block text-base font-semibold text-text-primary dark:text-text-primary-dark leading-snug">
                                <span class="inline-flex items-center justify-center h-6 w-6 rounded-full bg-primary-soft dark:bg-primary-soft-dark text-[11px] font-bold text-primary mr-2">
                                    {{ $loop->iteration }}
                                </span>
                                {{ $question->title }}
                            </label>

                            {{-- Badge type de question --}}
                            <div>
                                @if($question->question_type === 'text')
                                    <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[11px] font-semibold bg-background dark:bg-background-dark text-text-secondary dark:text-text-secondary-dark border border-bordercolor/70 dark:border-bordercolor-dark/70 uppercase tracking-wide">
                                        <i class="fa-solid fa-pen text-[10px]"></i>
                                        Texte libre
                                    </span>
                                @elseif($question->question_type === 'single_choice')
                                    <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[11px] font-semibold bg-background dark:bg-background-dark text-text-secondary dark:text-text-secondary-dark border border-bordercolor/70 dark:border-bordercolor-dark/70 uppercase tracking-wide">
                                        <i class="fa-regular fa-circle-dot text-[10px]"></i>
                                        Choix unique
                                    </span>
                                @elseif($question->question_type === 'multiple_choice')
                                    <span class="w-32 inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[11px] font-semibold bg-background dark:bg-background-dark text-text-secondary dark:text-text-secondary-dark border border-bordercolor/70 dark:border-bordercolor-dark/70 uppercase tracking-wide">
                                        <i class="fa-solid fa-square-check text-[10px]"></i>
                                        Choix multiple
                                    </span>
                                @elseif($question->question_type === 'range')
                                    <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[11px] font-semibold bg-background dark:bg-background-dark text-text-secondary dark:text-text-secondary-dark border border-bordercolor/70 dark:border-bordercolor-dark/70 uppercase tracking-wide">
                                        <i class="fa-solid fa-sliders text-[10px]"></i>
                                        Échelle
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="space-y-3">
                            @if ($question->question_type === 'text')
                                <input
                                    type="text"
                                    class="mt-1 block w-full bg-background dark:bg-background-dark border border-bordercolor dark:border-bordercolor-dark
                                           rounded-lg shadow-sm px-3 py-2.5 text-sm text-text-primary dark:text-text-primary-dark
                                           placeholder:text-text-secondary/70 dark:placeholder:text-text-secondary-dark/70
                                           transition-all duration-150
                                           hover:border-accent dark:hover:border-accent-dark
                                           focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary
                                           focus:-translate-y-[1px] focus:shadow-md"
                                    value="{{ $oldValue }}"
                                    name="questions[{{ $key }}]"
                                    placeholder="Votre réponse..."
                                    x-on:input="updateResponse('{{ $key }}', $event.target.value)"
                                >

                            @elseif ($question->question_type === 'single_choice' && is_array($question->options))
                                <div class="space-y-2">
                                    @foreach ($question->options as $option)
                                        <label class="flex items-center gap-2 text-sm text-text-primary dark:text-text-primary-dark cursor-pointer">
                                            <input
                                                type="radio"
                                                name="questions[{{ $key }}]"
                                                value="{{ $option }}"
                                                {{ $oldValue == $option ? 'checked' : '' }}
                                                class="h-4 w-4 rounded-full border-bordercolor dark:border-bordercolor-dark text-primary
                                                       focus:ring-primary focus:ring-offset-0 focus:outline-none"
                                                x-on:change="updateResponse('{{ $key }}', $event.target.value)"
                                            >
                                            <span>{{ $option }}</span>
                                        </label>
                                    @endforeach
                                </div>

                            @elseif ($question->question_type === 'multiple_choice' && is_array($question->options))
                                @php $sel = is_array($oldValue) ? $oldValue : []; @endphp
                                <div class="space-y-2">
                                    @foreach ($question->options as $option)
                                        <label class="flex items-center gap-2 text-sm text-text-primary dark:text-text-primary-dark cursor-pointer">
                                            <input
                                                type="checkbox"
                                                name="questions[{{ $key }}][]"
                                                value="{{ $option }}"
                                                {{ in_array($option, $sel) ? 'checked' : '' }}
                                                class="h-4 w-4 rounded border-bordercolor dark:border-bordercolor-dark text-primary
                                                       focus:ring-primary focus:ring-offset-0 focus:outline-none
                                                       dark:bg-primary-soft-dark scale-125"
                                                x-on:change="updateCheckbox('{{ $key }}', '{{ $option }}', $event.target.checked)"
                                            >
                                            <span class="text-[0.9rem]">{{ $option }}</span>
                                        </label>
                                    @endforeach
                                </div>

                            @elseif ($question->question_type === 'range')
                                <div class="space-y-2">
                                    <div class="flex items-center justify-between text-[11px] font-medium text-text-secondary dark:text-text-secondary-dark uppercase tracking-wide">
                                        <span class="text-sm">0 : min</span>
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-primary-soft/60 dark:bg-primary-soft-dark/70 text-primary text-[11px]">
                                            <i class="fa-solid fa-gauge text-[14px]"></i>
                                            <span class="text-sm">
                                                Valeurs :
                                                <span x-text="questions['{{ $key }}'].response ?? 5"></span>/10
                                            </span>
                                        </span>
                                        <span class="text-sm">max : 10</span>
                                    </div>

                                    <div class="relative">
                                        <input
                                            type="range"
                                            class="w-full h-2 rounded-full appearance-none cursor-pointer
           bg-primary-soft/40

           [&::-webkit-slider-thumb]:appearance-none
           [&::-webkit-slider-thumb]:h-4
           [&::-webkit-slider-thumb]:w-4
           [&::-webkit-slider-thumb]:rounded-full
           [&::-webkit-slider-thumb]:bg-gray-300
           dark:[&::-webkit-slider-thumb]:bg-white
           [&::-webkit-slider-thumb]:border
           [&::-webkit-slider-thumb]:border-bordercolor
           [&::-webkit-slider-thumb]:shadow

           [&::-moz-range-thumb]:h-4
           [&::-moz-range-thumb]:w-4
           [&::-moz-range-thumb]:rounded-full
           [&::-moz-range-thumb]:bg-gray-300
           dark:[&::-moz-range-thumb]:bg-white
           [&::-moz-range-thumb]:border
           [&::-moz-range-thumb]:border-bordercolor
           [&::-moz-range-thumb]:shadow

           focus:outline-none"
                                            min="0"
                                            max="10"
                                            step="1"
                                            name="questions[{{ $key }}][]"
                                            value="5"
                                            x-init="updateResponse('{{ $key }}', 5)"
                                            x-on:input="updateResponse('{{ $key }}', $event.target.value)"
                                            x-on:change="updateResponse('{{ $key }}', $event.target.value)"
                                            x-bind:style="`
        --val: ${questions['{{ $key }}'].response ?? 5};
        background:
            linear-gradient(to right, rgb(129 140 248) 0%, rgb(236 72 153) 100%) 0 0 / calc((var(--val) / 10) * 100%) 100% no-repeat,
            rgba(129, 140, 248, 0.15);
    `"
                                        />






                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                @empty
                    <div class="bg-surface dark:bg-surface-dark p-6 rounded-xl shadow-sm border border-bordercolor dark:border-bordercolor-dark text-center">
                        <p class="text-text-secondary dark:text-text-secondary-dark text-sm flex items-center justify-center gap-2">
                            <i class="fas fa-circle-info text-xs"></i>
                            Aucune question.
                        </p>
                    </div>
                @endforelse

                <button
                    type="submit"
                    class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium rounded-lg text-white shadow-md relative overflow-hidden group flex items-center px-3 py-2 rounded-lg
                                   text-text-primary dark:text-text-primary-dark
                                   transform transition-all duration-150
                                   hover:scale-[1.02] active:scale-[0.97]
                                   before:absolute before:inset-0 before:-z-10
                                   before:bg-primary-noise dark:before:bg-primary-noise-dark
                                   before:bg-[length:260%_260%] before:bg-center
                                   before:opacity-0 before:transition-opacity before:duration-200
                                   hover:before:opacity-100 hover:before:animate-gradient-noise
                                   hover:text-white dark:hover:text-white w-full text-md
                           {{ $surveyQuestions->count() === 0
                                ? 'pointer-events-none opacity-50 bg-indigo-600'
                                : 'bg-gradient-to-r from-primary to-accent hover:brightness-110 hover:-translate-y-[1px] transition-all duration-150' }}"
                >
                    <i class="fa-solid fa-paper-plane text-xs mr-2"></i>
                    Envoyer
                </button>
            </div>
        </form>
    </div>
</x-app-layout>

