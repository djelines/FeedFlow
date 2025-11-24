<x-app-layout>

    <div class="flex flex-wrap gap-5">
        @forelse($organizations as $organization)
            <div class="bg-gray border rounded-lg px-4 py-2">

                {{-- NOUVEAU LIEN DE VISUALISATION --}}
                <a href="{{ route('organizations.viewOrganization', $organization->id) }}" class="block">
                    <div>
                        {{-- Le nom de l'organisation devient le lien cliquable principal --}}
                        <h2 class="font-bold">{{$organization->name}}</h2>
                    </div>
                </a>
                {{-- FIN DU NOUVEAU LIEN --}}

                <hr class="my-2">

                {{-- FORMULAIRE DE MODIFICATION --}}
                <div>
                    <form method="POST" action="{{ route('organizations.update', $organization->id) }}">
                        @method('PUT')
                        @csrf
                        <h3 class="mt-2 text-sm">Modifier orga</h3>

                        <div class="mt-1">
                            <label for="name_{{ $organization->id }}">Nom de l'organisation</label>
                            {{-- IMPORTANT : Utiliser l'ID de l'orga dans l'ID de l'input si la boucle est dans le même formulaire --}}
                            <input type="text" id="name_{{ $organization->id }}" name="name" value="{{ $organization->name }}" required>
                        </div>
                        <div class="mt-2">
                            {{-- ATTENTION : Le bouton doit être "Modifier", pas "Creer" --}}
                            <button type="submit" class="bg-blue-500 text-white p-1 rounded text-xs">Modifier</button>
                        </div>
                    </form>
                </div>

                <hr class="my-2">

                {{-- FORMULAIRE DE SUPPRESSION --}}
                <div>
                    <form method="POST" action="{{ route('organizations.delete', $organization->id) }}">
                        @method('DELETE')
                        @csrf
                        <h3 class="mt-2 text-sm">Supprimer orga</h3>
                        <div class="mt-2">
                            <button type="submit" class="bg-red-500 text-white p-1 rounded text-xs">Supprimer</button>
                        </div>
                    </form>
                </div>
            </div>
        @empty
            <div>
                Aucune organisation trouvée.
            </div>
        @endforelse
    </div>

    {{-- FORMULAIRE DE CRÉATION --}}
    <div class="mt-10 p-5 border rounded-lg bg-white">
        <h2 class="font-bold mb-3">Créer une nouvelle organisation</h2>
        <form method="POST" action="{{ route('organizations.store') }}">
            @csrf
            <div>
                <label for="name_create">Nom de l'organisation</label>
                <input type="text" id="name_create" name="name" required>
            </div>
            <div class="mt-3">
                <button type="submit" class="bg-green-500 text-white p-2 rounded">Créer</button>
            </div>
        </form>
    </div>
</x-app-layout>
