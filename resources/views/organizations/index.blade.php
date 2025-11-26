<x-app-layout>

    <div class="max-w-7xl pt-10 mx-auto px-8 space-y-8">

        {{-- Page title --}}
        <h1
            class="text-3xl font-bold text-text-primary dark:text-text-primary-dark tracking-tight
                   border-b-2 border-bordercolor dark:border-bordercolor-dark pb-3"
        >
            Mes Organisations :
        </h1>

        {{-- Create new organization --}}
        <div class="bg-surface dark:bg-surface-dark shadow-sm border border-bordercolor dark:border-bordercolor-dark rounded-xl p-6">
            <h2 class="font-semibold text-xl mb-4 text-text-primary dark:text-text-primary-dark flex items-center">
                <i class="fas fa-plus-circle h-5 w-5 mr-3 text-emerald-500"></i>
                Créer une nouvelle organisation
            </h2>

            <form
                method="POST"
                action="{{ route('organizations.store') }}"
                class="flex flex-col sm:flex-row sm:space-x-3 space-y-3 sm:space-y-0 items-end"
            >
                @csrf

                <div class="flex-grow w-full">
                    <label
                        for="name_create"
                        class="block text-sm font-medium text-text-secondary dark:text-text-secondary-dark mb-1"
                    >
                        Nom de l'organisation
                    </label>
                    <input
                        type="text"
                        id="name_create"
                        name="name"
                        required
                        placeholder="Ma super organisation !"
                        class="w-full bg-background dark:bg-background-dark border border-bordercolor dark:border-bordercolor-dark
                               rounded-lg shadow-sm px-3 py-2.5 text-sm text-text-primary dark:text-text-primary-dark
                               transition-all duration-150
                               hover:border-accent dark:hover:border-accent-dark
                               focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary
                               focus:-translate-y-[1px] focus:shadow-md
                               placeholder:text-black/40
                               dark:placeholder:text-white/40"
                    >
                </div>

                <button
                    type="submit"
                    class="relative overflow-hidden w-full sm:w-auto px-4 py-2.5 text-sm font-medium
                           rounded-lg text-white shadow-md inline-flex items-center justify-center space-x-2
                           bg-gradient-to-r from-primary to-accent dark:from-primary-dark dark:to-accent-dark
                           hover:-translate-y-[1px] active:scale-[0.97]
                           before:absolute before:inset-0 before:-z-10
                           before:bg-primary-noise dark:before:bg-primary-noise-dark
                           before:bg-[length:260%_260%] before:bg-center
                           before:opacity-0 before:transition-opacity before:duration-200
                           hover:before:opacity-100 hover:before:animate-gradient-noise
                           focus:outline-none focus:ring-2 focus:ring-primary"
                >
                    <i class="fas fa-plus text-xs"></i>
                    <span>Créer</span>
                </button>
            </form>
        </div>

        {{-- Organizations grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

            @forelse($organizations as $organization)
                <div
                    class="organization-card relative bg-surface dark:bg-surface-dark shadow-sm
                           border-l-4 border-primary rounded-xl p-5
                           border border-bordercolor/80 dark:border-bordercolor-dark/80
                           hover:shadow-xl hover:-translate-y-[2px]
                           transition duration-300"
                >
                    {{-- Card header: title + link --}}
                    <a
                        href="{{ route('organizations.viewOrganization', $organization->id) }}"
                        class="block border-b border-bordercolor/60 dark:border-bordercolor-dark/60 pb-3 mb-3
                               text-text-primary dark:text-text-primary-dark hover:text-primary dark:hover:text-primary-dark
                               transition-colors duration-150"
                    >
                        <div class="flex justify-between items-start">
                            <h2 class="font-semibold text-lg leading-tight">
                                {{ $organization->name }}
                            </h2>
                            <span
                                class="p-1 rounded-full text-primary flex-shrink-0 flex items-center justify-center
                                       bg-primary-soft/40 dark:bg-primary-soft-dark/40"
                            >
                                <i class="fas fa-arrow-right text-xs"></i>
                            </span>
                        </div>
                    </a>

                    @can('update', $organization)
                        {{-- Edit organization name --}}
                        <div class="pt-2 border-b border-bordercolor/60 dark:border-bordercolor-dark/60 pb-4 mb-4">
                            <form method="POST" action="{{ route('organizations.update', $organization) }}">
                                @method('PUT')
                                @csrf

                                <h3 class="text-sm font-semibold mb-2 text-text-secondary dark:text-text-secondary-dark flex items-center space-x-1">
                                    <i class="fas fa-edit text-primary text-xs"></i>
                                    <span>Modifier le nom</span>
                                </h3>

                                <div class="mb-3">
                                    <label for="name_{{ $organization->id }}" class="sr-only">
                                        Nom de l'organisation
                                    </label>
                                    <input
                                        type="text"
                                        id="name_{{ $organization->id }}"
                                        name="name"
                                        value="{{ $organization->name }}"
                                        required
                                        class="w-full text-sm bg-background dark:bg-background-dark
                                               border border-bordercolor dark:border-bordercolor-dark
                                               rounded-lg px-3 py-2 text-text-primary dark:text-text-primary-dark
                                               shadow-inner transition-all duration-150
                                               hover:border-accent dark:hover:border-accent-dark
                                               focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary"
                                    >
                                </div>

                                <button
                                    type="submit"
                                    class="relative overflow-hidden w-full px-3 py-2 text-xs font-semibold
                                           rounded-lg text-white shadow-sm inline-flex items-center justify-center space-x-1
                                           bg-gradient-to-r from-primary to-accent dark:from-primary-dark dark:to-accent-dark
                                           hover:-translate-y-[1px] active:scale-[0.97]
                                           before:absolute before:inset-0 before:-z-10
                                           before:bg-primary-noise dark:before:bg-primary-noise-dark
                                           before:bg-[length:260%_260%] before:bg-center
                                           before:opacity-0 before:transition-opacity before:duration-200
                                           hover:before:opacity-100 hover:before:animate-gradient-noise
                                           focus:outline-none focus:ring-2 focus:ring-primary"
                                >
                                    <i class="fas fa-save text-[11px]"></i>
                                    <span>Enregistrer la modification</span>
                                </button>
                            </form>
                        </div>
                    @endcan

                    @can('delete', $organization)
                        {{-- Delete organization --}}
                        <div class="">
                            <form method="POST" action="{{ route('organizations.delete', $organization->id) }}">
                                @method('DELETE')
                                @csrf
                                <button
                                    type="submit"
                                    class="w-full py-1.5 rounded-lg text-xs font-semibold
                                           inline-flex items-center justify-center space-x-1
                                           text-red-500 hover:text-red-400
                                           bg-red-500/10 hover:bg-red-500/15
                                           shadow-sm transition-all duration-150"
                                >
                                    <i class="fas fa-trash-alt text-[11px]"></i>
                                    <span>Supprimer l'organisation</span>
                                </button>
                            </form>
                        </div>
                    @endcan

                </div>
            @empty
                <div
                    class="col-span-full text-lg text-text-secondary dark:text-text-secondary-dark
                           p-10 bg-surface dark:bg-surface-dark rounded-xl shadow-sm
                           border border-bordercolor dark:border-bordercolor-dark"
                >
                    <p class="text-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        Aucune organisation trouvée. Créez-en une pour commencer !
                    </p>
                </div>
            @endforelse
        </div>

    </div>

</x-app-layout>
