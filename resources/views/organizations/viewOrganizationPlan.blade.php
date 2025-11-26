<x-app-layout>
    <div class="min-h-screen bg-slate-50 p-4 sm:p-8 flex flex-col items-center justify-start py-16">

        <div class="max-w-4xl w-full space-y-8">
            <div class="text-center space-y-4">

                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-200 text-slate-600 text-sm font-medium mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-building-2">
                        <path d="M6 22V7H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v18H6Z"/><path d="M10 22v-4a2 2 0 1 1 4 0v4"/><path d="M12 7h.01"/><path d="M12 11h.01"/><path d="M12 15h.01"/><path d="M12 19h.01"/>
                    </svg>
                    <span>Organisation : <strong>{{ $organization->name }}</strong></span>
                </div>

                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900">Choisissez votre plan</h2>

                <p class="text-lg sm:text-xl text-slate-500">
                    Gérez les limites et fonctionnalités pour cet espace de travail.
                    <br/>
                    <span class="text-sm text-slate-400 italic">* Chaque organisation est facturée séparément.</span>
                </p>

                {{-- Remplacez '#' par votre route de retour --}}
                <a href="#" class="text-sm text-slate-400 hover:text-slate-600 underline">
                    Retour au tableau de bord
                </a>
            </div>

            {{-- Conteneur des cartes de prix --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">

                {{-- Free Plan Card --}}
                <div @class([
                'relative bg-white rounded-2xl p-8 border-2 transition-all duration-300 flex flex-col',
                'border-slate-300 shadow-sm opacity-80' => $organization->isFreePlan(),
                'border-slate-200 shadow-sm hover:shadow-md' => !$organization->isFreePlan(),
            ])>

                    @if ($organization->isFreePlan())
                        <div class="absolute top-0 right-0 bg-slate-200 text-slate-600 text-xs font-bold px-3 py-1 rounded-bl-lg rounded-tr-lg">
                            PLAN ACTUEL
                        </div>
                    @endif

                    <div class="mb-6">
                        <h3 class="text-lg font-bold text-slate-900 uppercase tracking-wide">Démarrage</h3>
                        <div class="mt-4 flex items-baseline">
                            <span class="text-4xl font-extrabold text-slate-900">$0</span>
                            <span class="ml-1 text-slate-500">/mois</span>
                        </div>
                        <p class="mt-4 text-slate-500 text-sm">Parfait pour les projets personnels.</p>
                    </div>

                    <ul class="space-y-4 mb-8 flex-1">

                        <li class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-emerald-500 shrink-0">
                                <path d="M20 6 9 17l-5-5"/>
                            </svg>
                            <span class="text-slate-700"><strong>3</strong> Sondages Actifs</span>
                        </li>

                        <li class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-emerald-500 shrink-0">
                                <path d="M20 6 9 17l-5-5"/>
                            </svg>
                            <span class="text-slate-700"><strong>100</strong> Réponses / mois</span>
                        </li>

                        <li class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-emerald-500 shrink-0">
                                <path d="M20 6 9 17l-5-5"/>
                            </svg>
                            <span class="text-slate-700">Analytique de base</span>
                        </li>

                        <li class="flex items-start gap-3 opacity-50">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400 shrink-0">
                                <path d="M18 6 6 18"/><path d="m6 6 12 12"/>
                            </svg>
                            <span class="text-slate-500 line-through">Export des données</span>
                        </li>
                    </ul>

                    <a href="{{ $organization->isFreePlan() ? '#' : '' }}"
                        @class([
                            'w-full py-3 px-4 rounded-xl font-bold text-sm transition-colors text-center',
                            // Condition pour le style du bouton
                            'bg-slate-100 text-slate-400 cursor-default pointer-events-none' => $organization->isFreePlan(),
                            'bg-white border-2 border-slate-900 text-slate-900 hover:bg-slate-50' => !$organization->isFreePlan(),
                        ])
                        {{ $organization->isFreePlan() ? 'aria-disabled="true"' : '' }}
                    >
                        @if ($organization->isFreePlan())
                            Votre plan actuel
                        @else
                            Passer au plan Gratuit
                        @endif
                    </a>
                </div>

                <div @class([
                'relative bg-white rounded-2xl p-8 border-2 transition-all duration-300 flex flex-col',
                // Condition pour le style du plan ACTUEL
                'border-indigo-500 shadow-xl ring-4 ring-indigo-500/10' => $organization->isFreePlan(),
                'border-slate-200 shadow-lg hover:border-indigo-300' => !$organization->isFreePlan(),
            ])>

                    @if (!$organization->isFreePlan())
                        <div class="absolute top-0 right-0 bg-indigo-600 text-white text-xs font-bold px-3 py-1 rounded-bl-lg rounded-tr-lg">
                            PLAN ACTUEL
                        </div>
                    @else
                        <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-xs font-bold px-4 py-1.5 rounded-full shadow-lg flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-crown">
                                <path d="m2.5 17 112-14 1.5 4.5 1.5-4.5 12 14v5a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2Z"/>
                            </svg>
                            LE PLUS POPULAIRE
                        </div>
                    @endif

                    <div class="mb-6">
                        <h3 class="text-lg font-bold text-indigo-600 uppercase tracking-wide flex items-center gap-2">
                            Pro
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-zap">
                                <path d="M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14z"/>
                            </svg>
                        </h3>
                        <div class="mt-4 flex items-baseline">
                            <span class="text-4xl font-extrabold text-slate-900">$29</span>
                            <span class="ml-1 text-slate-500">/mois</span>
                        </div>
                        <p class="mt-4 text-slate-500 text-sm">Pour les utilisateurs avancés et les équipes en croissance.</p>
                    </div>

                    <ul class="space-y-4 mb-8 flex-1">

                        <li class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-indigo-600 shrink-0">
                                <path d="M20 6 9 17l-5-5"/>
                            </svg>
                            <span class="text-slate-700"><strong>Illimité</strong> Sondages Actifs</span>
                        </li>

                        <li class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-indigo-600 shrink-0">
                                <path d="M20 6 9 17l-5-5"/>
                            </svg>
                            <span class="text-slate-700"><strong>Illimité</strong> Réponses</span>
                        </li>

                        <li class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-indigo-600 shrink-0">
                                <path d="M20 6 9 17l-5-5"/>
                            </svg>
                            <span class="text-slate-700">Analytique avancée & Export</span>
                        </li>

                        <li class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-indigo-600 shrink-0">
                                <path d="M20 6 9 17l-5-5"/>
                            </svg>
                            <span class="text-slate-700">Support Email Prioritaire</span>
                        </li>

                        <li class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-indigo-600 shrink-0">
                                <path d="M20 6 9 17l-5-5"/>
                            </svg>
                            <span class="text-slate-700">Marque personnalisée</span>
                        </li>
                    </ul>

                    <a href="{{ !$organization->isFreePlan() ? '#' : '' }}"
                        @class([
                            'w-full py-3 px-4 rounded-xl font-bold text-sm transition-all shadow-lg text-center',
                            // Condition pour le style du bouton
                            'bg-emerald-50 text-emerald-600 border border-emerald-200 cursor-default pointer-events-none' => $organization->isFreePlan(),
                            'bg-gradient-to-r from-indigo-600 to-purple-600 text-white hover:shadow-indigo-500/30 hover:scale-[1.02]' => !$organization->isFreePlan(),
                        ])
                        {{ !$organization->isFreePlan() ? 'aria-disabled="true"' : '' }}
                    >
                        @if (!$organization->isFreePlan())
                            Plan Actif
                        @else
                            Passer Pro
                        @endif
                    </a>
                </div>

            </div>

            {{-- Logos de confiance --}}
            <div class="mt-12 flex flex-col sm:flex-row justify-center items-center gap-6 sm:gap-8 text-slate-400 grayscale opacity-60">
                <div class="font-bold text-xl flex items-center gap-2">
                    {{-- Shield Icon (Lucide) --}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                    </svg>
                    PaiementSécurisé
                </div>
                <div class="font-bold text-xl">VISA</div>
                <div class="font-bold text-xl">Mastercard</div>
            </div>
        </div>
    </div>
</x-app-layout>
