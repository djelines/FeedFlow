<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sonde Urinaire</title>
    <link rel="icon" href="logo.png" />

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] relative flex px-6 lg:px-8 items-center lg:justify-center min-h-screen flex-col">

<header class="w-full text-sm absolute top-5 px-4 not-has-[nav]:hidden z-[60]">
    @if (Route::has('login'))
        <nav class="flex items-center justify-end gap-4">
            @auth
                <a
                    href="{{ url('/dashboard') }}"
                    class="relative overflow-hidden inline-flex items-center justify-center px-5 py-1.5 text-sm font-medium
                           rounded-md text-text-primary dark:text-[#EDEDEC]
                           border border-[#19140035] dark:border-[#3E3E3A]
                           hover:text-text-primary-dark
                           transition-all duration-150
                           hover:-translate-y-[1px]
                           before:absolute before:inset-0 before:-z-10
                           before:bg-primary-noise dark:before:bg-primary-noise-dark
                           before:bg-[length:260%_260%] before:bg-center
                           before:opacity-0 before:transition-opacity before:duration-200
                           hover:before:opacity-100 hover:before:animate-gradient-noise
                           focus:outline-none focus:ring-2 focus:ring-primary"
                >
                    Dashboard
                </a>
            @else
                <a
                    href="{{ route('login') }}"
                    class="relative overflow-hidden inline-flex items-center justify-center px-5 py-1.5 text-sm font-medium
                           rounded-md text-text-primary dark:text-[#EDEDEC]
                           border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A]
                           hover:text-text-primary-dark
                           transition-all duration-150
                           hover:-translate-y-[1px]
                           before:absolute before:inset-0 before:-z-10
                           before:bg-primary-noise dark:before:bg-primary-noise-dark
                           before:bg-[length:260%_260%] before:bg-center
                           before:opacity-0 before:transition-opacity before:duration-200
                           hover:before:opacity-100 hover:before:animate-gradient-noise
                           focus:outline-none focus:ring-2 focus:ring-primary"
                >
                    Log in
                </a>

                @if (Route::has('register'))
                    <a
                        href="{{ route('register') }}"
                        class="relative overflow-hidden inline-flex items-center justify-center px-5 py-1.5 text-sm font-medium
                               rounded-md text-white shadow-md
                               border border-transparent
                               bg-gradient-to-r from-primary to-accent dark:from-primary-dark dark:to-accent-dark
                               transition-all duration-150
                               hover:-translate-y-[1px]
                               before:absolute before:inset-0 before:-z-10
                               before:bg-primary-noise dark:before:bg-primary-noise-dark
                               before:bg-[length:260%_260%] before:bg-center
                               before:opacity-0 before:transition-opacity before:duration-200
                               hover:before:opacity-100 hover:before:animate-gradient-noise
                               focus:outline-none focus:ring-2 focus:ring-primary"
                    >
                        Register
                    </a>
                @endif
            @endauth
        </nav>
    @endif
</header>

<div class="absolute inset-0 overflow-hidden pointer-events-none z-0">
    <div class="absolute top-[-10%] left-[10%] w-[600px] h-[600px] bg-indigo-100 rounded-full blur-[100px] opacity-60 mix-blend-multiply"></div>
    <div class="absolute bottom-[-10%] right-[10%] w-[600px] h-[600px] bg-pink-100 rounded-full blur-[100px] opacity-60 mix-blend-multiply delay-1000"></div>
    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-[0.4] contrast-50 grayscale"></div>
</div>

<div class="flex items-center z-50 min-h-screen min-w-screen justify-center transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
    <main class="flex w-full flex-col">

        <div class="max-w-3xl space-y-5 mb-12 mx-auto text-center animate-in slide-in-from-top-10 duration-700 fade-in pt-20 lg:pt-0">
            <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight text-slate-900 text-center">
                Gérez vos sondages <br>
                <span class="text-transparent max-w-xl block bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600">
                            simplement et efficacement.
                        </span>
            </h1>

            <p class="text-slate-500 text-base md:text-lg max-w-xl mx-auto leading-relaxed">
                La solution tout-en-un pour centraliser vos feedbacks. Créez des organisations,
                invitez votre équipe et analysez les résultats.
            </p>
        </div>

        <div class="w-full grid grid-cols-1 md:grid-cols-3 gap-8 relative pb-8 max-w-7xl mx-auto">

            <div class="relative group">
                <div class="hidden md:flex absolute top-1/2 -right-6 transform -translate-y-1/2 z-20 text-slate-300 justify-center w-4 pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                </div>

                <div class="relative overflow-hidden flex flex-col w-full h-full rounded-2xl p-4 transition-all duration-300
                              bg-white border border-slate-200 shadow-sm
                              hover:-translate-y-1 hover:shadow-xl items-start
                              before:absolute before:inset-0 before:-z-10
                              before:bg-gradient-to-br before:from-indigo-600 before:via-purple-600 before:to-pink-600
                              before:bg-[length:260%_260%] before:bg-center
                              before:opacity-0 before:transition-opacity before:duration-300
                              hover:before:opacity-100 hover:before:animate-gradient-xy
                              hover:text-white group-hover:border-transparent"
                >
                    <div class="bg-white border border-slate-100 text-slate-500 group-hover:bg-white/20 group-hover:border-white/30 group-hover:text-white group-hover:backdrop-blur-sm text-xs font-bold px-2 py-1 rounded shadow-sm z-20 transition-colors">
                        ÉTAPE 1
                    </div>

                    <div class="h-40 mb-6 w-full mt-4 bg-slate-50 group-hover:bg-white/10 group-hover:border-white/20 rounded-lg border border-slate-100 relative overflow-hidden flex flex-col shadow-inner transition-colors">
                        <div class="flex h-full">
                            <div class="w-1/3 bg-slate-100 group-hover:bg-black/20 border-r border-slate-200 group-hover:border-white/10 p-2 space-y-2 transition-colors">
                                <div class="w-full h-2 bg-slate-300 group-hover:bg-white/40 rounded opacity-50"></div>
                                <div class="w-3/4 h-2 bg-slate-300 group-hover:bg-white/40 rounded opacity-30"></div>
                            </div>
                            <div class="flex-1 p-3 space-y-2">
                                <div class="flex items-center gap-2 mb-2">
                                    <div class="w-6 h-6 rounded-full bg-white group-hover:bg-white/20 border border-slate-200 group-hover:border-white/30 flex items-center justify-center shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                    </div>
                                    <div class="w-20 h-3 bg-slate-200 group-hover:bg-white/30 rounded"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h3 class="text-lg font-bold text-slate-900 group-hover:text-white mb-2 flex items-center gap-2 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><path d="M16 3.128a4 4 0 0 1 0 7.744"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><circle cx="9" cy="7" r="4"/></svg>
                        Multi-Organisations
                    </h3>
                    <p class="text-sm text-slate-500 group-hover:text-indigo-100 leading-snug transition-colors">
                        Créez des espaces dédiés pour chaque client ou projet. Invitez vos membres et gérez les rôles.
                    </p>
                </div>
            </div>

            <div class="relative group">
                <div class="hidden md:flex absolute top-1/2 -right-6 transform -translate-y-1/2 z-20 text-slate-300 justify-center w-4 pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                </div>

                <div class="relative overflow-hidden flex flex-col w-full h-full rounded-2xl p-4 transition-all duration-300
                              bg-white border border-slate-200 shadow-sm
                              hover:-translate-y-1 hover:shadow-xl items-start
                              before:absolute before:inset-0 before:-z-10
                              before:bg-gradient-to-br before:from-purple-600 before:via-pink-600 before:to-orange-500
                              before:bg-[length:260%_260%] before:bg-center
                              before:opacity-0 before:transition-opacity before:duration-300
                              hover:before:opacity-100 hover:before:animate-gradient-xy
                              hover:text-white group-hover:border-transparent"
                >
                    <div class="bg-white border border-slate-100 text-slate-500 group-hover:bg-white/20 group-hover:border-white/30 group-hover:text-white group-hover:backdrop-blur-sm text-xs font-bold px-2 py-1 rounded shadow-sm z-20 transition-colors">
                        ÉTAPE 2
                    </div>

                    <div class="h-40 mb-6 w-full mt-4 bg-slate-50 group-hover:bg-white/10 group-hover:border-white/20 rounded-lg border border-slate-100 relative overflow-hidden flex flex-col shadow-inner p-4 transition-colors">
                        <div class="w-12 h-1 bg-purple-500 group-hover:bg-white mb-3 rounded-full"></div>
                        <div class="w-3/4 h-3 bg-slate-200 group-hover:bg-white/30 rounded mb-4"></div>
                        <div class="space-y-2">
                            <div class="flex items-center gap-2 p-2 rounded bg-white group-hover:bg-white/10 border border-slate-100 group-hover:border-white/20">
                                <div class="w-3 h-3 rounded-full border border-slate-300 group-hover:border-white/50"></div>
                                <div class="w-1/2 h-2 bg-slate-200 group-hover:bg-white/30 rounded"></div>
                            </div>
                            <div class="flex items-center gap-2 p-2 rounded bg-purple-50 group-hover:bg-white/20 border border-purple-100 group-hover:border-white/40">
                                <div class="w-3 h-3 rounded-full border-4 border-purple-500 group-hover:border-white"></div>
                                <div class="w-2/3 h-2 bg-slate-300 group-hover:bg-white/50 rounded"></div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-auto text-purple-600 group-hover:text-white"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg>
                            </div>
                        </div>
                    </div>

                    <h3 class="text-lg font-bold text-slate-900 group-hover:text-white mb-2 flex items-center gap-2 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/></svg>
                        Éditeur Simple
                    </h3>
                    <p class="text-sm text-slate-500 group-hover:text-purple-100 leading-snug transition-colors">
                        Construisez vos questionnaires en quelques clics : choix multiples, texte, échelles de notation.
                    </p>
                </div>
            </div>

            <div class="relative group">
                <div class="relative overflow-hidden flex flex-col w-full h-full rounded-2xl p-4 transition-all duration-300
                              bg-white border border-slate-200 shadow-sm
                              hover:-translate-y-1 hover:shadow-xl items-start
                              before:absolute before:inset-0 before:-z-10
                              before:bg-gradient-to-br before:from-pink-600 before:via-rose-600 before:to-red-500
                              before:bg-[length:260%_260%] before:bg-center
                              before:opacity-0 before:transition-opacity before:duration-300
                              hover:before:opacity-100 hover:before:animate-gradient-xy
                              hover:text-white group-hover:border-transparent"
                >
                    <div class="bg-white border border-slate-100 text-slate-500 group-hover:bg-white/20 group-hover:border-white/30 group-hover:text-white group-hover:backdrop-blur-sm text-xs font-bold px-2 py-1 rounded shadow-sm z-20 transition-colors">
                        ÉTAPE 3
                    </div>

                    <div class="h-40 mb-6 w-full mt-4 bg-slate-50 group-hover:bg-white/10 group-hover:border-white/20 rounded-lg border border-slate-100 relative overflow-hidden flex items-end justify-center pb-4 px-4 gap-2 shadow-inner transition-colors">

                        <div class="w-full absolute top-3 left-4 flex gap-2">
                            <div class="w-2 h-2 rounded-full bg-pink-500 group-hover:bg-white"></div>
                            <div class="w-16 h-2 bg-slate-200 group-hover:bg-white/30 rounded"></div>
                        </div>

                        <div class="w-8 bg-slate-200 group-hover:bg-white/30 rounded-t h-[30%] group-hover:h-[40%] transition-all duration-500"></div>
                        <div class="w-8 bg-slate-300 group-hover:bg-white/40 rounded-t h-[50%] group-hover:h-[60%] transition-all duration-500 delay-75"></div>
                        <div class="w-8 bg-gradient-to-t from-pink-500 to-purple-500 group-hover:from-white group-hover:to-white rounded-t h-[70%] group-hover:h-[85%] transition-all duration-500 delay-150 relative shadow-lg shadow-pink-200 group-hover:shadow-none">
                            <div class="absolute -top-6 left-1/2 -translate-x-1/2 text-[10px] font-bold text-pink-600 group-hover:text-white opacity-0 group-hover:opacity-100 group-hover:scale-110 transition-all duration-300">85%</div>
                        </div>
                        <div class="w-8 bg-slate-200 group-hover:bg-white/30 rounded-t h-[45%] group-hover:h-[55%] transition-all duration-500 delay-100"></div>
                    </div>

                    <h3 class="text-lg font-bold text-slate-900 group-hover:text-white mb-2 flex items-center gap-2 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v16a2 2 0 0 0 2 2h16"/><rect x="7" y="13" width="9" height="4" rx="1"/><rect x="7" y="5" width="12" height="4" rx="1"/></svg>
                        Analyse en Temps Réel
                    </h3>
                    <p class="text-sm text-slate-500 group-hover:text-pink-100 leading-snug transition-colors">
                        Visualisez les réponses instantanément avec des graphiques clairs et exportables.
                    </p>
                </div>
            </div>

        </div>

    </main>
</div>

@if (Route::has('login'))
    <div class="h-14.5 hidden lg:block"></div>
@endif
</body>
</html>
