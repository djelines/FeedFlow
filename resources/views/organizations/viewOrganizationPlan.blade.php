<x-app-layout>
    <div
        class="min-h-screen p-4 sm:p-8 flex flex-col items-center justify-start py-16
               bg-slate-50 dark:bg-background-dark"
    >
        <div class="max-w-4xl w-full space-y-8">
            {{-- Header / intro --}}
            <div class="text-center space-y-4">

                {{-- Small org pill --}}
                <div
                    class="inline-flex items-center gap-2 px-3 py-1 rounded-full
                           bg-slate-200 text-slate-600 dark:bg-surface-dark dark:text-slate-100
                           text-sm font-medium mb-2"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                         viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="lucide lucide-building-2">
                        <path d="M6 22V7H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v18H6Z"/>
                        <path d="M10 22v-4a2 2 0 1 1 4 0v4"/>
                        <path d="M12 7h.01"/>
                        <path d="M12 11h.01"/>
                        <path d="M12 15h.01"/>
                        <path d="M12 19h.01"/>
                    </svg>
                    <span>
                        Organisation :
                        <strong>{{ $organization->name }}</strong>
                    </span>
                </div>

                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-slate-50">
                    Choisissez votre plan
                </h2>

                <p class="text-lg sm:text-xl text-slate-500 dark:text-slate-300">
                    Gérez les limites et fonctionnalités pour cet espace de travail.
                    <br/>
                    <span class="text-sm text-slate-400 dark:text-slate-400/80 italic">
                        * Chaque organisation est facturée séparément.
                    </span>
                </p>

                <a
                    href="/organizations/view/{{ $organization->hash_id }}"
                    class="text-sm text-slate-400 dark:text-slate-300 hover:text-slate-600 dark:hover:text-slate-100 underline"
                >
                    Retour à {{$organization->name}}
                </a>
            </div>

            {{-- Plans grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">

                {{-- Free plan --}}
                <div
                    @class([
                        'relative rounded-2xl p-8 border-2 transition-all duration-300 flex flex-col bg-white dark:bg-surface-dark',
                        'border-slate-300 dark:border-slate-600 shadow-sm opacity-80' => $organization->isFreePlan(),
                        'border-slate-200 dark:border-slate-600 shadow-sm hover:shadow-md' => !$organization->isFreePlan(),
                    ])
                >
                    @if ($organization->isFreePlan())
                        <div
                            class="absolute top-0 right-0 bg-slate-200 dark:bg-slate-700
                                   text-slate-600 dark:text-slate-100 text-xs font-bold
                                   px-3 py-1 rounded-bl-lg rounded-tr-lg"
                        >
                            PLAN ACTUEL
                        </div>
                    @endif

                    <div class="mb-6">
                        <h3 class="text-lg font-bold text-slate-900 dark:text-slate-50 uppercase tracking-wide">
                            Démarrage
                        </h3>
                        <div class="mt-4 flex items-baseline">
                            <span class="text-4xl font-extrabold text-slate-900 dark:text-slate-50">$0</span>
                            <span class="ml-1 text-slate-500 dark:text-slate-300">/mois</span>
                        </div>
                        <p class="mt-4 text-slate-500 dark:text-slate-300 text-sm">
                            Parfait pour les projets personnels.
                        </p>
                    </div>

                    <ul class="space-y-4 mb-8 flex-1">
                        <li class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                 viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
                                 class="text-emerald-500 dark:text-emerald-400 shrink-0">
                                <path d="M20 6 9 17l-5-5"/>
                            </svg>
                            <span class="text-slate-700 dark:text-slate-200">
                                <strong>3</strong> Sondages Actifs
                            </span>
                        </li>

                        <li class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                 viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
                                 class="text-emerald-500 dark:text-emerald-400 shrink-0">
                                <path d="M20 6 9 17l-5-5"/>
                            </svg>
                            <span class="text-slate-700 dark:text-slate-200">
                                <strong>100</strong> Réponses / mois
                            </span>
                        </li>

                        <li class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                 viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
                                 class="text-emerald-500 dark:text-emerald-400 shrink-0">
                                <path d="M20 6 9 17l-5-5"/>
                            </svg>
                            <span class="text-slate-700 dark:text-slate-200">
                                Analytique de base
                            </span>
                        </li>

                        <li class="flex items-start gap-3 opacity-50 dark:opacity-60">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                 viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
                                 class="text-slate-400 dark:text-slate-500 shrink-0">
                                <path d="M18 6 6 18"/>
                                <path d="m6 6 12 12"/>
                            </svg>
                            <span class="text-slate-500 dark:text-slate-400 line-through">
                                Export des données
                            </span>
                        </li>
                    </ul>

                    <form action="{{ route('organizations.update', $organization->hash_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input hidden="hidden" value="free" name="plan">

                        <button
                            @disabled($organization->isFreePlan())
                            type="submit"
                            @class([
                                'w-full py-3 px-4 rounded-xl font-bold text-sm transition-colors text-center',
                                'bg-slate-100 text-slate-400 dark:bg-slate-800 dark:text-slate-500 cursor-default pointer-events-none' => $organization->isFreePlan(),
                                'bg-white dark:bg-transparent border-2 border-slate-900 dark:border-indigo-400 text-slate-900 dark:text-slate-50 hover:bg-slate-50 dark:hover:bg-indigo-500/10' => !$organization->isFreePlan(),
                            ])
                        >
                            @if ($organization->isFreePlan())
                                Votre plan actuel
                            @else
                                Passer au plan Gratuit
                            @endif
                        </button>
                    </form>
                </div>

                {{-- Pro plan --}}
                <div
                    @class([
                        'relative rounded-2xl p-8 border-2 transition-all duration-300 flex flex-col bg-white dark:bg-surface-dark',
                        'border-indigo-500 shadow-xl ring-4 ring-indigo-500/10 dark:ring-indigo-500/20' => $organization->isFreePlan(),
                        'border-slate-200 dark:border-slate-600 shadow-lg hover:border-indigo-300 dark:hover:border-indigo-400' => !$organization->isFreePlan(),
                    ])
                >
                    @if (!$organization->isFreePlan())
                        <div
                            class="absolute top-0 right-0 bg-indigo-600 text-white text-xs font-bold px-3 py-1
                                   rounded-bl-lg rounded-tr-lg"
                        >
                            PLAN ACTUEL
                        </div>
                    @else
                        <div
                            class="absolute -top-4 left-1/2 -translate-x-1/2
                                   bg-gradient-to-r from-indigo-600 to-purple-600 text-white
                                   text-xs font-bold px-4 py-1.5 rounded-full shadow-lg flex items-center gap-1"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                 viewBox="0 0 24 24" fill="currentColor"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="lucide lucide-crown">
                                <path d="M3 11 7 5l5 4 5-4 4 6v6H3z"/>
                            </svg>
                            LE PLUS POPULAIRE
                        </div>
                    @endif

                    <div class="mb-6">
                        <h3
                            class="text-lg font-bold uppercase tracking-wide flex items-center gap-2
                                   text-indigo-600 dark:text-indigo-400"
                        >
                            Pro
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                 viewBox="0 0 24 24" fill="currentColor"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="lucide lucide-zap">
                                <path d="M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14z"/>
                            </svg>
                        </h3>
                        <div class="mt-4 flex items-baseline">
                            <span class="text-4xl font-extrabold text-slate-900 dark:text-slate-50">$29</span>
                            <span class="ml-1 text-slate-500 dark:text-slate-300">/mois</span>
                        </div>
                        <p class="mt-4 text-slate-500 dark:text-slate-300 text-sm">
                            Pour les utilisateurs avancés et les équipes en croissance.
                        </p>
                    </div>

                    <ul class="space-y-4 mb-8 flex-1">
                        <li class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                 viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
                                 class="text-indigo-600 dark:text-indigo-400 shrink-0">
                                <path d="M20 6 9 17l-5-5"/>
                            </svg>
                            <span class="text-slate-700 dark:text-slate-200">
                                <strong>Illimité</strong> Sondages Actifs
                            </span>
                        </li>

                        <li class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                 viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
                                 class="text-indigo-600 dark:text-indigo-400 shrink-0">
                                <path d="M20 6 9 17l-5-5"/>
                            </svg>
                            <span class="text-slate-700 dark:text-slate-200">
                                <strong>Illimité</strong> Réponses
                            </span>
                        </li>

                        <li class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                 viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
                                 class="text-indigo-600 dark:text-indigo-400 shrink-0">
                                <path d="M20 6 9 17l-5-5"/>
                            </svg>
                            <span class="text-slate-700 dark:text-slate-200">
                                Analytique avancée &amp; Export
                            </span>
                        </li>

                        <li class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                 viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
                                 class="text-indigo-600 dark:text-indigo-400 shrink-0">
                                <path d="M20 6 9 17l-5-5"/>
                            </svg>
                            <span class="text-slate-700 dark:text-slate-200">
                                Support Email Prioritaire
                            </span>
                        </li>

                        <li class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                 viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
                                 class="text-indigo-600 dark:text-indigo-400 shrink-0">
                                <path d="M20 6 9 17l-5-5"/>
                            </svg>
                            <span class="text-slate-700 dark:text-slate-200">
                                Marque personnalisée
                            </span>
                        </li>
                    </ul>

                    <form action="{{ route('organizations.update', $organization->hash_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input hidden="hidden" value="premium" name="plan">

                        <button
                            @disabled(!$organization->isFreePlan())
                            type="submit"
                            @class([
                                'w-full py-3 px-4 rounded-xl font-bold text-sm transition-all shadow-lg text-center',
                                'bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-700 cursor-pointer' => $organization->isFreePlan(),
                                'bg-gradient-to-r from-indigo-600 to-purple-600 text-white hover:shadow-indigo-500/30 hover:scale-[1.02]' => !$organization->isFreePlan(),
                            ])
                        >
                            @if (!$organization->isFreePlan())
                                Plan Actif
                            @else
                                Passer Pro
                            @endif
                        </button>
                    </form>
                </div>

            </div>

            {{-- Trust logos --}}
            <div
                class="mt-12 flex flex-col sm:flex-row justify-center items-center gap-6 sm:gap-8
                       text-slate-400 dark:text-slate-400 grayscale opacity-60"
            >
                <div class="font-bold text-xl flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                         viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="lucide lucide-shield">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                    </svg>
                    PaiementSécurisé
                </div>
                <div class="font-bold text-xl">VISA</div>
                <div class="font-bold text-xl">Mastercard</div>
                <div class="font-bold text-xl">ROBLOX REPUBLIC <span class="text-sm text-dark/20 dark:text-white/20">(aka la meilleure banque)</span></div>
            </div>
        </div>
    </div>
</x-app-layout>
