<x-app-layout>


    <div>
        @forelse($organizations as $organization)
            <div>
                {{$organization->name}}
            </div>


            <div>
                <form method="POST" action="{{ route('organizations.update', $organization->id) }}">
                    @method('PUT')
                    @csrf
                    <h3>Modifier orga</h3>

                    <div>
                        <label for="name">Nom de l'organisation</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div>
                        <button type="submit">Creer</button>
                    </div>
                </form>
            </div>


            <div>
                <form method="POST" action="{{ route('organizations.delete', $organization->id) }}">
                    @method('DELETE')
                    @csrf

                    <h3>Delete orga</h3>
                    <div>
                        <button type="submit">Supprimer</button>
                    </div>
                </form>
            </div>
            @empty
                <div>
                    TEST
                </div>
        @endforelse
    </div>


    <div>
        <form method="POST" action="{{ route('organizations.store') }}">
            @csrf
            <div>
                <label for="name">Nom de l'organisation</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div>
                <button type="submit">Creer</button>
            </div>
        </form>
    </div>
</x-app-layout>
