<x-app-layout>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <h1
                class="flex items-center justify-between gap-3
                       text-3xl font-bold text-text-primary dark:text-text-primary-dark tracking-tight
                       border-b-2 border-bordercolor dark:border-bordercolor-dark pb-3 mb-10"
            >
                <span>Tous mes sondages :</span>

                @if($surveys->count() > 0)
                    <span
                        class="px-2.5 py-0.5 rounded-full text-xs font-medium
                               bg-indigo-100 text-indigo-800
                               dark:bg-indigo-900 dark:text-indigo-200"
                    >
                        {{ $surveys->count() }} sondages
                    </span>
                @endif
            </h1>



            @if($surveys->isEmpty())
                {{-- empty state when user have no survey --}}
                <div
                    class="text-center py-20 text-text-secondary dark:text-text-secondary-dark
                           bg-surface dark:bg-surface-dark border border-bordercolor/70 dark:border-bordercolor-dark/70
                           rounded-2xl shadow-sm"
                >
                    <i class="fa-solid fa-circle-exclamation text-4xl mb-4 text-text-secondary dark:text-text-secondary-dark"></i><br>
                    Aucun sondage trouvé.
                </div>
            @else

                {{-- grid for all survey cards --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

                    @foreach ($surveys as $survey)
                        @php
                            // Colors and orientation for INES (gngnggn post it)
                            // random soft color style for post-it
                            $postitStyles = [
                                [
                                    'bg'     => 'bg-amber-100 dark:bg-amber-900/30',
                                    'title'  => 'text-amber-900 dark:text-amber-100',
                                    'muted'  => 'text-amber-700 dark:text-amber-200',
                                    'border' => 'border-amber-200 dark:border-amber-700',
                                    'dot'    => 'bg-amber-500/80 dark:bg-amber-300/90',
                                ],
                                [
                                    'bg'     => 'bg-rose-100 dark:bg-rose-900/30',
                                    'title'  => 'text-rose-900 dark:text-rose-100',
                                    'muted'  => 'text-rose-700 dark:text-rose-200',
                                    'border' => 'border-rose-200 dark:border-rose-700',
                                    'dot'    => 'bg-rose-500/80 dark:bg-rose-300/90',
                                ],
                                [
                                    'bg'     => 'bg-emerald-100 dark:bg-emerald-900/30',
                                    'title'  => 'text-emerald-900 dark:text-emerald-100',
                                    'muted'  => 'text-emerald-700 dark:text-emerald-200',
                                    'border' => 'border-emerald-200 dark:border-emerald-700',
                                    'dot'    => 'bg-emerald-500/80 dark:bg-emerald-300/90',
                                ],
                                [
                                    'bg'     => 'bg-sky-100 dark:bg-sky-900/30',
                                    'title'  => 'text-sky-900 dark:text-sky-100',
                                    'muted'  => 'text-sky-700 dark:text-sky-200',
                                    'border' => 'border-sky-200 dark:border-sky-700',
                                    'dot'    => 'bg-sky-500/80 dark:bg-sky-300/90',
                                ],
                                [
                                    'bg'     => 'bg-violet-100 dark:bg-violet-900/30',
                                    'title'  => 'text-violet-900 dark:text-violet-100',
                                    'muted'  => 'text-violet-700 dark:text-violet-200',
                                    'border' => 'border-violet-200 dark:border-violet-700',
                                    'dot'    => 'bg-violet-500/80 dark:bg-violet-300/90',
                                ],
                            ];

                            $style = $postitStyles[array_rand($postitStyles)];

                            // random small rotation for sticky note vibe
                            $rotations = ['rotate-1', '-rotate-1', 'rotate-2', '-rotate-2', 'rotate-0', 'rotate-3', '-rotate-3'];
                            $rotation = $rotations[array_rand($rotations)];
                        @endphp

                        <div class="transform transition-all duration-300 hover:scale-[1.02] hover:-translate-y-1">
                            <div
                                class="relative {{ $style['bg'] }} {{ $style['border'] }} {{ $rotation }}
                                       rounded-xl p-6 border shadow-lg transition-all duration-300 hover:shadow-2xl
                                       dark:shadow-black/40"
                                style="box-shadow: 4px 4px 0px rgba(15, 23, 42, 0.25);"
                            >
                                {{-- small pin dot, just for fun design yooohooooooooo i'm suuuuupeeeer fuuuuunnn --}}
                                <span
                                    class="absolute -top-2 left-8 w-3 h-3 rounded-full {{ $style['dot'] }} shadow-sm border border-white/70 dark:border-white/40"
                                ></span>

                                {{-- survey title --}}
                                <h3 class="text-xl font-bold mb-3 flex items-center gap-2 {{ $style['title'] }}">
                                    <i class="fa-solid fa-list-check text-sm {{ $style['muted'] }}"></i>
                                    <span class="line-clamp-2">{{ $survey->title }}</span>
                                </h3>

                                {{-- organization name --}}
                                <p class="text-sm mb-4 flex items-center gap-2 {{ $style['muted'] }}">
                                    <i class="fa-solid fa-building text-xs opacity-80"></i>
                                    <strong class="truncate">
                                        {{ $survey->organization->name ?? 'Organisation inconnue' }}
                                    </strong>
                                </p>

                                {{-- dates block --}}
                                <div class="text-[11px] space-y-0.5 {{ $style['muted'] }}">
                                    <p class="flex items-center gap-2">
                                        <i class="fa-regular fa-calendar text-[10px] opacity-80"></i>
                                        <span>
                                            Début :
                                            <strong>
                                                {{ \Carbon\Carbon::parse($survey->start_date)->translatedFormat('d/m/Y H:i') }}
                                            </strong>
                                        </span>
                                    </p>
                                    <p class="flex items-center gap-2">
                                        <i class="fa-regular fa-clock text-[10px] opacity-80"></i>
                                        <span>
                                            Fin :
                                            <strong>
                                                {{ \Carbon\Carbon::parse($survey->end_date)->translatedFormat('d/m/Y H:i') }}
                                            </strong>
                                        </span>
                                    </p>
                                </div>

                                {{-- CTA button --}}
                                <div class="flex justify-center mt-6">
                                    <a
                                        href="{{ route('survey.show', $survey->hash_id) }}"
                                        class="relative overflow-hidden inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-medium
                                               rounded-lg text-white shadow-md transition-transform duration-150
                                               bg-gradient-to-r from-primary to-accent dark:from-primary-dark dark:to-accent-dark
                                               hover:-translate-y-[1px] active:scale-[0.97]
                                               before:absolute before:inset-0 before:-z-10
                                               before:bg-primary-noise dark:before:bg-primary-noise-dark
                                               before:bg-[length:260%_260%] before:bg-center
                                               before:opacity-0 before:transition-opacity before:duration-200
                                               hover:before:opacity-100 hover:before:animate-gradient-noise
                                               focus:outline-none focus:ring-2 focus:ring-primary"
                                    >
                                        <i class="fa-solid fa-eye text-xs"></i>
                                        <span>Voir le sondage</span>
                                    </a>
                                </div>

                            </div>
                        </div>
                    @endforeach

                </div>

            @endif

        </div>
    </div>
</x-app-layout>
