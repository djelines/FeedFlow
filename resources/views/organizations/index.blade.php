<x-app-layout>

    <div class="max-w-7xl pt-10 mx-auto px-8 space-y-8">

        {{-- Page title --}}
        <h1
            class="flex items-center justify-between gap-3
                       text-3xl font-bold text-text-primary dark:text-text-primary-dark tracking-tight
                       border-b-2 border-bordercolor dark:border-bordercolor-dark pb-3 mb-10"
        >
            <span>Mes Organisations :</span>

            @if($organizations->count() > 0)
                <span
                    class="px-2.5 py-0.5 rounded-full text-xs font-medium
                               bg-indigo-100 text-indigo-800
                               dark:bg-indigo-900 dark:text-indigo-200"
                >
                        {{ $organizations->count() }} organisations
                    </span>
            @endif
        </h1>

        {{-- Create new organization --}}
        <div class="bg-surface dark:bg-surface-dark shadow-sm border border-bordercolor dark:border-bordercolor-dark rounded-xl p-6">
            <h2 class="font-semibold text-xl mb-4 text-text-primary dark:text-text-primary-dark flex items-center">
                <i class="fas fa-plus-circle h-5 w-5 mr-3 text-primary dark:text-primary-dark"></i>
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

                {{-- ANIMATED BORDER--}}
                <div
                    class="relative rounded-2xl px-[2px] py-[6px]
                           bg-primary-noise dark:bg-primary-noise-dark
                           bg-[length:260%_260%] bg-center animate-gradient-noise
                           transition-all duration-300
                           hover:-translate-y-[4px] hover:shadow-xl"
                >
                    {{-- CARD --}}
                    <div
                        class="rounded-xl p-5
                               bg-surface dark:bg-surface-dark
                               border border-bordercolor/70 dark:border-bordercolor-dark/70
                               shadow-sm transition-all duration-300"
                    >
                        {{-- TITLE LINK --}}
                        <a
                            href="{{ route('organizations.viewOrganization', $organization->hash_id) }}"
                            class="block border-b border-bordercolor/50 dark:border-bordercolor-dark/50 pb-3 mb-3
                                   text-text-primary dark:text-text-primary-dark
                                   hover:text-primary dark:hover:text-primary-dark transition"
                        >
                            <div class="flex justify-between items-start">
                                <h2 class="font-semibold text-lg leading-tight">
                                    {{ $organization->name }}
                                </h2>

                                <span
                                    class="p-1 rounded-full text-primary flex-shrink-0 flex items-center justify-center
                                           bg-primary-soft/40 dark:bg-primary-soft-dark/40 w-6"
                                >
                            <i class="fas fa-arrow-right text-xs"></i>
                        </span>
                        
                            </div>
                        </a>
                        

                        {{-- EDIT --}}
                        @can('update', $organization)
                            <div class="pt-2">

                                <h3 class="text-sm font-semibold mb-2 text-text-secondary dark:text-text-secondary-dark flex items-center gap-1">
                                    <i class="fas fa-edit text-primary text-xs"></i>
                                    Modifier le nom
                                </h3>

                                <div class="mb-3">
                                    <input
                                        type="text"
                                        name="name"
                                        form="org-update-{{ $organization->id }}"
                                        value="{{ $organization->name }}"
                                        required
                                        class="w-full text-sm bg-background dark:bg-background-dark
                                               border border-bordercolor dark:border-bordercolor-dark
                                               rounded-lg px-3 py-2 text-text-primary dark:text-text-primary-dark
                                               shadow-inner transition
                                               hover:border-accent dark:hover:border-accent-dark
                                               focus:ring-2 focus:ring-primary focus:border-primary"
                                    >
                                </div>

                                {{-- BUTTONS ROW --}}
                                <div class="flex items-center gap-2 border-t border-bordercolor/50 dark:border-bordercolor-dark/50 pt-5">

                                    {{-- DELETE ICONNN --}}
                                    @can('delete', $organization)
                                        <form
                                            method="POST"
                                            action="{{ route('organizations.delete', $organization->hash_id) }}"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                title="Supprimer"
                                                class="h-9 w-9 flex items-center justify-center
                                                       rounded-lg text-red-500 hover:text-red-400
                                                       bg-red-500/10 hover:bg-red-500/20
                                                       transition-all duration-150 shadow-sm
                                                       hover:-translate-y-[1px] active:scale-[0.97]"
                                            >
                                                <i class="fas fa-trash text-[12px]"></i>
                                            </button>
                                        </form>
                                    @endcan

                                    {{-- SAVE --}}
                                    <form
                                        id="org-update-{{ $organization->id }}"
                                        method="POST"
                                        action="{{ route('organizations.update', $organization->hash_id) }}"
                                        class="flex-1"
                                    >
                                        @csrf
                                        @method('PUT')

                                        <button
                                            type="submit"
                                            class="relative overflow-hidden w-full px-3 py-2 text-xs font-semibold
                                                   rounded-lg text-white shadow-sm
                                                   inline-flex items-center justify-center gap-1
                                                   bg-gradient-to-r from-primary to-accent
                                                   dark:from-primary-dark dark:to-accent-dark
                                                   transition-all duration-150
                                                   hover:-translate-y-[1px] active:scale-[0.97]
                                                   before:absolute before:inset-0 before:-z-10
                                                   before:bg-primary-noise dark:before:bg-primary-noise-dark
                                                   before:bg-[length:260%_260%] before:bg-center
                                                   hover:before:opacity-100 hover:before:animate-gradient-noise"
                                        >
                                            <i class="fas fa-save text-[11px]"></i>
                                            <span>Enregistrer</span>
                                        </button>
                                    </form>

                                </div>
                            </div>
                        @endcan

                    </div>
                </div>

            @empty
                <div class="col-span-full text-center text-text-secondary dark:text-text-secondary-dark
                            p-10 bg-surface dark:bg-surface-dark rounded-xl shadow-sm
                            border border-bordercolor dark:border-bordercolor-dark">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    Aucune organisation trouvée.
                </div>
            @endforelse

        </div>



    </div>

</x-app-layout>
