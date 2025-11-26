<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight flex items-center gap-3">
            <i class="fa-solid fa-square-poll-horizontal text-indigo-600"></i>
            Mes sondages
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if($surveys->isEmpty())
                <div class="text-center py-20 text-gray-500 text-xl">
                    <i class="fa-solid fa-circle-exclamation text-4xl mb-4 text-gray-400"></i><br>
                    Aucun sondage trouvé.
                </div>
            @else

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8"> {{-- Augmentation du gap ici --}}

                    @foreach ($surveys as $survey)
                        @php
                            // Couleurs de fond de type Post-it avec de bonnes associations
                            $postit_styles = [
                                ['bg-yellow-200', 'text-yellow-800', 'text-yellow-700'], // Jaune classique
                                ['bg-pink-200', 'text-pink-800', 'text-pink-700'],       // Rose doux
                                ['bg-green-200', 'text-green-800', 'text-green-700'],    // Vert menthe
                                ['bg-blue-200', 'text-blue-800', 'text-blue-700'],       // Bleu ciel
                                ['bg-purple-200', 'text-purple-800', 'text-purple-700'], // Mauve
                            ];
                            $chosen_style = $postit_styles[array_rand($postit_styles)];
                            $background_color = $chosen_style[0];
                            $text_color_strong = $chosen_style[1];
                            $text_color_normal = $chosen_style[2];

                            // Rotation aléatoire légèrement plus variée pour l'effet Post-it
                            $rotations = ['rotate-1', '-rotate-1', 'rotate-2', '-rotate-2', 'rotate-0', 'rotate-3', '-rotate-3'];
                            $rotation = $rotations[array_rand($rotations)];

                            // Ombre plus prononcée pour l'effet "soulevé"
                            $shadow_class = 'shadow-lg'; // Plus prononcée que shadow-md
                        @endphp

                        <div class="transform transition-all duration-300 hover:scale-[1.02] hover:-translate-y-1">
                            <div class="{{ $background_color }} {{ $shadow_class }} rounded-md p-6 {{ $rotation }} transition-all duration-300 hover:shadow-xl"
                                 style="box-shadow: 4px 4px 0px rgba(0, 0, 0, 0.2);"> {{-- Ombre personnalisée pour le look Post-it --}}

                                <h3 class="text-xl font-bold {{ $text_color_strong }} mb-3 flex items-center gap-2">
                                    <i class="fa-solid fa-list-check {{ $text_color_normal }}"></i>
                                    {{ $survey->title }}
                                </h3>

                                <p class="text-sm {{ $text_color_normal }} mb-6 flex items-center gap-2">
                                    <i class="fa-solid fa-building {{ $text_color_normal }}"></i>
                                    <strong>{{ $survey->organization->name }}</strong>
                                </p>

                                <div class="flex justify-center">
                                    <a href="{{ route('survey.show', $survey->id) }}"
                                       class="inline-flex items-center gap-2 px-5 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition-all">
                                        <i class="fa-solid fa-eye"></i>
                                        Voir le sondage
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
