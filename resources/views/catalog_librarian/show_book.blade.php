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

        <div>
            <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                {{ __('Title: ') }} {{$book->title}} 
            </p>
        </div>

        <br>

        <div class="grid grid-cols-2 gap-2 text-start">
            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('Author: ') }} {{$book->author}} 
                </p>
    
            </div>

            <div class="grid grid-cols-1 gap-1 text-start">
                <div>
                    <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                        {{ __('Call No: ') }} {{$book->call_no}} 
                    </p>
                </div>
                
                <div>
                    <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                        {{ __('LC: ') }} {{$book->lc}} 
                    </p>
    
                </div>
    
                <div>
                    <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                        {{ __('DDC: ') }} {{$book->ddc}} 
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-2 text-start">
                    <div>
                        <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                            {{ __('Author No: ') }} {{$book->author_no}} 
                        </p>
    
                    </div>
                    
                    <div>
                        <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                            {{ __('©: ') }} {{$book->c}} 
                        </p>
    
                    </div>
                </div>

                <div>
                    <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                        {{ __('Section: ') }} {{$book->section}} 
                    </p>
                </div>

            </div>
            
        </div>

        <br>

        <div>
            <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                {{ __('Published: ') }} {{$book->published}} 
            </p>

        </div>

        <br>

        <div class="grid grid-cols-2 gap-2 text-start">

            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('Place of Pub: ') }} {{$book->place_pub}} 
                </p>
            </div>

            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('Publisher: ') }} {{$book->publisher}} 
                </p>
            </div>
            
        </div>

        <br>

        <div class="grid grid-cols-2 gap-2 text-start">
            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('Edition/Vol: ') }} {{$book->edition_vol}} 
                </p>
    
            </div>
    
            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('Source: ') }} {{$book->source}} 
                </p>
    
            </div>
        </div>

        <br>

        <div class="grid grid-cols-2 gap-2 text-start">
            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('ISBN: ') }} {{$book->isbn}} 
                </p>

            </div>

            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('Series: ') }} {{$book->series}} 
                </p>
            </div>
        </div>
        
        <br>

        <div class="grid grid-cols-2 gap-2 text-start">
            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('Pagination: ') }} {{$book->pagination}} 
                </p>
            </div>
            
            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('Incls: ') }} {{$book->incls}} 
                </p>

            </div>
        </div>

        <br>

        <div class="grid grid-cols-4 gap-4 text-start">
            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('Date Acquired: ') }} {{$book->date_acq}} 
                </p>
            </div>
            
            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('Property No: ') }} {{$book->property_no}} 
                </p>

            </div>

            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('Acc. No: ') }} {{$book->acc_no}} 
                </p>
            </div>
            
            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('Amount: ') }} {{$book->amount}} 
                </p>

            </div>
        </div>

        <br>

        <div>
            <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                {{ __('Subject: ') }} {{$book->subject}} 
            </p>

        </div>

        <br>

        <hr>
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

        <hr>
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



