<x-app-layout>

    <div class="max-w-7xl py-10 mx-auto px-8 space-y-8">

        {{-- Workspace header --}}
        <div
            class="bg-surface dark:bg-surface-dark rounded-xl shadow-sm border border-bordercolor dark:border-bordercolor-dark p-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 ">
                <div class="flex-1">
                    <div
                        class="flex items-center gap-2 text-xs font-semibold text-text-secondary dark:text-text-secondary-dark uppercase tracking-wide mb-2">
                        <i class="fa-solid fa-briefcase text-[13px]"></i>
                        <span>Aperçu de l'organisation</span>
                        <i class="fa-solid fa-chevron-right text-[11px] opacity-70"></i>

                        {{-- Plan badge --}}
                        <a href="/organizations/plan/{{ $organization->hash_id }}"
                            class="text-[10px] flex items-center gap-1.5 px-2 py-0.5 rounded border transition-all hover:scale-105 active:scale-95 cursor-pointer
                            {{ $organization->plan === 'free'
    ? 'bg-background dark:bg-background-dark text-text-secondary dark:text-text-secondary-dark border-bordercolor dark:border-bordercolor-dark hover:bg-background/80'
    : 'bg-gradient-to-r from-primary to-accent text-white border-transparent shadow-sm' }}">
                            @if ($organization->plan === 'free')
                                <i class="fa-solid fa-bolt text-[10px]"></i>
                                GRATUIT
                                <span class="opacity-70 border-l border-white/20 pl-1.5 ml-0.5">Mettre à niveau</span>
                            @else
                                <i class="fa-solid fa-crown text-[10px]"></i>
                                PREMIUM
                                <span class="opacity-70 border-l border-white/20 pl-1.5 ml-0.5">Gérer</span>
                            @endif
                        </a>
                    </div>
                    <h1 class="text-3xl font-bold text-text-primary dark:text-text-primary-dark tracking-tight">
                        <i class="fas fa-sitemap mr-3 text-primary"></i>
                        {{ $organization->name }}
                    </h1>
                    <p
                        class="text-sm font-semibold text-text-secondary dark:text-text-secondary-dark mt-3 pt-3 border-t border-bordercolor/60 dark:border-bordercolor-dark/60">
                        Détails de l'Organisation
                    </p>
                </div>
            </div>

            {{-- Error alert --}}
            @if (session('error'))
                <div class="bg-red-50 dark:bg-red-900/20 border border-red-300 dark:border-red-500/60 text-red-700 dark:text-red-200 px-4 py-3 rounded-lg"
                    role="alert">
                    <strong class="font-semibold">Oups !</strong>
                    <span class="block sm:inline ml-1">{{ session('error') }}</span>
                </div>
            @endif
        </div>

        {{-- Members list card --}}
        <div class="bg-surface dark:bg-surface-dark shadow-sm border border-bordercolor dark:border-bordercolor-dark rounded-xl p-6">

            <div class="flex items-center justify-between mb-4">
                <h2 class="text-2xl font-semibold text-text-primary dark:text-text-primary-dark flex items-center">
                    <i class="fas fa-users mr-3 text-primary"></i>
                    Liste des membres
                </h2>

                @can('createMember', $organization)
                    <button
                        data-modal-target="add-member-modal"
                        data-modal-toggle="add-member-modal"
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
                        <i class="fas fa-user-plus text-xs mr-2"></i>
                        <span>Ajouter un membre</span>
                    </button>
                @endcan
            </div>

            <div
                class="overflow-x-auto rounded-lg border border-bordercolor/80 dark:border-bordercolor-dark/80 bg-background dark:bg-background-dark">
                <table class="min-w-full text-left border-collapse">
                    <thead
                        class="bg-background/80 dark:bg-background-dark/80 border-b border-bordercolor dark:border-bordercolor-dark">
                        <tr>
                            <th
                                class="py-3 px-4 text-xs font-semibold text-text-secondary dark:text-text-secondary-dark uppercase tracking-wide">
                                Nom</th>
                            <th
                                class="py-3 px-4 text-xs font-semibold text-text-secondary dark:text-text-secondary-dark uppercase tracking-wide">
                                Email</th>
                            <th
                                class="py-3 px-4 text-xs font-semibold text-text-secondary dark:text-text-secondary-dark uppercase tracking-wide">
                                Rôle</th>
                            <th
                                class="py-3 px-4 text-xs font-semibold text-text-secondary dark:text-text-secondary-dark uppercase tracking-wide">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($organization->members as $member)
                            <tr
                                class="border-b border-bordercolor/70 dark:border-bordercolor-dark/70 last:border-b-0 hover:bg-primary-soft/30 dark:hover:bg-primary-soft-dark/20 transition duration-150">
                                <td class="py-3 px-4 text-sm text-text-primary dark:text-text-primary-dark">
                                    {{ $member->oneUser->getFullName() }}
                                </td>
                                <td class="py-3 px-4 text-sm text-text-secondary dark:text-text-secondary-dark">
                                    {{ $member->oneUser->email }}
                                </td>
                                <td class="py-3 px-4 text-sm capitalize">
                                    <span class="px-2 py-0.5 rounded-full text-xs font-semibold
                                        @if($member->role === 'admin')
                                            bg-primary-soft text-primary
                                        @else
                                            bg-background dark:bg-background-dark text-text-secondary dark:text-text-secondary-dark
                                        @endif">
                                        {{ $member->role }}
                                    </span>
                                </td>

                                @can('deleteMember', [$organization, \App\Models\User::find($member->user_id)])
                                    <td class="py-3 px-4">
                                        <form action="{{ route('organizations.member.delete', $member->hash_id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium
                                                           text-red-500 hover:text-red-400
                                                           bg-red-500/5 hover:bg-red-500/10
                                                           shadow-sm transition-all duration-150">
                                                <i class="fas fa-trash-alt text-[11px]"></i>
                                                <span>Supprimer</span>
                                            </button>
                                        </form>
                                    </td>
                                @endcan

                            </tr>
                        @empty
                            <tr>
                                <td colspan="4"
                                    class="py-4 px-4 text-center text-text-secondary dark:text-text-secondary-dark bg-background dark:bg-background-dark">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    Aucun membre pour cette organisation.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Organization surveys list --}}
        <div class="space-y-4">
            <div class="flex items-center justify-between gap-3">
                <h2 class="text-2xl font-semibold text-text-primary dark:text-text-primary-dark">
                    Sondages de l'Organisation
                </h2>

                <div class="flex items-center gap-3">
                    @if($surveys->count() > 0)
                        <span
                            class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200">
                            {{ $surveys->count() }} sondages
                        </span>
                    @endif

                    <button
                        data-modal-target="create-survey-modal"
                        data-modal-toggle="create-survey-modal"
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
                        <i class="fa-solid fa-plus text-xs mr-2"></i>
                        <span>Créer un sondage</span>
                    </button>
                </div>
            </div>


            {{-- Full-width survey list --}}
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                @forelse($surveys as $survey)
                    <div class="relative rounded-2xl px-[2px] py-[6px]
                                   bg-primary-noise dark:bg-primary-noise-dark
                                   bg-[length:260%_260%] bg-center animate-gradient-noise
                                   transition-all duration-300 cursor-pointer
                                   hover:-translate-y-[4px] hover:shadow-xl"
                        onclick="window.location='{{ route('survey.show', $survey->hash_id) }}'">
                        {{-- CARD --}}
                        <div class="rounded-xl p-6
                                       bg-surface dark:bg-surface-dark
                                       border border-bordercolor/70 dark:border-bordercolor-dark/70
                                       shadow-sm transition-all duration-300 flex flex-col justify-between">
                            <div class="space-y-4">
                                <div
                                    class="flex justify-between items-start border-b border-bordercolor/70 dark:border-bordercolor-dark/70 pb-3">
                                    <h3 class="text-lg font-semibold text-text-primary dark:text-text-primary-dark">
                                        {{ $survey->title }}
                                    </h3>

                                    {{-- Delete survey --}}
                                    <form action="{{ route('surveys.destroy', $survey->hash_id) }}" method="POST"
                                        onclick="event.stopPropagation()"
                                        onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce sondage ? Cette action est irréversible.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Supprimer le sondage" class="inline-flex items-center justify-center p-2 rounded-full
                                                       text-red-500 hover:text-red-400
                                                       hover:bg-red-500/10 transition duration-150 text-sm">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>

                                <div>
                                    <p class="text-xs font-semibold text-text-secondary dark:text-text-secondary-dark mb-1">
                                        Description du sondage :
                                    </p>
                                    <p
                                        class="text-sm text-text-primary dark:text-text-primary-dark leading-relaxed line-clamp-3">
                                        {{ Str::limit($survey->description, 150) }}
                                    </p>
                                </div>

                                {{-- Dates --}}
                                <div
                                    class="mt-3 pt-3 border-t border-bordercolor/60 dark:border-bordercolor-dark/60 text-xs text-text-secondary dark:text-text-secondary-dark flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
                                    <div class="flex items-center gap-2">
                                        <i class="fa-regular fa-calendar text-[11px]"></i>
                                        <span>
                                            Début :
                                            <span class="font-medium text-text-primary dark:text-text-primary-dark">
                                                {{ \Carbon\Carbon::parse($survey->start_date)->format('d/m/Y H:i') }}
                                            </span>
                                        </span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-flag-checkered text-[11px]"></i>
                                        <span>
                                            Fin :
                                            <span class="font-medium text-text-primary dark:text-text-primary-dark">
                                                {{ \Carbon\Carbon::parse($survey->end_date)->format('d/m/Y H:i') }}
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @empty
                    <div
                        class="p-6 text-center bg-surface dark:bg-surface-dark rounded-xl shadow-sm border border-bordercolor dark:border-bordercolor-dark md:col-span-2 xl:col-span-3">
                        <p class="text-text-secondary dark:text-text-secondary-dark italic">
                            Aucun sondage n'a été trouvé pour cette organisation.
                        </p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>

    {{-- Include modals !--}}
    @include('components.member.modal-form-member', ['organization' => $organization])
    @include('components.survey.modal-form-survey', ['organization' => $organization])

</x-app-layout>
