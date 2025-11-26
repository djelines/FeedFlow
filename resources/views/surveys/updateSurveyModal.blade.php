<div id="modalUpdate" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-gray-900/75 backdrop-blur-sm">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl border border-gray-200 dark:border-gray-700">
            
            <div class="flex items-center justify-between p-4 md:p-5 border-b border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700/50 rounded-t-xl">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Éditer le sondage
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modalUpdate">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Fermer</span>
                </button>
            </div>

            <form action="{{ route('surveys.update',$survey) }}" class="p-4 md:p-5" method="POST">
                @csrf
                @method("put")
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Titre du sondage
                    </label>
                    <input type="text" 
                           name="title" 
                           id="title"
                           value="{{ old('title', $survey->title) }}" 
                           required
                           class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white sm:text-sm">
                    
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
        
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Description
                    </label>
                    <textarea name="description" 
                              id="description" 
                              rows="3" 
                              required
                              class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white sm:text-sm">{{ old('description', $survey->description) }}</textarea>
                    
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="flex items-center space-x-3 mt-6 sm:grid sm:grid-cols-2 sm:space-x-4 sm:gap-3">
                     <button data-modal-hide="modalUpdate" type="button" class="w-full justify-center text-gray-900 bg-white border border-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-md text-sm px-5 py-2.5 hover:bg-gray-50 hover:text-indigo-600 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600 shadow-sm">
                        Annuler
                    </button>
                    
                    <button type="submit" class="w-full justify-center text-white inline-flex items-center bg-indigo-600 hover:bg-indigo-500 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-semibold rounded-md text-sm px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800 shadow-sm">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Sauvegarder
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>