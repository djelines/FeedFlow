<div id="add-member-modal" tabindex="-1" aria-hidden="true"
     class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto bg-black/50">

    <div class="relative w-full max-w-xl">

        <div class="bg-surface dark:bg-surface-soft-dark border border-t-4 border-accent dark:border-accent-dark rounded-2xl shadow-2xl p-6 relative">
            <button
                type="button"
                data-modal-hide="add-member-modal"
                class="absolute top-3 right-3 text-gray-600 hover:text-gray-900 dark:text-gray-400 text-xl"
            >
                ✕
            </button>
            <h2 class="text-lg font-semibold mb-4 text-text-primary dark:text-text-primary-dark">
                Ajouter un membre
            </h2>
            <form action="{{ route('organizations.member.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="email"
                        class="block font-medium text-sm text-text-primary dark:text-text-primary-dark mb-1">
                        Email du membre
                    </label>
                    <input type="email" name="email" id="email" required placeholder="exemple@domain.com" class="mt-1 block w-full bg-background dark:bg-background-dark border border-bordercolor dark:border-bordercolor-dark
                                rounded-lg shadow-sm px-3 py-2.5 text-sm text-text-primary dark:text-text-primary-dark
                                transition-all duration-150
                                hover:border-accent dark:hover:border-accent-dark
                                focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary
                                focus:-translate-y-[1px] focus:shadow-md">

                    @error('email')
                        <p class="text-red-500 dark:text-red-400 text-xs mt-1 font-semibold">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="role"
                        class="block font-medium text-sm text-text-primary dark:text-text-primary-dark mb-1">
                        Rôle
                    </label>
                    <div class="relative">
                        <select name="role" id="role" required class="select-base pr-9 mt-1 capitalize">
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

                <input type="hidden" name="organization_id" value="{{ $organization->id }}">

                @error('user_id')
                    <p class="text-red-500 dark:text-red-400 text-xs mt-1 font-semibold">{{ $message }}</p>
                @enderror

                <button type="submit" class="relative overflow-hidden inline-flex items-center justify-center w-full px-4 py-2.5 text-sm font-medium
                                rounded-lg text-white shadow-md transition-transform duration-150
                                bg-gradient-to-r from-emerald-500 to-emerald-600
                                hover:-translate-y-[1px]
                                before:absolute before:inset-0 before:-z-10
                                before:bg-primary-noise dark:before:bg-primary-noise-dark
                                before:bg-[length:260%_260%] before:bg-center
                                before:opacity-0 before:transition-opacity before:duration-200
                                hover:before:opacity-100 hover:before:animate-gradient-noise
                                focus:outline-none focus:ring-2 focus:ring-primary">
                    <i class="fas fa-paper-plane text-xs mr-2"></i>
                    <span>Ajouter ce membre</span>
                </button>
            </form>

        </div>
    </div>
</div>
