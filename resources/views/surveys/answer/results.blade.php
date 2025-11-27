<x-app-layout>

    <div class="max-w-7xl mx-auto py-10 px-6 lg:px-8 space-y-8">

        {{-- Header--}}
        <div class="bg-surface dark:bg-surface-dark rounded-xl shadow-sm border border-bordercolor dark:border-bordercolor-dark p-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="flex-1 space-y-2">
                    {{-- Ligne icône + label --}}
                    <div class="flex items-center gap-3">
                        <div class="inline-flex h-9 w-9 items-center justify-center rounded-xl bg-primary-soft dark:bg-primary-soft-dark text-primary">
                            <i class="fa-solid fa-chart-pie text-sm"></i>
                        </div>

                        <p class="text-xs font-semibold uppercase tracking-wide text-text-secondary dark:text-text-secondary-dark">
                            Résultats du sondage
                        </p>
                    </div>

                    {{-- Titre --}}
                    <h2 class="text-2xl font-bold text-text-primary dark:text-text-primary-dark leading-tight">
                        {{ $survey->title }}
                    </h2>

                    @if(!empty($survey->description))
                        <p class="text-sm text-text-secondary dark:text-text-secondary-dark leading-relaxed">
                            {{ $survey->description }}
                        </p>
                    @endif
                </div>


                {{-- Bouton PDF --}}
                <div class="flex-shrink-0">
                    <a
                        href="{{ route('survey.answer.resultPdf', $survey ->hash_id) }}"
                        class="relative overflow-hidden group inline-flex items-center px-4 py-2.5 rounded-lg text-sm font-medium
                               transform transition-all duration-150
                               before:absolute before:inset-0 before:-z-10
                               before:bg-primary-noise dark:before:bg-primary-noise-dark
                               before:bg-[length:260%_260%] before:bg-center
                               before:opacity-0 before:transition-opacity before:duration-200
                               {{ $survey->questions->count() === 0
                                    ? 'pointer-events-none opacity-50 bg-indigo-600 text-white'
                                    : 'bg-transparent text-text-primary dark:text-text-primary-dark hover:scale-[1.02] active:scale-[0.97] hover:before:opacity-100 hover:before:animate-gradient-noise hover:text-white dark:hover:text-white' }}"
                    >
                        <i class="fa-solid fa-file-pdf text-xs mr-2"></i>
                        <span>Télécharger en PDF</span>
                    </a>
                </div>
            </div>

            @if($survey->questions->count() === 0)
                <p class="mt-4 text-sm text-text-secondary dark:text-text-secondary-dark flex items-center gap-2">
                    <i class="fa-regular fa-circle-xmark text-xs"></i>
                    Aucune question dans ce sondage.
                </p>
            @endif
        </div>

        @if($survey->questions->count() !== 0)

            {{-- Liste des questions / stats --}}
            <div class="">
                <p class="text-sm font-semibold text-text-secondary dark:text-text-secondary-dark uppercase tracking-wide mb-3">
                    Questions du sondage
                </p>

                @foreach ($survey->questions as $question)
                    <button
                        onclick="openModal('modal_{{ $question->id }}')"
                        class="w-full text-left bg-surface dark:bg-surface-dark border border-bordercolor/80 dark:border-bordercolor-dark/80
                               rounded-xl px-4 py-3 shadow-sm hover:shadow-md hover:bg-primary-soft/20 dark:hover:bg-primary-soft-dark/10
                               transition-all duration-150 flex items-center justify-between gap-3 text-sm mb-4"
                    >
                        <div class="flex items-center gap-3">
                            <span class="inline-flex h-7 w-7 items-center justify-center rounded-full bg-primary-soft dark:bg-primary-soft-dark text-[11px] font-bold text-primary">
                                {{ $loop->iteration }}
                            </span>
                            <span class="text-text-primary dark:text-text-primary-dark font-medium">
                                Voir les statistiques : {{ $question->title }}
                            </span>
                        </div>
                        <span class="text-[11px] uppercase tracking-wide text-text-secondary dark:text-text-secondary-dark flex items-center gap-1">
                            <i class="fa-solid fa-chart-column text-[10px]"></i>
                            Détails
                        </span>
                    </button>

                    {{-- Modal --}}
                    <div
                        id="modal_{{ $question->id }}"
                        class="fixed inset-0 bg-black/40 dark:bg-black/60 hidden items-center justify-center z-50 m-0"
                    >
                        <div
                            class="bg-surface dark:bg-surface-dark rounded-2xl w-full max-w-lg h-[680px] p-5 relative shadow-xl
                                   border border-bordercolor dark:border-bordercolor-dark flex flex-col"
                        >
                            {{-- Close --}}
                            <button
                                onclick="closeModal('modal_{{ $question->id }}')"
                                class="absolute top-3 right-3 text-text-secondary dark:text-text-secondary-dark hover:text-text-primary dark:hover:text-text-primary-dark text-sm rounded-full h-7 w-7 flex items-center justify-center hover:bg-background dark:hover:bg-background-dark transition"
                                aria-label="Fermer"
                            >
                                <i class="fa-solid fa-xmark text-xs"></i>
                            </button>

                            {{-- Title --}}
                            <div class="mb-4 pr-8">
                                <h3 class="text-lg font-semibold text-text-primary dark:text-text-primary-dark leading-snug">
                                    {{ $question->title }}
                                </h3>
                                <p class="text-xs text-text-secondary dark:text-text-secondary-dark mt-1">
                                    Aperçu des réponses pour cette question.
                                </p>
                            </div>

                            @php
                                // PHP variables are required here for displaying HTML labels (captions).
                                $allAnswers = [];
                                foreach ($question->answers as $a) {
                                    $decoded = json_decode($a->answer, true);
                                    if (!is_array($decoded)) {
                                        $decoded = [$a->answer];
                                    }
                                    foreach ($decoded as $ans) {
                                        $allAnswers[] = trim($ans) === "" ? "N/A" : $ans;
                                    }
                                }
                                $countAnswers = count($allAnswers) > 0 ? array_count_values($allAnswers) : ['N/A' => 1];
                                $labels = array_keys($countAnswers);
                                $values = array_values($countAnswers);
                            @endphp

                            <div class="flex flex-col flex-grow space-y-4">

                                {{-- Pie + légende --}}
                                <div class="flex bg-background dark:bg-background-dark p-3 rounded-xl flex-1 items-center gap-3 border border-bordercolor/60 dark:border-bordercolor-dark/60">
                                    <div class="w-1/2 flex items-center justify-center h-full">
                                        <canvas id="pie_{{ $question->id }}" class="w-full h-full"></canvas>
                                    </div>
                                    <div class="w-1/2 text-xs">
                                        <ul class="space-y-1.5">
                                            @php
                                                $colorPalette = [
                                                    "#ffd670",
                                                    "#ff8fab",
                                                    "#c1d3fe",
                                                    "#b2f7ef",
                                                    "#b8b8ff",
                                                    "#34D399",
                                                    "#ff686b",
                                                    "#f4eea9"
                                                ];
                                            @endphp

                                            @foreach($countAnswers as $label => $count)
                                                <li class="flex items-center gap-2">
                                                    <span class="w-3 h-3 rounded-full"
                                                          style="background-color: {{ $colorPalette[$loop->index % count($colorPalette)] }}"></span>
                                                    <span class="text-text-primary dark:text-text-primary-dark truncate max-w-[120px]">
                                                        {{ $label }}
                                                    </span>
                                                    <span class="text-text-secondary dark:text-text-secondary-dark ml-auto font-medium">
                                                        {{ $count }}
                                                    </span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                                <hr class="border-bordercolor/60 dark:border-bordercolor-dark/60">

                                {{-- Bar chart --}}
                                <div class="bg-background dark:bg-background-dark p-3 rounded-xl flex-1 border border-bordercolor/60 dark:border-bordercolor-dark/60">
                                    <canvas id="bar_{{ $question->id }}" class="w-full h-full"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        @endif

    </div>

    <script>
        const colorPalette = [
            "#ffd670", "#ff8fab", "#c1d3fe", "#b2f7ef",
            "#b8b8ff", "#34D399", "#ff686b", "#f4eea9"
        ];

        function openModal(id) {
            const el = document.getElementById(id);
            if (!el) return;
            el.classList.remove('hidden');
            el.classList.add('flex');
        }

        function closeModal(id) {
            const el = document.getElementById(id);
            if (!el) return;
            el.classList.add('hidden');
            el.classList.remove('flex');
        }

        @foreach ($survey->questions as $question)
        @php
            // Calculation here to be used in JS
            $allAnswers = [];
            foreach ($question->answers as $a) {
                $decoded = json_decode($a->answer, true);
                if (!is_array($decoded)) {
                    $decoded = [$a->answer];
                }
                foreach ($decoded as $ans) {
                    $allAnswers[] = trim($ans) === "" ? "N/A" : $ans;
                }
            }
            $countAnswers = count($allAnswers) > 0 ? array_count_values($allAnswers) : ['N/A' => 1];
            $labels = array_keys($countAnswers);
            $values = array_values($countAnswers);
        @endphp

        const labels_{{ $question->id }} = {!! json_encode($labels) !!};
        const data_{{ $question->id }} = {!! json_encode($values) !!};
        const colors_{{ $question->id }} = labels_{{ $question->id }}.map((_, i) => colorPalette[i % colorPalette.length]);

        new Chart(document.getElementById("pie_{{ $question->id }}"), {
            type: 'pie',
            data: {
                labels: labels_{{ $question->id }},
                datasets: [{
                    data: data_{{ $question->id }},
                    backgroundColor: colors_{{ $question->id }},
                    borderColor: "#111827",
                    borderWidth: 1
                }]
            },
            options: {
                plugins: { legend: { display: false } },
                responsive: true,
                maintainAspectRatio: false
            }
        });

        new Chart(document.getElementById("bar_{{ $question->id }}"), {
            type: 'bar',
            data: {
                labels: labels_{{ $question->id }},
                datasets: [{
                    label: "Réponses",
                    data: data_{{ $question->id }},
                    backgroundColor: colors_{{ $question->id }},
                    borderRadius: 6,
                    barThickness: 25
                }]
            },
            options: {
                indexAxis: 'y',
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            font: { size: 11 },
                            color: '#6b7280'
                        },
                        grid: {
                            drawTicks: false,
                            color: '#e5e7eb'
                        }
                    },
                    y: {
                        ticks: {
                            font: { size: 11 },
                            color: '#4b5563'
                        },
                        grid: {
                            drawTicks: false,
                            color: '#e5e7eb'
                        }
                    }
                },
                plugins: { legend: { display: false } },
                responsive: true,
                maintainAspectRatio: false
            }
        });
        @endforeach
    </script>
</x-app-layout>
