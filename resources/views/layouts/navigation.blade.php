<div class="min-h-screen bg-background dark:bg-background-dark text-text-primary dark:text-text-primary-dark">

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
                <span class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-primary-soft dark:bg-primary-soft-dark text-primary dark:text-primary-dark font-semibold">
                    S
                </span>
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
                            href="#"
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

                    {{-- Organisations --}}
                    <li>
                        <button
                            type="button"
                            data-collapse-toggle="dropdown-organizations"
                            aria-controls="dropdown-organizations"
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
                                <i class="fa-solid fa-briefcase text-base text-text-secondary dark:text-text-secondary-dark group-hover:text-white"></i>
                                <span>Organisation</span>
                            </div>

                            <i class="fa-solid fa-chevron-down text-xs text-text-secondary dark:text-text-secondary-dark group-hover:text-white transition-transform group-data-[collapsed=false]:rotate-180"></i>
                        </button>

                        {{-- Nested organizations --}}
                        <ul
                            id="dropdown-organizations"
                            class="hidden pt-2 space-y-1 ml-4 pl-2 border-l-[3px] border-bordercolor/70 dark:border-bordercolor-dark/70"
                        >
                            <li>
                                <a
                                    href="/organizations"
                                    class="flex items-center px-3 py-1.5 rounded-lg text-xs
                                           text-text-secondary dark:text-text-secondary-dark
                                           hover:bg-primary-soft dark:hover:bg-primary-soft-dark
                                           hover:text-text-primary dark:hover:text-text-primary-dark
                                           transition"
                                >
                                    <span>Voir toutes les organisations</span>
                                </a>
                            </li>

                            @foreach($organization as $org)
                                <li>
                                    <a
                                        href="/organizations/view/{{ $org->id }}"
                                        class="flex items-center px-3 py-1.5 rounded-lg text-xs
                                               text-text-secondary dark:text-text-secondary-dark
                                               hover:bg-primary-soft dark:hover:bg-primary-soft-dark
                                               hover:text-text-primary dark:hover:text-text-primary-dark
                                               transition"
                                    >
                                        <span class="mr-2 h-1.5 w-1.5 rounded-full bg-text-secondary/60 dark:bg-text-secondary-dark/70"></span>
                                        <span class="truncate">{{ $org->name }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>

                    {{-- Notifications --}}
                    <li>
                        <a
                            href="#"
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
                            <i class="fa-solid fa-bell text-base text-text-secondary dark:text-text-secondary-dark group-hover:text-white"></i>
                            <span class="flex-1 ml-3 whitespace-nowrap">Notifications</span>
                            <span class="inline-flex items-center justify-center px-2 py-0.5 text-xs font-medium rounded-full bg-primary-soft text-primary group-hover:bg-white group-hover:text-primary">
                                3
                            </span>
                        </a>
                    </li>

                    {{-- Surveys --}}
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
                            <i class="fa-solid fa-chart-gantt text-base text-text-secondary dark:text-text-secondary-dark group-hover:text-white"></i>
                            <span class="flex-1 ml-3 whitespace-nowrap">Sondages</span>
                        </a>
                    </li>

                </ul>
            </nav>

            {{-- User block --}}
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
                                    href="#"
                                    class="block mx-1 px-3 py-1.5 rounded-lg
                               text-text-primary dark:text-text-primary-dark
                               hover:bg-primary-soft dark:hover:bg-primary-soft-dark
                               hover:text-text-primary dark:hover:text-text-primary-dark
                               transition"
                                >
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <a
                                    href="#"
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
                                <a
                                    href="#"
                                    class="block mx-1 px-3 py-1.5 rounded-lg
                               text-text-primary dark:text-text-primary-dark
                               hover:bg-primary-soft dark:hover:bg-primary-soft-dark
                               hover:text-text-primary dark:hover:text-text-primary-dark
                               transition"
                                >
                                    Sign out
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </aside>


    {{-- Header --}}
    <header class="sticky top-0 z-30 sm:ml-64 border-b-2 h-16 border-bordercolor dark:border-bordercolor-dark bg-sidebar/90 dark:bg-sidebar-dark/90 backdrop-blur">
        <div class="flex items-center justify-between px-4 py-3 lg:px-8">
            <div class="flex items-center gap-3">
                <button
                    type="button"
                    data-drawer-target="logo-sidebar"
                    data-drawer-toggle="logo-sidebar"
                    aria-controls="logo-sidebar"
                    class="inline-flex items-center p-2 text-sm rounded-lg sm:hidden
                           text-text-secondary focus:outline-none focus:ring-2 focus:ring-bordercolor"
                >
                    <span class="sr-only">Open sidebar</span> {{-- why? --}}
                    <i class="fa-solid fa-bars text-lg"></i>
                </button>

                <div>

                    <h1 class="text-xl font-semibold">
                        Ceci est un test ça ne va pas rester
                    </h1>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button
                    class="relative overflow-hidden hidden sm:inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg
                           text-white shadow-sm transform transition-all duration-150
                           bg-gradient-to-r from-primary to-accent dark:from-primary-dark dark:to-accent-dark
                           hover:scale-[1.02] active:scale-[0.97]
                           before:absolute before:inset-0 before:-z-10
                           before:bg-primary-noise dark:before:bg-primary-noise-dark
                           before:bg-[length:260%_260%] before:bg-center
                           before:opacity-0 before:transition-opacity before:duration-200
                           hover:before:opacity-100 hover:before:animate-gradient-noise"
                >
                    <i class="fa-solid fa-plus mr-2 text-xs"></i>
                    New survey
                </button>
            </div>
        </div>
    </header>
@endif

    {{-- Main content --}}
    <main class="sm:ml-64 ">
        {{ $slot }}
    </main>

</div>
