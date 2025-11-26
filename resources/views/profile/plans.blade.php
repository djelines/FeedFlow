<x-app-layout>

    <div class="max-w-4xl w-full space-y-8">

        <!-- En-tête -->
        <div class="text-center space-y-4">
            <h2 class="text-4xl font-extrabold text-slate-900">Choisissez votre plan</h2>
            <p class="text-lg text-slate-500">Une tarification simple pour toutes les équipes.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">

            <div class="relative bg-white rounded-2xl p-8 border-2 border-slate-200 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col">

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
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-emerald-500 shrink-0"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        <span class="text-slate-700"><strong>3</strong> Sondages Actifs</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-emerald-500 shrink-0"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        <span class="text-slate-700"><strong>100</strong> Réponses / mois</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-emerald-500 shrink-0"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        <span class="text-slate-700">Analytique de base</span>
                    </li>
                    <li class="flex items-start gap-3 opacity-50">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400 shrink-0"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        <span class="text-slate-500 line-through">Export des données</span>
                    </li>
                </ul>

                <button class="w-full py-3 px-4 rounded-xl font-bold text-sm transition-colors bg-white border-2 border-slate-900 text-slate-900 hover:bg-slate-50 cursor-pointer">
                    Passer au plan Gratuit
                </button>
            </div>

            <div class="relative bg-white rounded-2xl p-8 border-2 transition-all duration-300 flex flex-col border-indigo-500 shadow-xl ring-4 ring-indigo-500/10">

                <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-xs font-bold px-4 py-1.5 rounded-full shadow-lg flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 4l3 12h14l3-12-6 7-4-7-4 7-6-7zm3 16h14v2H5z"/></svg>
                    LE PLUS POPULAIRE
                </div>

                <div class="mb-6">
                    <h3 class="text-lg font-bold text-indigo-600 uppercase tracking-wide flex items-center gap-2">
                        Pro
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
                    </h3>
                    <div class="mt-4 flex items-baseline">
                        <span class="text-4xl font-extrabold text-slate-900">$29</span>
                        <span class="ml-1 text-slate-500">/mois</span>
                    </div>
                    <p class="mt-4 text-slate-500 text-sm">Pour les utilisateurs avancés et les équipes en croissance.</p>
                </div>

                <ul class="space-y-4 mb-8 flex-1">
                    <li class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-indigo-600 shrink-0"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        <span class="text-slate-700"><strong>Illimité</strong> Sondages Actifs</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-indigo-600 shrink-0"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        <span class="text-slate-700"><strong>Illimité</strong> Réponses</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-indigo-600 shrink-0"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        <span class="text-slate-700">Analytique avancée & Export</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-indigo-600 shrink-0"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        <span class="text-slate-700">Support Email Prioritaire</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-indigo-600 shrink-0"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        <span class="text-slate-700">Marque personnalisée</span>
                    </li>
                </ul>

                <button class="w-full py-3 px-4 rounded-xl font-bold text-sm transition-all shadow-lg bg-gradient-to-r from-indigo-600 to-purple-600 text-white hover:shadow-indigo-500/30 hover:scale-[1.02] cursor-pointer">
                    Passer Pro
                </button>
            </div>

        </div>

        <div class="mt-12 flex justify-center gap-8 text-slate-400 grayscale opacity-60">
            <div class="font-bold text-xl flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                Paiement Sécurisé
            </div>
            <div class="font-bold text-xl">VISA</div>
            <div class="font-bold text-xl">Mastercard</div>
        </div>

    </div>

</x-app-layout>
