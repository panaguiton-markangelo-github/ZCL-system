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

        <br>

        <div class="flex justify-center">
            <img class="mr-3 border-solid border-4 border-red-500" src="{{ asset('storage/'.$book->image) }}" alt="none" width="300" height="300">
            
            <div class="grid grid-cols-2 gap-2" style="font-weight: 900">
                <div class="ml-3">
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
                            {{ __('Place of Publication: ') }} {{$book->place_pub}} 
                        </p>
                    </div>
        
                    <div>
                        <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                            {{ __('Publisher: ') }} {{$book->publisher}} 
                        </p>
                    </div>
        
                    <div>
                        <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                            {{ __('Edition/Vol: ') }} {{$book->edition_vol}} 
                        </p>
            
                    </div>
            
                    <div>
                        <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                            {{ __('Source of acquisition: ') }} {{$book->source}} 
                        </p>
            
                    </div>
        
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
        
                </div>

                <div class="ml-3">
                    <div>
                        <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                            {{ __('DDC: ') }} {{$book->ddc}} 
                        </p>
                    </div>
                    
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

                    <div>
                        <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                            {{ __('Section: ') }} {{$book->section}} 
                        </p>
                    </div>

                    <div>
                        <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                            {{ __('Pagination: ') }} {{$book->pagination}} 
                        </p>
                    </div>
                    
                    <div>
                        <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                            {{ __('Includes: ') }} {{$book->incls}} 
                        </p>
        
                    </div>

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
    
                    <div>
                        <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                            {{ __('Subject: ') }} {{$book->subject}} 
                        </p>
            
                    </div>

                </div>
            </div>
           
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
                variant="danger"
                href="{{route('catalog_librarian.view.books')}}"
            >
                {{ __('Go Back') }}
            </x-button>

        </div>

    </div>

   
</x-clibrarian-layout>



