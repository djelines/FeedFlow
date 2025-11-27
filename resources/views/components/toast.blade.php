<div class="fixed top-5 right-4 z-[60] flex flex-col gap-4 w-full max-w-sm">

    @if (session('success'))
        <div
            id="toast-success"
            x-data="{ show: false }"
            x-init="
                    setTimeout(() => { show = true }, 50);   // déclenche l'animation d'entrée
                    setTimeout(() => { show = false }, 2050); // auto close après 2s d'affichage
                    "
            x-show="show"
            x-cloak
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-90 translate-y-2"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-90 translate-y-2"
            class="flex items-center w-full p-4
                   bg-surface dark:bg-surface-dark
                   text-text-primary dark:text-text-primary-dark
                   rounded-xl shadow-lg border border-bordercolor dark:border-bordercolor-dark"
            role="alert"
        >
            {{-- Icon --}}
            <div
                class="inline-flex items-center justify-center shrink-0 w-7 h-7
                       rounded-full bg-emerald-100 text-emerald-600
                       dark:bg-emerald-500/15 dark:text-emerald-300"
            >
                <i class="fa-solid fa-circle-check text-sm"></i>
                <span class="sr-only">Success icon</span>
            </div>

            {{-- Message --}}
            <div class="ms-3 text-sm font-normal">
                {{ session('success') }}
            </div>

            {{-- Close --}}
            <button
                @click="show = false"
                type="button"
                class="ms-auto flex items-center justify-center h-8 w-8 rounded-full
                       text-text-secondary dark:text-text-secondary-dark
                       border border-transparent
                       hover:bg-primary-soft dark:hover:bg-primary-soft-dark
                       hover:text-text-primary dark:hover:text-text-primary-dark
                       focus:outline-none focus:ring-2 focus:ring-primary
                       transition"
                aria-label="Close"
            >
                <span class="sr-only">Close</span>
                <i class="fa-solid fa-xmark text-sm"></i>
            </button>
        </div>

    @elseif (session('error'))
        <div
            id="toast-danger"
            x-data="{ show: true }"
            x-show="show"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90"
            x-init="setTimeout(() => show = false, 2000)"
            class="flex items-center w-full p-4
                   bg-surface dark:bg-surface-dark
                   text-text-primary dark:text-text-primary-dark
                   rounded-xl shadow-lg border border-bordercolor dark:border-bordercolor-dark"
            role="alert"
        >
            {{-- Icon --}}
            <div
                class="inline-flex items-center justify-center shrink-0 w-7 h-7
                       rounded-full bg-red-100 text-red-600
                       dark:bg-red-500/15 dark:text-red-300"
            >
                <i class="fa-solid fa-circle-xmark text-sm"></i>
                <span class="sr-only">Error icon</span>
            </div>

            {{-- Message --}}
            <div class="ms-3 text-sm font-normal">
                {{ session('error') }}
            </div>

            {{-- Close --}}
            <button
                type="button"
                @click="show = false"
                class="ms-auto flex items-center justify-center h-8 w-8 rounded-full
                       text-text-secondary dark:text-text-secondary-dark
                       border border-transparent
                       hover:bg-primary-soft dark:hover:bg-primary-soft-dark
                       hover:text-text-primary dark:hover:text-text-primary-dark
                       focus:outline-none focus:ring-2 focus:ring-primary
                       transition"
                aria-label="Close"
            >
                <span class="sr-only">Close</span>
                <i class="fa-solid fa-xmark text-sm"></i>
            </button>
        </div>

    @elseif (session('warning'))
        <div
            id="toast-warning"
            x-data="{ show: true }"
            x-show="show"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90"
            x-init="setTimeout(() => show = false, 2000)"
            class="flex items-center w-full p-4
                   bg-surface dark:bg-surface-dark
                   text-text-primary dark:text-text-primary-dark
                   rounded-xl shadow-lg border border-bordercolor dark:border-bordercolor-dark"
            role="alert"
        >
            {{-- Icon --}}
            <div
                class="inline-flex items-center justify-center shrink-0 w-7 h-7
                       rounded-full bg-amber-100 text-amber-600
                       dark:bg-amber-500/15 dark:text-amber-300"
            >
                <i class="fa-solid fa-triangle-exclamation text-sm"></i>
                <span class="sr-only">Warning icon</span>
            </div>

            {{-- Message --}}
            <div class="ms-3 text-sm font-normal">
                {{ session('warning') }}
            </div>

            {{-- Close --}}
            <button
                type="button"
                @click="show = false"
                class="ms-auto flex items-center justify-center h-8 w-8 rounded-full
                       text-text-secondary dark:text-text-secondary-dark
                       border border-transparent
                       hover:bg-primary-soft dark:hover:bg-primary-soft-dark
                       hover:text-text-primary dark:hover:text-text-primary-dark
                       focus:outline-none focus:ring-2 focus:ring-primary
                       transition"
                aria-label="Close"
            >
                <span class="sr-only">Close</span>
                <i class="fa-solid fa-xmark text-sm"></i>
            </button>
        </div>
    @endif
</div>
