<x-app-layout>

    <div class="p-8 space-y-8 animate-in fade-in duration-500">

        <div class="flex flex-col gap-2 pb-6 border-b border-slate-200 dark:border-bordercolor-dark">
            <h1 class="text-4xl font-extrabold text-slate-900 dark:text-text-primary-dark">
                Bonjour, {{$user->first_name}} 👋
            </h1>
            <p class="text-slate-500 dark:text-text-secondary-dark text-lg">
                Voici ce qui se passe dans vos <span class="font-bold text-slate-700 dark:text-text-primary-dark">{{$organizations}} organisations</span>.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            <div class="bg-white dark:bg-surface-dark p-6 rounded-2xl border border-slate-200 dark:border-bordercolor-dark shadow-sm hover:shadow-md transition-all flex items-center gap-4 group">
                <div class="w-14 h-14 bg-indigo-50 dark:bg-primary-soft-dark rounded-xl flex items-center justify-center text-indigo-600 dark:text-primary-dark">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-square-icon lucide-message-square"><path d="M22 17a2 2 0 0 1-2 2H6.828a2 2 0 0 0-1.414.586l-2.202 2.202A.71.71 0 0 1 2 21.286V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2z"/></svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-slate-400 dark:text-text-secondary-dark uppercase tracking-wider">Total Réponses reçues</p>
                    <h3 class="text-3xl font-extrabold text-slate-900 dark:text-text-primary-dark">{{$totalAnswers}}</h3>
                </div>
            </div>

            <div class="bg-white dark:bg-surface-dark p-6 rounded-2xl border border-slate-200 dark:border-bordercolor-dark shadow-sm hover:shadow-md transition-all flex items-center gap-4">
                <div class="w-14 h-14 bg-emerald-50 dark:bg-emerald-900/20 rounded-xl flex items-center justify-center text-emerald-600 dark:text-emerald-400">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-activity-icon lucide-activity"><path d="M22 12h-2.48a2 2 0 0 0-1.93 1.46l-2.35 8.36a.25.25 0 0 1-.48 0L9.24 2.18a.25.25 0 0 0-.48 0l-2.35 8.36A2 2 0 0 1 4.49 12H2"/></svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-slate-400 dark:text-text-secondary-dark uppercase tracking-wider">Sondages Actifs</p>
                    <h3 class="text-3xl font-extrabold text-slate-900 dark:text-text-primary-dark">{{$activeSurvey}}</h3>
                </div>
            </div>

            <div class="bg-white dark:bg-surface-dark p-6 rounded-2xl border border-slate-200 dark:border-bordercolor-dark shadow-sm hover:shadow-md transition-all flex items-center gap-4 cursor-pointer">
                <div class="w-14 h-14 bg-purple-50 dark:bg-purple-900/20 rounded-xl flex items-center justify-center text-purple-600 dark:text-purple-400">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-activity-icon lucide-square-activity"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M17 12h-2l-2 5-2-10-2 5H7"/></svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-slate-400 dark:text-text-secondary-dark uppercase tracking-wider">Total sondages</p>
                    <h3 class="text-3xl font-extrabold text-slate-900 dark:text-text-primary-dark">{{$surveys}}</h3>
                </div>
            </div>

            <div class="bg-white dark:bg-surface-dark p-6 rounded-2xl border border-slate-200 dark:border-bordercolor-dark shadow-sm hover:shadow-md transition-all flex items-center gap-4">
                <div class="w-14 h-14 bg-orange-50 dark:bg-orange-900/20 rounded-xl flex items-center justify-center text-orange-600 dark:text-orange-400">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-send-horizontal-icon lucide-send-horizontal"><path d="M3.714 3.048a.498.498 0 0 0-.683.627l2.843 7.627a2 2 0 0 1 0 1.396l-2.842 7.627a.498.498 0 0 0 .682.627l18-8.5a.5.5 0 0 0 0-.904z"/><path d="M6 12h16"/></svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-slate-400 dark:text-text-secondary-dark uppercase tracking-wider">Total Réponses envoyées</p>
                    <h3 class="text-3xl font-extrabold text-slate-900 dark:text-text-primary-dark">{{$totalAnswersMade}}</h3>
                </div>
            </div>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="bg-white dark:bg-surface-dark p-6 rounded-2xl border border-slate-200 dark:border-bordercolor-dark shadow-sm lg:col-span-2">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-slate-900 dark:text-text-primary-dark">Activité globale</h3>
                    <span class="px-3 py-1 text-xs font-semibold text-indigo-600 dark:text-primary-dark bg-indigo-50 dark:bg-primary-soft-dark rounded-full">
                        Cette semaine
                    </span>
                </div>

                <div class="relative h-80 w-full">
                    <canvas id="weeklyChart"></canvas>
                </div>
            </div>

            <div class="bg-white dark:bg-surface-dark rounded-2xl border border-slate-200 dark:border-bordercolor-dark shadow-sm p-8 flex flex-col">
                <h3 class="text-xl font-bold text-slate-900 dark:text-text-primary-dark mb-6">Sondages Récents</h3>

                <div class="flex-1 space-y-4">
                    @forelse($latestSurveys as $latestSurvey)
                        <div class="group p-4 rounded-xl bg-slate-50 dark:bg-surface-soft-dark border border-slate-100 dark:border-bordercolor-dark hover:bg-white dark:hover:bg-surface-dark hover:border-indigo-200 dark:hover:border-primary-dark hover:shadow-md transition-all cursor-pointer">
                            <div class="flex justify-between items-start mb-2">
                                <span class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-text-secondary-dark bg-white dark:bg-surface-dark px-2 py-1 rounded border
                                border-slate-100 dark:border-bordercolor-dark group-hover:border-indigo-100 dark:group-hover:border-primary-dark group-hover:text-indigo-400 dark:group-hover:text-primary-dark transition-colors">
                                    {{$latestSurvey->organization()->first()->name}}
                                </span>
                                <span @class([
                                    'w-2 h-2 rounded-full',
                                    'bg-emerald-500' => $latestSurvey->is_closed,
                                    'bg-slate-300 dark:bg-slate-600' => !$latestSurvey->is_closed // Ajustement pour le gris en dark mode
                                ])>
                                </span>
                            </div>
                            <h4 class="font-bold text-slate-800 dark:text-text-primary-dark mb-1 truncate group-hover:text-indigo-600 dark:group-hover:text-primary-dark transition-colors">
                                {{$latestSurvey->title}}
                            </h4>
                            <div class="flex items-center gap-4 text-xs text-slate-500 dark:text-text-secondary-dark">
                                <div class="flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-square-icon lucide-message-square"><path d="M22 17a2 2 0 0 1-2 2H6.828a2 2 0 0 0-1.414.586l-2.202 2.202A.71.71 0 0 1 2 21.286V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2z"/></svg>
                                    {{$latestSurvey->questions()->count()}}
                                </div>
                                <div class="flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar-icon lucide-calendar"><path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/></svg>
                                    {{\Carbon\Carbon::parse($latestSurvey->end_date)->translatedFormat('j M')}}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-slate-400 dark:text-text-secondary-dark py-10">Aucune activité récente.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const ctx = document.getElementById('weeklyChart').getContext('2d');

                // Détection du mode sombre pour Chart.js (via la classe 'dark' sur <html> ou <body>)
                const isDarkMode = document.documentElement.classList.contains('dark');

                // Couleurs dynamiques selon le thème
                const gridColor = isDarkMode ? '#1F2937' : '#e2e8f0'; // bordercolor-dark vs slate-200
                const tickColor = isDarkMode ? '#9CA3AF' : '#64748b'; // text-secondary-dark vs slate-500
                const tooltipBg = isDarkMode ? '#111827' : '#1e293b'; // surface-dark vs slate-800
                const lineColor = '#6366F1'; // primary

                const labels = @json($chartLabels);
                const data = @json($chartData);

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Réponses reçues',
                            data: data,
                            borderColor: lineColor,
                            backgroundColor: isDarkMode ? 'rgba(99, 102, 241, 0.1)' : 'rgba(79, 70, 229, 0.1)',
                            borderWidth: 3,
                            pointBackgroundColor: isDarkMode ? '#111827' : '#ffffff', // surface-dark vs white
                            pointBorderColor: lineColor,
                            pointBorderWidth: 2,
                            pointRadius: 4,
                            pointHoverRadius: 6,
                            fill: true,
                            tension: 0.3
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                backgroundColor: tooltipBg,
                                padding: 12,
                                titleFont: { size: 13 },
                                bodyFont: { size: 14 }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    borderDash: [2, 4],
                                    color: gridColor,
                                },
                                ticks: {
                                    precision: 0
                                }
                            },
                            x: {
                                grid: { display: false },
                            }
                        }
                    }
                });
            });
        </script>

</x-app-layout>
