<div class="fixed top-5 right-4 z-[60] flex flex-col gap-4 w-full max-w-sm">

    @if (session('success'))
        <div id="toast-success" x-data="{ show: true }" x-show="show" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
            x-init="setTimeout(() => show = false,2000)"
            class="flex items-center w-full p-4 text-gray-500 bg-white rounded-lg shadow border border-gray-200"
            role="alert">
            <div class="inline-flex items-center justify-center shrink-0 w-7 h-7 text-green-500 bg-green-100 rounded">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 11.917 9.724 16.5 19 7.5" />
                </svg>
                <span class="sr-only">Check icon</span>
            </div>
            <div class="ms-3 text-sm font-normal">{{ session('success') }}</div>
            <button @click="show = false" type="button"
                class="ms-auto flex items-center justify-center text-gray-400 hover:text-gray-900 bg-transparent box-border border border-transparent hover:bg-gray-100 focus:ring-4 focus:ring-gray-300 font-medium leading-5 rounded text-sm h-8 w-8 focus:outline-none"
                aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18 17.94 6M18 18 6.06 6" />
                </svg>
            </button>
        </div>

    @elseif (session('error'))
        <div id="toast-danger" x-data="{ show: true }" x-show="show" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
            x-init="setTimeout(() => show = false,2000)"
            class="flex items-center w-full p-4 text-gray-500 bg-white rounded-lg shadow border border-gray-200"
            role="alert">
            <div class="inline-flex items-center justify-center shrink-0 w-7 h-7 text-red-500 bg-red-100 rounded">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18 17.94 6M18 18 6.06 6" />
                </svg>
                <span class="sr-only">Error icon</span>
            </div>
            <div class="ms-3 text-sm font-normal">{{ session('error') }}</div>
            <button type="button" @click="show = false"
                class="ms-auto flex items-center justify-center text-gray-400 hover:text-gray-900 bg-transparent box-border border border-transparent hover:bg-gray-100 focus:ring-4 focus:ring-gray-300 font-medium leading-5 rounded text-sm h-8 w-8 focus:outline-none"
                aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18 17.94 6M18 18 6.06 6" />
                </svg>
            </button>
        </div>

    @elseif (session('warning'))
        <div id="toast-warning" x-data="{ show: true }" x-show="show" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
            x-init="setTimeout(() => show = false,2000)"
            class="flex items-center w-full p-4 text-gray-500 bg-white rounded-lg shadow border border-gray-200"
            role="alert">
            <div class="inline-flex items-center justify-center shrink-0 w-7 h-7 text-orange-500 bg-orange-100 rounded">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 13V8m0 8h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <span class="sr-only">Warning icon</span>
            </div>
            <div class="ms-3 text-sm font-normal">{{ session('warning') }}</div>
            <button type="button" @click="show = false"
                class="ms-auto flex items-center justify-center text-gray-400 hover:text-gray-900 bg-transparent box-border border border-transparent hover:bg-gray-100 focus:ring-4 focus:ring-gray-300 font-medium leading-5 rounded text-sm h-8 w-8 focus:outline-none"
                aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18 17.94 6M18 18 6.06 6" />
                </svg>
            </button>
        </div>
    @endif
</div>