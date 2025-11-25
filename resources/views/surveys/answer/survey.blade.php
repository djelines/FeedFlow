<x-app-layout>

    @php
        // 1. PRÉPARATION DE LA STRUCTURE (PHP)
        // On crée un tableau associatif (Clé => Données) pour faciliter la manipulation dans la vue.
        // Alpine.js utilisera cet objet pour savoir rapidement quelle question mettre à jour.
        $initialState = [];

        foreach ($surveyQuestions as $question) {
            $key = 'q_' . $question->id;
            $oldVal = old('questions.' . $key);

            // Gestion spécifique pour checkbox (doit être un tableau)
            if ($question->question_type === 'checkbox' && !is_array($oldVal)) {
                $oldVal = [];
            }

            // Voici la structure exacte d'un élément de votre tableau final
            $initialState[$key] = [
                'question_id' => $question->id,
                'survey_id'   => $question->survey_id, // Ou $survey->id si disponible
                'type'        => $question->question_type,
                'response'    => $oldVal
            ];
        }
    @endphp

    <div x-data="{
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
    }" class="max-w-4xl mx-auto py-6">

        @if (isset($errors) && count($errors))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                Il y a des erreurs dans le formulaire.
            </div>
        @endif


            @error('answers')
            <p class="text-red-600 text-xs mt-1 font-semibold">{{ $message }}</p>
            @enderror
            @error('survey_id')
            <p class="text-red-600 text-xs mt-1 font-semibold">{{ $message }}</p>
            @enderror
            @error('user_id')
            <p class="text-red-600 text-xs mt-1 font-semibold">{{ $message }}</p>
            @enderror

        <form method="POST" action="{{ route('survey.store.answers') }}">
            @csrf

            <input type="hidden" name="answers" :value="JSON.stringify(questions)">
            <input type="hidden" name="survey_id" value="{{$survey_id}}">

            <div class="space-y-8">
                <h1 class="text-2xl font-bold">Répondre au Sondage</h1>

                @forelse($surveyQuestions as $question)
                    @php
                        $key = 'q_' . $question->id;
                        $oldValue = old('questions.' . $key);
                    @endphp

                    <div class="bg-white p-6 rounded shadow border">
                        <label class="block text-lg font-medium mb-4">
                            {{ $loop->iteration }}. {{ $question->title }}
                        </label>

                        <div>
                            {{-- TYPE: TEXTE --}}
                            @if ($question->question_type === 'text')
                                <input type="text"
                                       class="w-full border rounded p-2"
                                       value="{{ $oldValue }}"
                                       {{-- name="..." sert uniquement pour old() en cas d'erreur --}}
                                       name="questions[{{ $key }}]"
                                       x-on:input="updateResponse('{{ $key }}', $event.target.value)">

                                {{-- TYPE: RADIO --}}
                            @elseif ($question->question_type === 'single_choice' && is_array($question->options))
                                @foreach ($question->options as $option)
                                    <div class="flex items-center mb-2">
                                        <input type="radio"
                                               name="questions[{{ $key }}]"
                                               value="{{ $option }}"
                                               {{ $oldValue == $option ? 'checked' : '' }}
                                               x-on:change="updateResponse('{{ $key }}', $event.target.value)">
                                        <span class="ml-2">{{ $option }}</span>
                                    </div>
                                @endforeach

                                {{-- TYPE: CHECKBOX --}}
                            @elseif ($question->question_type === 'multiple_choice' && is_array($question->options))
                                @php $sel = is_array($oldValue) ? $oldValue : []; @endphp
                                @foreach ($question->options as $option)
                                    <div class="flex items-center mb-2">
                                        <input type="checkbox"
                                               name="questions[{{ $key }}][]"
                                               value="{{ $option }}"
                                               {{ in_array($option, $sel) ? 'checked' : '' }}
                                               x-on:change="updateCheckbox('{{ $key }}', '{{ $option }}', $event.target.checked)">
                                        <span class="ml-2">{{ $option }}</span>
                                    </div>
                                @endforeach
                            @elseif ($question->question_type === 'range')
                                <input type="range"
                                       class="w-full"
                                       min="0"
                                       max="10"
                                       value="0"
                                       name="questions[{{ $key }}]">
                            @endif
                        </div>
                    </div>
                @empty
                    <p>Aucune question.</p>
                @endforelse

                <div class="bg-gray-100 p-4 rounded text-xs font-mono">
                    <p class="font-bold mb-2">Ce qui sera envoyé au Back (Array) :</p>
                    <pre x-text="JSON.stringify(Object.values(questions), null, 2)"></pre>
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Envoyer
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
