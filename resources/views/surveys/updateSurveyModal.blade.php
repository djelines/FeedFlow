@php
    $showUpdateModal = $errors->any() && old('form') === 'update_survey';
@endphp
<div
    id="modalUpdate"
    tabindex="-1"
    aria-hidden="true"
    class="hidden fixed inset-0 z-50 overflow-y-auto overflow-x-hidden bg-background-dark/80 backdrop-blur-sm flex justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full"
>
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div
            class="relative rounded-2xl bg-surface dark:bg-surface-dark shadow-2xl border border-bordercolor dark:border-bordercolor-dark overflow-hidden"
        >
            {{-- Header --}}
            <div
                class="flex items-center justify-between px-4 py-3 md:px-5 border-b border-bordercolor dark:border-bordercolor-dark
                       bg-background/70 dark:bg-background-dark/60"
            >
                <h3 class="text-lg font-semibold text-text-primary dark:text-text-primary-dark">
                    Éditer le sondage
                </h3>
                <button
                    type="button"
                    data-modal-hide="modalUpdate"
                    class="inline-flex items-center justify-center w-8 h-8 rounded-full
                           text-text-secondary dark:text-text-secondary-dark
                           hover:text-primary dark:hover:text-primary-dark
                           hover:bg-primary-soft/60 dark:hover:bg-primary-soft-dark/60
                           transition"
                >
                    <i class="fa-solid fa-xmark text-lg"></i>
                    <span class="sr-only">Fermer</span>
                </button>
            </div>

            {{-- Body --}}
            <form action="{{ route('surveys.update',$survey->hash_id) }}" class="p-4 md:p-5" method="POST">
                @csrf
                @method("put")

                {{-- Title --}}
                <div class="mb-5">
                    <label for="title" class="block text-sm font-medium text-text-primary dark:text-text-primary-dark mb-1">
                        Titre du sondage
                    </label>
                    <input
                        type="text"
                        name="title"
                        id="title"
                        value="{{ old('title', $survey->title) }}"
                        required
                        class="mt-1 block w-full rounded-lg bg-background dark:bg-background-dark
                               border border-bordercolor dark:border-bordercolor-dark
                               shadow-sm px-3 py-2.5 text-sm
                               text-text-primary dark:text-text-primary-dark
                               transition-all duration-150
                               hover:border-accent dark:hover:border-accent-dark
                               focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary
                               focus:-translate-y-[1px] focus:shadow-md"
                    >
                    @error('title')
                    <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Description --}}
                <div>
                    <label for="description" class="block text-sm font-medium text-text-primary dark:text-text-primary-dark mb-1">
                        Description
                    </label>
                    <textarea
                        name="description"
                        id="description"
                        rows="3"
                        required
                        class="mt-1 block w-full rounded-lg bg-background dark:bg-background-dark
                               border border-bordercolor dark:border-bordercolor-dark
                               shadow-sm px-3 py-2.5 text-sm
                               text-text-primary dark:text-text-primary-dark
                               transition-all duration-150
                               hover:border-accent dark:hover:border-accent-dark
                               focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary
                               focus:-translate-y-[1px] focus:shadow-md"
                    >{{ old('description', $survey->description) }}</textarea>
                    @error('description')
                    <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Actions --}}
                <div class="mt-6 sm:grid sm:grid-cols-2 sm:gap-3">
                    {{-- Cancel --}}
                    <button
                        data-modal-hide="modalUpdate"
                        type="button"
                        class="w-full justify-center inline-flex items-center rounded-lg px-5 py-2.5 text-sm font-medium
                               bg-surface dark:bg-surface-dark
                               text-text-primary dark:text-text-primary-dark
                               border border-bordercolor/80 dark:border-bordercolor-dark/80
                               shadow-sm transition-all duration-150
                               hover:bg-primary-soft dark:hover:bg-primary-soft-dark
                               hover:text-text-primary dark:hover:text-text-primary-dark
                               focus:outline-none focus:ring-2 focus:ring-primary"
                    >
                        Annuler
                    </button>

                    {{-- Save --}}
                    <button
                        type="submit"
                        class="mt-3 sm:mt-0 w-full justify-center inline-flex items-center gap-2 text-sm font-semibold
                               rounded-lg px-5 py-2.5 text-white shadow-md
                               relative overflow-hidden
                               bg-gradient-to-r from-primary to-accent dark:from-primary-dark dark:to-accent-dark
                               transition-transform duration-150
                               hover:-translate-y-[1px] active:scale-[0.97]
                               before:absolute before:inset-0 before:-z-10
                               before:bg-primary-noise dark:before:bg-primary-noise-dark
                               before:bg-[length:260%_260%] before:bg-center
                               before:opacity-0 before:transition-opacity before:duration-200
                               hover:before:opacity-100 hover:before:animate-gradient-noise
                               focus:outline-none focus:ring-2 focus:ring-primary"
                    >
                        <span>Sauvegarder</span>
                    </button>
                </div>
                <input type="hidden" name="form" value="update_survey">
            </form>
        </div>
    </div>
</div>

@if ($errors->any() && old('form') === 'update_survey')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('modalUpdate');
        modal.classList.add('!transition-none');
        modal.classList.remove('hidden');
        requestAnimationFrame(() => {
            modal.classList.remove('!transition-none');
        });
    });
</script>
@endif

