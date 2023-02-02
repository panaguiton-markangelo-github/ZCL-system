<x-clibrarian-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __("Additional information for") }} {{$book->title}}
            </h2>

        </div>
    </x-slot>

    
    <div class="p-6 mt-2 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">

           
        <p class="mt-1 font-bold text-xl text-gray-600 dark:text-gray-400 text-center">
            {{ __('Book Details') }}
        </p>

        <br>
        <hr>

        <div class="grid grid-cols-4 gap-4 text-center">
            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('Title: ') }} {{$book->title}} 
                </p>
            </div>
            
            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('Author: ') }} {{$book->author}} 
                </p>

            </div>

            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('Published: ') }} {{$book->published}} 
                </p>

            </div>

            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('Subject: ') }} {{$book->subject}} 
                </p>

            </div>
        </div>

        <br>

        <div class="grid grid-cols-2 gap-2 text-center">
            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('Publisher: ') }} {{$book->publisher}} 
                </p>
            </div>
            
            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('ISBN: ') }} {{$book->isbn}} 
                </p>

            </div>
        </div>

        <br>

        <p class="mt-1 font-bold text-xl text-gray-600 dark:text-gray-400 text-center">
            {{ __('Summary') }}
        </p>

        <br>
        <hr>
        
        <div>
            <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                {{ __('Summary: ') }} {{$book->summary}} 
            </p>

        </div>

        <br>

        <p class="mt-1 font-bold text-xl text-gray-600 dark:text-gray-400 text-center">
            {{ __('Book Location') }}
        </p>

        <br>
        <hr>

        <div class="grid grid-cols-3 gap-3 text-center">
            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('Collection: ') }} {{$book->collection}} 
                </p>
            </div>
            
            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('Shelf Location: ') }} {{$book->shelf_location}} 
                </p>

            </div>

            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('Status: ') }} {{$book->status}} 
                </p>

            </div>
        </div>


        
    

        <!-- Buttons -->
        <div class="mt-6 flex justify-end">
            <x-button
                href="{{route('catalog_librarian.view.books')}}"
            >
                {{ __('Go Back') }}
            </x-button>

        </div>

    </div>

   
</x-clibrarian-layout>



