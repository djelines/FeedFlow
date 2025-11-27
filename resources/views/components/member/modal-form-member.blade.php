<div id="add-member-modal" tabindex="-1" aria-hidden="true"
     class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto bg-black/50">

    {{-- Modal wrapper --}}
    <div class="relative w-full max-w-xl">

        {{-- Modal panel --}}
        <div
            class="relative transform overflow-hidden rounded-2xl bg-surface dark:bg-surface-dark text-left shadow-2xl
                   transition-all border border-bordercolor dark:border-bordercolor-dark"
        >

            {{-- Modal header --}}
            <div class="bg-background/70 dark:bg-background-dark/60 px-4 py-3 sm:px-6 border-b border-bordercolor dark:border-bordercolor-dark flex justify-between items-center">
                <h2 class="text-lg font-semibold leading-6 text-text-primary dark:text-text-primary-dark">
                    Ajouter un membre
                </h2>

                {{-- Close icon button --}}
                <button
                    type="button"
                    data-modal-hide="add-member-modal"
                    class="inline-flex items-center justify-center w-8 h-8 rounded-full
                           text-text-secondary dark:text-text-secondary-dark
                           hover:text-primary dark:hover:text-primary-dark
                           hover:bg-primary-soft/60 dark:hover:bg-primary-soft-dark/60
                           transition"
                >
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>

            {{-- Modal body --}}
            <div class="px-4 py-4 sm:p-6">
                {{-- Add member form --}}
                <form action="{{ route('organizations.member.store') }}" method="POST" class="space-y-4">
                    @csrf

                    {{-- Email field --}}
                    <div>
                        <label for="email"
                               class="block font-medium text-sm text-text-primary dark:text-text-primary-dark mb-1">
                            Email du membre
                        </label>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            required
                            placeholder="exemple@domain.com"
                            class="block w-full rounded-lg bg-background dark:bg-background-dark border border-bordercolor dark:border-bordercolor-dark
                                   text-text-primary dark:text-text-primary-dark text-sm px-3 py-2.5
                                   transition-all duration-150
                                   hover:border-accent dark:hover:border-accent-dark
                                   focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary
                                   focus:-translate-y-[1px] focus:shadow-md
                                   placeholder:text-black/40 dark:placeholder:text-white/40"
                        >

                        @error('email')
                        <p class="text-red-500 dark:text-red-400 text-xs mt-1 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Role field --}}
                    <div>
                        <label for="role"
                               class="block font-medium text-sm text-text-primary dark:text-text-primary-dark mb-1">
                            Rôle
                        </label>
                        <div class="relative">
                            <select
                                name="role"
                                id="role"
                                required
                                class="select-base pr-9 mt-1 capitalize block w-full rounded-lg bg-background dark:bg-background-dark border border-bordercolor dark:border-bordercolor-dark
                                       text-text-primary dark:text-text-primary-dark text-sm px-3 py-2.5
                                       transition-all duration-150
                                       hover:border-accent dark:hover:border-accent-dark
                                       focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary
                                       focus:-translate-y-[1px] focus:shadow-md"
                            >
                                <option value="member">Membre</option>
                                <option value="admin">Admin</option>
                            </select>
                            <span
                                class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-text-secondary dark:text-text-secondary-dark">
                                <i class="fa-solid fa-chevron-down text-[11px]"></i>
                            </span>
                        </div>

                        @error('role')
                        <p class="text-red-500 dark:text-red-400 text-xs mt-1 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Hidden organization id --}}
                    <input type="hidden" name="organization_id" value="{{ $organization->id }}">

                    @error('user_id')
                    <p class="text-red-500 dark:text-red-400 text-xs mt-1 font-semibold">{{ $message }}</p>
                    @enderror

                    {{-- Actions: submit + cancel --}}
                    <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">

                        {{-- Submit button --}}
                        <button
                            type="submit"
                            class="relative overflow-hidden inline-flex w-full justify-center px-4 py-2.5 text-sm font-medium
                                   rounded-lg text-white shadow-md transition-transform duration-150 sm:col-start-2
                                   bg-gradient-to-r from-primary to-accent dark:from-primary-dark dark:to-accent-dark
                                   hover:-translate-y-[1px]
                                   before:absolute before:inset-0 before:-z-10
                                   before:bg-primary-noise dark:before:bg-primary-noise-dark
                                   before:bg-[length:260%_260%] before:bg-center
                                   before:opacity-0 before:transition-opacity before:duration-200
                                   hover:before:opacity-100 hover:before:animate-gradient-noise
                                   focus:outline-none focus:ring-2 focus:ring-primary"
                        >
                            <i class="fas fa-paper-plane text-xs mr-2"></i>
                            <span>Ajouter ce membre</span>
                        </button>

                        {{-- Cancel button --}}
                        <button
                            type="button"
                            data-modal-hide="add-member-modal"
                            class="mt-3 inline-flex w-full justify-center rounded-lg bg-surface dark:bg-surface-dark px-4 py-2.5 text-sm font-medium
                                   text-text-primary dark:text-text-primary-dark shadow-sm border border-bordercolor/80 dark:border-bordercolor-dark/80
                                   transition-all duration-150 sm:col-start-1 sm:mt-0
                                   hover:bg-primary-soft dark:hover:bg-primary-soft-dark
                                   hover:text-text-primary dark:hover:text-text-primary-dark
                                   focus:outline-none focus:ring-2 focus:ring-primary"
                        >
                            Annuler
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
