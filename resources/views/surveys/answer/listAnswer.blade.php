<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <h1 class="flex items-center justify-between gap-3 text-3xl font-bold text-text-primary dark:text-text-primary-dark tracking-tight border-b-2 border-bordercolor dark:border-bordercolor-dark pb-3 mb-10">
                <span>Historique des réponses :</span>
                @if($groupedAnswers->count() > 0)
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200">
                        {{ $groupedAnswers->count() }} sondages concernés
                    </span>
                @endif
            </h1>

            @if($groupedAnswers->isEmpty())
                <div class="text-center py-20 text-text-secondary dark:text-text-secondary-dark bg-surface dark:bg-surface-dark border border-bordercolor/70 dark:border-bordercolor-dark/70 rounded-2xl shadow-sm">
                    <i class="fa-solid fa-circle-exclamation text-4xl mb-4 text-text-secondary dark:text-text-secondary-dark"></i><br>
                    Aucune réponse trouvée.
                </div>
            @else

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

                    @foreach ($groupedAnswers as $surveyId => $submissions)
                        @php
                            $firstSubmission = $submissions->first(); 
                            $survey = $firstSubmission->first()->survey;

                            $postitStyles = [
                                ['bg' => 'bg-amber-100 dark:bg-amber-900/30', 'title' => 'text-amber-900 dark:text-amber-100', 'muted' => 'text-amber-700 dark:text-amber-200', 'border' => 'border-amber-200 dark:border-amber-700', 'dot' => 'bg-amber-500/80 dark:bg-amber-300/90'],
                                ['bg' => 'bg-rose-100 dark:bg-rose-900/30', 'title' => 'text-rose-900 dark:text-rose-100', 'muted' => 'text-rose-700 dark:text-rose-200', 'border' => 'border-rose-200 dark:border-rose-700', 'dot' => 'bg-rose-500/80 dark:bg-rose-300/90'],
                                ['bg' => 'bg-emerald-100 dark:bg-emerald-900/30', 'title' => 'text-emerald-900 dark:text-emerald-100', 'muted' => 'text-emerald-700 dark:text-emerald-200', 'border' => 'border-emerald-200 dark:border-emerald-700', 'dot' => 'bg-emerald-500/80 dark:bg-emerald-300/90'],
                                ['bg' => 'bg-sky-100 dark:bg-sky-900/30', 'title' => 'text-sky-900 dark:text-sky-100', 'muted' => 'text-sky-700 dark:text-sky-200', 'border' => 'border-sky-200 dark:border-sky-700', 'dot' => 'bg-sky-500/80 dark:bg-sky-300/90'],
                            ];
                            $style = $postitStyles[array_rand($postitStyles)];
                            $rotations = ['rotate-1', '-rotate-1', 'rotate-2', '-rotate-2', 'rotate-0'];
                            $rotation = $rotations[array_rand($rotations)];
                        @endphp

                        <div class="transform transition-all duration-300 hover:scale-[1.02] hover:-translate-y-1 h-full">
                            <div class="relative {{ $style['bg'] }} {{ $style['border'] }} {{ $rotation }} rounded-xl p-6 border shadow-lg flex flex-col h-full"
                                 style="box-shadow: 4px 4px 0px rgba(15, 23, 42, 0.25);">
                                
                                <span class="absolute -top-2 left-8 w-3 h-3 rounded-full {{ $style['dot'] }} shadow-sm border border-white/70"></span>

                                <h3 class="text-xl font-bold mb-1 flex items-center gap-2 {{ $style['title'] }}">
                                    <i class="fa-solid fa-clipboard-list text-sm opacity-70"></i>
                                    <span class="line-clamp-2">{{ $survey->title ?? 'Sondage #'.$surveyId }}</span>
                                </h3>
                                <p class="text-xs mb-4 {{ $style['muted'] }} opacity-75">
                                    {{ $submissions->count() }} soumission(s) différente(s)
                                </p>

                                <div class="flex-grow mb-2">
                                    <div class="max-h-72 overflow-y-auto custom-scrollbar pr-2 rounded-lg bg-white/40 dark:bg-black/10 border border-white/50 dark:border-white/10 p-1 shadow-inner">
                                        
                                        @foreach($submissions as $date => $answers)
                                            <div class="mb-4 last:mb-0 bg-white/50 dark:bg-black/20 rounded p-2">
                                                
                                                <div class="flex items-center gap-2 mb-2 pb-1 border-b border-black/10 dark:border-white/10">
                                                    <i class="fa-regular fa-clock text-[10px] {{ $style['muted'] }}"></i>
                                                    <span class="text-xs font-bold {{ $style['title'] }}">
                                                        {{ $date }}
                                                    </span>
                                                </div>

                                                @foreach($answers as $answer)
                                                    <div class="mb-2 last:mb-0">
                                                        <p class="text-[10px] font-bold uppercase tracking-wide opacity-60 {{ $style['title'] }}">
                                                            {{ $answer->surveyQuestion->title ?? 'Question supprimée' }}
                                                        </p>
                                                        <div class="text-sm font-medium pl-2 border-l-2 {{ $style['border'] }} {{ $style['title'] }}">
                                                            {{ $answer->answer ?: 'Non renseignée' }}
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>