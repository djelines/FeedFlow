<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg text-gray-900 leading-tight">
            Résultats : {{ $survey->title }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

        @foreach ($survey->questions as $question)
            <button
                onclick="openModal('modal_{{ $question->id }}')"
                class="px-3 py-1.5 bg-gray-200 text-gray-700 rounded-lg shadow-sm hover:bg-gray-300 transition text-sm w-full text-left"
            >
                Voir les stats : {{ $question->title }}
            </button>

            <div id="modal_{{ $question->id }}" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center z-50">
                <div class="bg-indigo-50 rounded-2xl w-96 h-[700px] p-4 relative shadow-md border-2 border-stone-300 flex flex-col">

                    <button onclick="closeModal('modal_{{ $question->id }}')" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 text-sm">
                        ✕
                    </button>

                    <h3 class="text-lg font-semibold mb-4 text-gray-800">{{ $question->title }}</h3>

                    @php
                        // PHP variables are required here for displaying HTML labels (captions).
                        $allAnswers = [];
                        foreach($question->answers as $a){
                            $decoded = json_decode($a->answer, true);
                            if(!is_array($decoded)){
                                $decoded = [$a->answer];
                            }
                            foreach($decoded as $ans){
                                $allAnswers[] = trim($ans) === "" ? "N/A" : $ans;
                            }
                        }
                        $countAnswers = count($allAnswers) > 0 ? array_count_values($allAnswers) : ['N/A' => 1];
                        $labels = array_keys($countAnswers);
                        $values = array_values($countAnswers);
                    @endphp

                    <div class="flex flex-col flex-grow space-y-4">
                        <div class="flex bg-white p-3 rounded-xl flex-1 items-center gap-2">
                            <div class="w-1/2 flex items-center justify-center h-full">
                                <canvas id="pie_{{ $question->id }}" class="w-full"></canvas>
                            </div>
                            <div class="w-1/2 text-sm">
                                <ul class="space-y-1">
                                    @php
                                        $colorPalette = [
                                            "#ffd670", "#ff8fab", "#c1d3fe", "#b2f7ef",
                                            "#b8b8ff", "#34D399", "#ff686b", "#f4eea9"
                                        ];

                                    @endphp

                                    @foreach($countAnswers as $label => $count)
                                        <li class="flex items-center gap-2">
                                            <span class="w-3 h-3 rounded-full" style="background-color: {{ $colorPalette[$loop->index % count($colorPalette)] }}"></span>
                                            <span class="text-gray-700">{{ $label }}</span>
                                            <span class="text-gray-500 ml-auto">{{ $count }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <hr class="border-gray-300">

                        <div class="bg-white p-3 rounded-xl flex-1">
                            <canvas id="bar_{{ $question->id }}" class="w-full h-full"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>



    <script>
        const colorPalette = [
            "#ffd670", "#ff8fab", "#c1d3fe", "#b2f7ef",
            "#b8b8ff", "#34D399", "#ff686b", "#f4eea9"
        ];

        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
            document.getElementById(id).classList.add('flex');
        }
        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
            document.getElementById(id).classList.remove('flex');
        }

        @foreach ($survey->questions as $question)
        @php
            // Calculation here to be use in js
            $allAnswers = [];
            foreach($question->answers as $a){
                $decoded = json_decode($a->answer, true);
                if(!is_array($decoded)){
                    $decoded = [$a->answer];
                }
                foreach($decoded as $ans){
                    $allAnswers[] = trim($ans) === "" ? "N/A" : $ans;
                }
            }
            $countAnswers = count($allAnswers) > 0 ? array_count_values($allAnswers) : ['N/A' => 1];
            $labels = array_keys($countAnswers);
            $values = array_values($countAnswers);
        @endphp

        // The JS variables are now injected with the stats specific to $question.
        const labels_{{ $question->id }} = {!! json_encode($labels) !!};
        const data_{{ $question->id }} = {!! json_encode($values) !!};
        const colors_{{ $question->id }} = labels_{{ $question->id }}.map((_,i)=>colorPalette[i % colorPalette.length]);

        new Chart(document.getElementById("pie_{{ $question->id }}"), {
            type: 'pie',
            data: {
                labels: labels_{{ $question->id }},
                datasets: [{
                    data: data_{{ $question->id }},
                    backgroundColor: colors_{{ $question->id }},
                    borderColor: "#fff",
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
                        ticks: { stepSize: 1, font: { size: 12 }, maxTicksLimit: 5 },
                        grid: { drawTicks: false, color: '#e5e7eb' }
                    },
                    y: {
                        ticks: { font: { size: 12 } },
                        grid: { drawTicks: false, color: '#e5e7eb' }
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
