<x-app-layout>

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
