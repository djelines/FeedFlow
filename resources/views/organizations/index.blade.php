<x-app-layout>

    <div class="p-4 sm:p-6 lg:p-8">

        <h1 class="text-3xl font-extrabold text-gray-800 mb-8 tracking-tight border-b-2 border-indigo-400 pb-2">
            Mes Organisations
        </h1>

        <div class="mb-10 p-5 bg-white shadow-lg border-t-4 border-green-500 rounded-xl">
            <h2 class="font-bold text-xl mb-4 text-gray-700 flex items-center">
                <i class="fas fa-plus-circle h-5 w-5 mr-3 text-green-500"></i>
                Créer une nouvelle organisation
            </h2>
            <form method="POST" action="{{ route('organizations.store') }}" class="flex flex-col sm:flex-row sm:space-x-3 space-y-3 sm:space-y-0 items-end">
                @csrf
                <div class="flex-grow w-full">
                    <label for="name_create" class="block text-sm font-medium text-gray-600 mb-1">Nom de l'organisation</label>
                    <input type="text" id="name_create" name="name" required
                           class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring-green-500 transition duration-150 ease-in-out p-2">
                </div>
                <button type="submit"
                        class="w-full sm:w-auto px-4 py-2 bg-gradient-to-r from-green-500 to-green-600 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition duration-300 ease-in-out flex items-center justify-center space-x-2">
                    <i class="fas fa-plus text-xs"></i>
                    <span>Créer</span>
                </button>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

            @forelse($organizations as $organization)
                <div class="organization-card relative bg-white shadow-xl border-l-4 border-blue-500 rounded-lg p-5 hover:shadow-2xl transition duration-300">

                    <a href="{{ route('organizations.viewOrganization', $organization->id) }}" class="block text-gray-800 border-b border-gray-100 pb-3 mb-3 hover:text-blue-600 transition duration-150">
                        <div class="flex justify-between items-start">
                            <h2 class="font-extrabold text-lg leading-tight">
                                {{$organization->name}}
                            </h2>
                            <span class="p-1 rounded-full text-indigo-500 flex-shrink-0 flex items-center justify-center">
                                <i class="fas fa-arrow-right text-sm"></i>
                            </span>
                        </div>
                    </a>

                    <div class="pt-2 border-b border-gray-100 pb-4 mb-4">
                        <form method="POST" action="{{ route('organizations.update', $organization->id) }}">
                            @method('PUT')
                            @csrf
                            <h3 class="text-sm font-semibold mb-2 text-gray-600 flex items-center space-x-1">
                                <i class="fas fa-edit text-blue-400 text-xs"></i>
                                <span>Modifier le nom</span>
                            </h3>

                            <div class="mb-3">
                                <label for="name_{{ $organization->id }}" class="sr-only">Nom de l'organisation</label>
                                <input type="text" id="name_{{ $organization->id }}" name="name" value="{{ $organization->name }}" required
                                       class="w-full text-sm border-gray-300 rounded-lg shadow-inner focus:border-blue-500 focus:ring-blue-500 p-2">
                            </div>

                            <button type="submit"
                                    class="w-full bg-blue-500 text-white py-1.5 rounded-md text-xs font-semibold hover:bg-blue-600 transition duration-150 ease-in-out shadow flex items-center justify-center space-x-1">
                                <i class="fas fa-save text-xs"></i>
                                <span>Enregistrer la modification</span>
                            </button>
                        </form>
                    </div>

                    <div class="pt-2">
                        <form method="POST" action="{{ route('organizations.delete', $organization->id) }}">
                            @method('DELETE')
                            @csrf
                            <button type="submit"
                                    class="w-full bg-red-500 text-white py-1.5 rounded-md text-xs font-semibold hover:bg-red-600 transition duration-150 ease-in-out shadow flex items-center justify-center space-x-1">
                                <i class="fas fa-trash-alt text-xs"></i>
                                <span>Supprimer l'organisation</span>
                            </button>
                        </form>
                    </div>

                </div>
            @empty
                <div class="col-span-full text-lg text-gray-500 p-10 bg-white rounded-lg shadow-inner border border-gray-200">
                    <p class="text-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        Aucune organisation trouvée. Créez-en une pour commencer !
                    </p>
                </div>
            @endforelse
        </div>

    </div>

</x-app-layout>
