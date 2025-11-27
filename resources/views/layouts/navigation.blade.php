<div class="min-h-screen bg-background dark:bg-background-dark text-text-primary dark:text-text-primary-dark transition-colors duration-300">


@if (Auth::check())
    {{-- Sidebar --}}
    <aside
        id="logo-sidebar"
        aria-label="Sidebar"
        class="fixed inset-y-0 left-0 z-40 w-64 border-r-[2px] border-bordercolor bg-sidebar
               dark:bg-sidebar-dark dark:border-bordercolor-dark
               transition-transform -translate-x-full sm:translate-x-0"
    >
        <div class="flex flex-col h-full">

            {{-- Brand --}}
            <div class="flex items-center h-16 px-4 border-b-[2px] border-bordercolor/70 dark:border-bordercolor-dark/70">
                <a href="/">
                    <img src="logo.png" class="w-12">
                </a>
                <span class="ml-3 text-base font-semibold tracking-tight">
                    Sonde Urinaire
                </span>
            </div>

            {{-- Nav --}}
            <nav class="flex-1 px-3 py-4 overflow-y-auto">
                <ul class="space-y-1 text-sm font-medium">

                    {{-- Dashboard --}}
                    <li>
                        <a
                            href="{{url("/dashboard")}}"
                            class="relative overflow-hidden group flex items-center px-3 py-2 rounded-lg
                                   text-text-primary dark:text-text-primary-dark
                                   transform transition-all duration-150
                                   hover:scale-[1.02] active:scale-[0.97]
                                   before:absolute before:inset-0 before:-z-10
                                   before:bg-primary-noise dark:before:bg-primary-noise-dark
                                   before:bg-[length:260%_260%] before:bg-center
                                   before:opacity-0 before:transition-opacity before:duration-200
                                   hover:before:opacity-100 hover:before:animate-gradient-noise
                                   hover:text-white dark:hover:text-white"
                        >
                            <i class="fa-solid fa-chart-pie text-base text-text-secondary dark:text-text-secondary-dark group-hover:text-white"></i>
                            <span class="ml-3">Tableau de bord</span>
                        </a>
                    </li>

                    {{-- My organizations (overview link) --}}
                    <li>
                        <a
                            href="/organizations"
                            class="relative overflow-hidden group flex items-center px-3 py-2 rounded-lg
                                   text-text-primary dark:text-text-primary-dark
                                   transform transition-all duration-150
                                   hover:scale-[1.02] active:scale-[0.97]
                                   before:absolute before:inset-0 before:-z-10
                                   before:bg-primary-noise dark:before:bg-primary-noise-dark
                                   before:bg-[length:260%_260%] before:bg-center
                                   before:opacity-0 before:transition-opacity before:duration-200
                                   hover:before:opacity-100 hover:before:animate-gradient-noise
                                   hover:text-white dark:hover:text-white"
                        >
                            <i class="fa-solid fa-briefcase text-base text-text-secondary dark:text-text-secondary-dark group-hover:text-white"></i>
                            <span class="ml-3">Gerer mes organisations</span>
                        </a>
                    </li>

                    {{-- All surveys --}}
                    <li>
                        <a
                            href="{{ url('/survey') }}"
                            class="relative overflow-hidden group flex items-center px-3 py-2 rounded-lg
                                   text-text-primary dark:text-text-primary-dark
                                   transform transition-all duration-150
                                   hover:scale-[1.02] active:scale-[0.97]
                                   before:absolute before:inset-0 before:-z-10
                                   before:bg-primary-noise dark:before:bg-primary-noise-dark
                                   before:bg-[length:260%_260%] before:bg-center
                                   before:opacity-0 before:transition-opacity before:duration-200
                                   hover:before:opacity-100 hover:before:animate-gradient-noise
                                   hover:text-white dark:hover:text-white"
                        >
                            <i class="fa-solid fa-list-check text-base text-text-secondary dark:text-text-secondary-dark group-hover:text-white"></i>
                            <span class="ml-3">Gerer mes sondages</span>
                        </a>
                    </li>

                    {{-- Separator --}}
                    <li>
                        <div class="pt-3 pb-1 px-3 text-[11px] font-semibold uppercase tracking-wide text-text-secondary/70 dark:text-text-secondary-dark/70">
                            - Sondages des organisations -
                        </div>
                    </li>

                    {{-- Each organization with its surveys --}}
                    @foreach($organization as $org)
                        <li>
                            {{-- Organization item (collapsible) --}}
                            <button
                                type="button"
                                data-collapse-toggle="dropdown-org-{{ $org->id }}"
                                aria-controls="dropdown-org-{{ $org->id }}"
                                class="relative overflow-hidden group flex w-full items-center justify-between px-3 py-2 rounded-lg
                                       text-text-primary dark:text-text-primary-dark
                                       transform transition-all duration-150
                                       hover:scale-[1.02] active:scale-[0.97]
                                       before:absolute before:inset-0 before:-z-10
                                       before:bg-primary-noise dark:before:bg-primary-noise-dark
                                       before:bg-[length:260%_260%] before:bg-center
                                       before:opacity-0 before:transition-opacity before:duration-200
                                       hover:before:opacity-100 hover:before:animate-gradient-noise
                                       hover:text-white dark:hover:text-white"
                            >
                                <div class="flex items-center gap-3">
                                    <i class="fa-solid fa-building text-base text-text-secondary dark:text-text-secondary-dark group-hover:text-white"></i>
                                    <span class="truncate">{{ $org->name }}</span>
                                </div>

                                <i class="fa-solid fa-chevron-down text-xs text-text-secondary dark:text-text-secondary-dark group-hover:text-white transition-transform group-data-[collapsed=false]:rotate-180"></i>
                            </button>

                            {{-- Nested surveys --}}
                            <ul
                                id="dropdown-org-{{ $org->id }}"
                                class="hidden pt-2 space-y-1 ml-4 pl-2 border-l-[3px] border-bordercolor/70 dark:border-bordercolor-dark/70"
                            >
                                @forelse($org->surveys as $survey)
                                    <li>
                                        <a
                                            href="{{ route('survey.show', $survey->hash_id) }}"
                                            class="flex items-center px-3 py-1.5 rounded-lg text-xs
                                                   text-text-secondary dark:text-text-secondary-dark
                                                   hover:bg-primary-soft dark:hover:bg-primary-soft-dark
                                                   hover:text-text-primary dark:hover:text-text-primary-dark
                                                   transition"
                                        >
                                            <span class="mr-2 h-1.5 w-1.5 rounded-full bg-text-secondary/60 dark:bg-text-secondary-dark/70"></span>
                                            <span class="truncate">{{ $survey->title }}</span>
                                        </a>
                                    </li>
                                @empty
                                    <li>
                                        <div class="px-3 py-1.5 rounded-lg text-[11px] italic text-text-secondary/70 dark:text-text-secondary-dark/70">
                                            Aucun sondage pour cette organisation.
                                        </div>
                                    </li>
                                @endforelse
                            </ul>
                        </li>
                    @endforeach

                </ul>
            </nav>

            {{-- Theme toggle --}}
            <div class="px-3 pb-3 border-t-[2px] border-bordercolor/60 dark:border-bordercolor-dark/60">
                <button
                    type="button"
                    onclick="(function(){
                        const html = document.documentElement;
                        const isDark = html.classList.contains('dark');

                        if (isDark) {
                            html.classList.remove('dark');
                            html.classList.add('white');
                            localStorage.setItem('theme', 'light');
                        } else {
                            html.classList.add('dark');
                            html.classList.remove('white');
                            localStorage.setItem('theme', 'dark');
                        }
                    })()"
                    class="relative overflow-hidden w-full flex items-center justify-between px-3 py-2 mt-3 rounded-xl
                           bg-surface dark:bg-surface-dark
                           text-xs font-medium text-text-secondary dark:text-text-secondary-dark
                           hover:bg-primary-soft/70 dark:hover:bg-primary-soft-dark/70
                           hover:text-text-primary dark:hover:text-text-primary-dark
                           transition-all duration-150"
                >
                    <div class="flex items-center gap-2">
                        {{-- Icons change with theme --}}
                        <i class="fa-solid fa-sun text-sm text-accent dark:hidden w-5"></i>
                        <i class="fa-solid fa-moon text-sm text-indigo-300 hidden dark:inline-block w-5"></i>

                        <span class="truncate">
                            <span class="inline dark:hidden">Passer en mode sombre</span>
                            <span class="hidden dark:inline">Passer en mode clair</span>
                        </span>
                    </div>

                    {{-- Toggle pill + knob --}}
                    <span class="flex items-center">
                        <span class="w-9 h-5 flex items-center rounded-full bg-bordercolor/90 dark:bg-bordercolor-dark/90 px-0.5">
                            <span
                                class="w-4 h-4 rounded-full
                                       bg-accent dark:bg-indigo-300
                                       border border-white/70 dark:border-white/60
                                       shadow-md
                                       transform transition-transform duration-200 translate-x-0 dark:translate-x-4"
                            ></span>
                        </span>
                    </span>
                </button>
            </div>



            {{-- User block --}}
            <div class="px-3 py-4 border-t-[2px] border-bordercolor/70 dark:border-bordercolor-dark/70">
                <button
                    type="button"
                    data-dropdown-toggle="dropdown-user"
                    aria-expanded="false"
                    class="relative overflow-hidden group flex w-full items-center justify-between px-3 py-2 rounded-xl
               bg-surface dark:bg-surface-dark
               text-sm text-text-primary dark:text-text-primary-dark
               transform transition-transform duration-150
               hover:-translate-y-[1px]
               before:absolute before:inset-0 before:-z-10
               before:bg-primary-noise dark:before:bg-primary-noise-dark
               before:bg-[length:260%_260%] before:bg-center
               before:opacity-0 before:transition-opacity before:duration-200
               hover:before:opacity-100 hover:before:animate-gradient-noise
               hover:text-white dark:hover:text-white"
                >
                    <div class="flex items-center gap-3">
                        <img
                            class="w-8 h-8 rounded-full"
                            src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
                            alt="user photo"
                        >
                        <div class="text-left">
                            <p class="text-sm font-medium">
                                {{ Auth::user()->last_name }} {{ Auth::user()->first_name }}
                            </p>
                            <p class="text-xs text-text-secondary dark:text-text-secondary-dark truncate group-hover:text-white">
                                {{ Auth::user()->email }}
                            </p>
                        </div>
                    </div>

                    <i class="fa-solid fa-ellipsis-vertical text-sm text-text-secondary dark:text-text-secondary-dark group-hover:text-white"></i>
                </button>

                <div
                    id="dropdown-user"
                    class="z-50 hidden mt-2 w-full text-sm"
                >
                    <div class="rounded-xl bg-surface dark:bg-surface-dark shadow-lg border border-bordercolor/80 dark:border-bordercolor-dark/80 py-2">
                        <ul class="space-y-1">
                            <li>
                                <a
                                    href="{{url("/dashboard")}}"
                                    class="block mx-1 px-3 py-1.5 rounded-lg
                               text-text-primary dark:text-text-primary-dark
                               hover:bg-primary-soft dark:hover:bg-primary-soft-dark
                               hover:text-text-primary dark:hover:text-text-primary-dark
                               transition"
                                >
                                    Tableau de bord
                                </a>
                            </li>
                            <li>
                                <a
                                    href="{{ route('setting.show') }}"
                                    class="block mx-1 px-3 py-1.5 rounded-lg
                               text-text-primary dark:text-text-primary-dark
                               hover:bg-primary-soft dark:hover:bg-primary-soft-dark
                               hover:text-text-primary dark:hover:text-text-primary-dark
                               transition"
                                >
                                    Settings
                                </a>
                            </li>
                            <li>
                                <form id="logout-form"
                                      action="{{ route('logout') }}"
                                      method="POST"
                                      class="mx-1">
                                    @csrf
                                    <button
                                        type="submit"
                                        class="w-full px-3 py-1.5 rounded-lg text-left
                                               text-text-primary dark:text-text-primary-dark
                                               hover:bg-primary-soft dark:hover:bg-primary-soft-dark
                                               hover:text-text-primary dark:hover:text-text-primary-dark
                                               transition"
                                    >
                                        Se déconnecter
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </aside>


        {{-- Header (showed for mobile only) --}}
        <header class="sticky top-0 z-30 border-b-2 h-16 border-bordercolor dark:border-bordercolor-dark bg-sidebar/90 dark:bg-sidebar-dark/90 backdrop-blur sm:hidden">
            <div class="flex items-center justify-between px-4 py-3">
                <div class="flex items-center gap-3">
                    <button
                        type="button"
                        data-drawer-target="logo-sidebar"
                        data-drawer-toggle="logo-sidebar"
                        aria-controls="logo-sidebar"
                        class="inline-flex items-center p-2 text-sm rounded-lg
                           text-text-secondary focus:outline-none focus:ring-2 focus:ring-bordercolor"
                    >
                        <span class="sr-only">Open sidebar</span>
                        <i class="fa-solid fa-bars text-lg"></i>
                    </button>

                    {{-- Mobile brand --}}
                    <div class="flex items-center gap-2">
                        <a href="/">
                            <img src="logo.png" class="w-12">
                        </a>
                        <span class="text-base font-semibold tracking-tight">
                        Sonde Urinaire
                    </span>
                    </div>
                </div>
            </div>
        </header>

    @endif

    {{-- Main content --}}
    <main class="sm:ml-64 ">
        {{ $slot }}
    </main>

</div>
