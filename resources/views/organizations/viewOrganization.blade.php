<x-app-layout>
    <div class="max-w-4xl mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">{{ $organization->name }}</h1>

        {{-- Ajouter un membre --}}
        <div class="bg-white shadow-md rounded p-4 mb-6">
            <h2 class="text-xl font-semibold mb-2">Ajouter un membre</h2>
            <form action="{{ route('organizations.member.store') }}" method="POST" class="space-y-3">
                @csrf

                <div>
                    <label for="email" class="block font-medium text-sm">Email du membre</label>
                    <input type="email" name="email" id="email"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                           placeholder="exemple@domain.com">
                    @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="role" class="block font-medium text-sm">Rôle</label>
                    <select name="role" id="role"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="member">Membre</option>
                        <option value="admin">Admin</option>
                    </select>
                    @error('role')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <input type="hidden" name="organization_id" value="{{ $organization->id }}">

                @error('user_id')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                    Ajouter
                </button>
            </form>
        </div>

        {{-- Liste des membres --}}
        <div class="bg-white shadow-md rounded p-4">
            <h2 class="text-xl font-semibold mb-2">Liste des membres</h2>
            <table class="w-full text-left border-collapse">
                <thead>
                <tr class="border-b">
                    <th class="py-2 px-4">Nom</th>
                    <th class="py-2 px-4">Email</th>
                    <th class="py-2 px-4">Rôle</th>
                    <th class="py-2 px-4">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($organization->members as $member)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-2 px-4">{{ $member->oneUser->getFullName() }}</td>
                        <td class="py-2 px-4">{{ $member->oneUser->email }}</td>
                        <td class="py-2 px-4 capitalize">{{ $member->role }}</td>
                        <td class="py-2 px-4">
                            <form action="{{ route('organizations.member.delete', $member->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-xs">
                                    Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-2 px-4 text-center text-gray-500">
                            Aucun membre pour cette organisation.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
