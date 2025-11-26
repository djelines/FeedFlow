<x-app-layout>

    <div class="p-8 space-y-10 animate-in fade-in duration-500">

        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 border-b border-slate-200 pb-8">
            <div class="flex-1">
                <div class="flex items-center gap-3 text-sm font-bold text-slate-500 mb-2 uppercase tracking-wider">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-briefcase-icon lucide-briefcase"><path d="M16 20V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/><rect width="20" height="14" x="2" y="6" rx="2"/></svg>
                    <span class="text-xs">Aperçu de l'espace de travail</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right-icon lucide-chevron-right"><path d="m9 18 6-6-6-6"/></svg>

                    <a
                        href="/organizations/plan/{{$organization->id}}"
                        class="text-[10px] flex items-center gap-1.5 px-2 py-0.5
                    rounded border transition-all hover:scale-105 active:scale-95 cursor-pointer
                    {{ $organization->plan === "free" ? "bg-slate-100 text-slate-600 border-slate-200 hover:bg-slate-200" :
                        "bg-gradient-to-r from-indigo-600 to-purple-600 text-white border-transparent shadow-sm"}}">
                        @if ($organization->plan === "free")
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-zap-icon lucide-zap">
                                <path d="M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14z"/>
                            </svg>
                            GRATUIT
                            <span class="opacity-70 border-1 border-white/20 pl-1.5 ml-0.5">Mettre à niveau</span>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-crown-icon lucide-crown"><path d="M11.562 3.266a.5.5 0 0 1 .876 0L15.39 8.87a1 1 0 0 0 1.516.294L21.183 5.5a.5.5 0 0 1 .798.519l-2.834 10.246a1 1 0 0 1-.956.734H5.81a1 1 0 0 1-.957-.734L2.02 6.02a.5.5 0 0 1 .798-.519l4.276 3.664a1 1 0 0 0 1.516-.294z"/><path d="M5 21h14"/></svg>
                            PREMIUM
                            <span class="opacity-70 border-1 border-white/20 pl-1.5 ml-0.5">Gérer</span>
                        @endif
                    </a>
                </div>
            </div>
        </div>

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Oups !</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <h1 class="text-3xl font-extrabold text-gray-800 mb-8 tracking-tight border-b-2 border-indigo-400 pb-2">
            <i class="fas fa-sitemap mr-3 text-indigo-600"></i>
            {{ $organization->name }}
            <p class="text-sm font-bold text-gray-500 mt-2 pt-2 border-t border-gray-100">Détails de l'Organisation</p>

        </h1>


        @can('createMember', $organization)
        <div class="bg-white shadow-lg border-t-4 border-green-500 rounded-lg p-6 mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-user-plus mr-3 text-green-500"></i>
                Ajouter un membre
            </h2>
            <form action="{{ route('organizations.member.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="email" class="block font-medium text-sm text-gray-700 mb-1">Email du membre</label>
                    <input type="email" name="email" id="email" required
                        class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring-green-500 p-2 transition duration-150"
                        placeholder="exemple@domain.com">
                    @error('email')
                        <p class="text-red-600 text-xs mt-1 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="role" class="block font-medium text-sm text-gray-700 mb-1">Rôle</label>
                    <select name="role" id="role" required
                        class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring-green-500 p-2 transition duration-150 capitalize">
                        <option value="member">Membre</option>
                        <option value="admin">Admin</option>
                    </select>
                    @error('role')
                        <p class="text-red-600 text-xs mt-1 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <input type="hidden" name="organization_id" value="{{ $organization->id }}">

                @error('user_id')
                    <p class="text-red-600 text-xs mt-1 font-semibold">{{ $message }}</p>
                @enderror

                <button type="submit"
                    class="w-full bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-semibold px-4 py-2 rounded-lg shadow-md hover:shadow-lg transition duration-300 flex items-center justify-center space-x-2">
                    <i class="fas fa-paper-plane text-sm"></i>
                    <span>Ajouter ce membre</span>
                </button>
            </form>
        </div>
        @endcan
        <div class="bg-white shadow-lg border-t-4 border-blue-500 rounded-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-users mr-3 text-blue-500"></i>
                Liste des membres
            </h2>

            <div class="overflow-x-auto rounded-lg border border-gray-200">
                <table class="min-w-full text-left border-collapse">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="py-3 px-4 text-sm font-bold text-gray-700">Nom</th>
                            <th class="py-3 px-4 text-sm font-bold text-gray-700">Email</th>
                            <th class="py-3 px-4 text-sm font-bold text-gray-700">Rôle</th>
                            <th class="py-3 px-4 text-sm font-bold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($organization->members as $member)
                        <tr class="border-b last:border-b-0 hover:bg-blue-50/50 transition duration-150">
                            <td class="py-3 px-4 text-sm text-gray-800">{{ $member->oneUser->getFullName() }}</td>
                            <td class="py-3 px-4 text-sm text-gray-800">{{ $member->oneUser->email }}</td>
                            <td class="py-3 px-4 text-sm capitalize">
                                <span class="px-2 py-0.5 rounded-full text-xs font-semibold
                                    @if($member->role === 'admin')
                                        bg-indigo-100 text-indigo-700
                                    @else
                                        bg-gray-200 text-gray-700
                                    @endif">
                                    {{ $member->role }}
                                </span>
                            </td>


                            @can('deleteMember', [$organization, \App\Models\User::find($member->user_id)])
                                <td class="py-3 px-4">
                                    <form action="{{ route('organizations.member.delete', $member) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-xs font-medium shadow-md transition duration-150 flex items-center space-x-1">
                                            <i class="fas fa-trash-alt text-xs"></i>
                                            <span>Supprimer</span>
                                        </button>
                                    </form>
                                </td>
                            @endcan

                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-4 px-4 text-center text-gray-500 bg-white">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                Aucun membre pour cette organisation.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto p-4 sm:p-6 lg:p-8">
        @include('components.survey.modal-form-survey', ['organization' => $organization])
    </div>

    <div class="max-w-4xl mx-auto p-4 sm:p-6 lg:p-8 space-y-6">

        <h2 class="text-2xl font-bold text-gray-800 border-b pb-2">Sondages de l'Organisation</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            @forelse($surveys as $survey)
                <div class="bg-white shadow-xl rounded-xl overflow-hidden border border-gray-100 transition duration-300 hover:shadow-2xl flex flex-col justify-between cursor-pointer"
                    onclick="window.location='{{ route('survey.show', $survey->id) }}'">

                    <div class="p-6 space-y-4">
                        <div class="flex justify-between items-start border-b pb-3">
                            <h3 class="text-xl font-semibold text-blue-700">
                                {{ $survey->title }}
                            </h3>

                            <form action="{{ route('surveys.destroy', $survey) }}" method="POST"
                                onclick="event.stopPropagation()"
                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce sondage ? Cette action est irréversible.');">
                                @csrf
                                @method('DELETE')

                                <button type="submit" title="Supprimer le sondage"
                                    class="text-sm font-medium text-red-600 p-2 rounded-full hover:bg-red-50 transition duration-150 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 6h6v10H7V6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Supprimer
                                </button>
                            </form>
                        </div>

                        <div>
                            <p class="text-gray-500 italic mb-2 text-sm">Description du Sondage:</p>
                            <p class="text-gray-700 leading-relaxed line-clamp-3">
                                {{ Str::limit($survey->description, 150) }}
                            </p>
                        </div>
                    </div>
                </div>

            @empty
                <div class="p-6 text-center bg-white rounded-xl shadow-md border border-gray-200 md:col-span-2">
                    <p class="text-gray-500 italic">Aucun sondage n'a été trouvé pour cette organisation.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
