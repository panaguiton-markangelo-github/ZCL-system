<x-hlibrarian-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Dashboard') }}
            </h2>

            {{-- {{if auth() }} --}}
           
            {{-- <x-button target="_blank" href="https://github.com/kamona-wd/kui-laravel-breeze" variant="black"
                class="justify-center max-w-xs gap-2">
                <span>button here</span>
                
            </x-button> --}}
            
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        {{ __("Welcome Head Librarian ")  }} {{Auth::guard('librarians')->user()->firstName}} {{Auth::guard('librarians')->user()->lastName}}
        {{ __("!")  }}
    </div>
</x-hlibrarian-layout>
