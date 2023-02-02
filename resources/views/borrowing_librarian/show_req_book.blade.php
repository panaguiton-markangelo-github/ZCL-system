<x-blibrarian-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __("Information for this request") }}
            </h2>

        </div>
    </x-slot>

    
    <div class="p-6 mt-2 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">

        <p class="mt-1 font-bold text-xl text-gray-600 dark:text-gray-400 text-center">
            {{ __('Book Request Information') }} (Request Status: {{$request_book[0]->bookReqStatus}})
        </p>

        <p class="mt-1 font-bold text-md text-gray-600 dark:text-gray-400 text-center">
            {{ __('Request Date: ') }} {{$request_book[0]->created_at}}
        </p>

        <br>
        <hr>
        <br>

        <p class="mt-1 font-bold text-xl text-gray-600 dark:text-gray-400 text-center">
            {{ __('Book Details') }}
        </p>

        <br>
        <hr>

        <div class="grid grid-cols-4 gap-4 text-center">
            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('Title: ') }} {{$request_book[0]->title}} 
                </p>
            </div>
            
            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('Author: ') }} {{$request_book[0]->author}} 
                </p>

            </div>

            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('Published: ') }} {{$request_book[0]->published}} 
                </p>

            </div>

            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('Subject: ') }} {{$request_book[0]->subject}} 
                </p>

            </div>
        </div>

        <br>

        <div class="grid grid-cols-2 gap-2 text-center">
            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('Publisher: ') }} {{$request_book[0]->publisher}} 
                </p>
            </div>
            
            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('ISBN: ') }} {{$request_book[0]->isbn}} 
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
                {{ __('Summary: ') }} {{$request_book[0]->summary}} 
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
                    {{ __('Collection: ') }} {{$request_book[0]->collection}} 
                </p>
            </div>
            
            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('Shelf Location: ') }} {{$request_book[0]->shelf_location}} 
                </p>

            </div>

            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('Book Status: ') }} {{$request_book[0]->status}} 
                </p>

            </div>
        </div>

        <br>
        <br>

        <p class="mt-1 font-bold text-xl text-gray-600 dark:text-gray-400 text-center">
            {{ __('Borrower Information') }}
        </p>

        <br>
        <hr>

        <div class="grid grid-cols-5 gap-5 text-center">
            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('First Name: ') }} {{$request_book[0]->firstName}} 
                </p>
            </div>
            
            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('Last Name: ') }} {{$request_book[0]->lastName}} 
                </p>

            </div>

            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('Email: ') }} {{$request_book[0]->email}} 
                </p>

            </div>

            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('Phone: ') }} {{$request_book[0]->phone}} 
                </p>

            </div>

            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('Borrower Card Status: ') }} {{$request_book[0]->memberStatus}} 
                </p>

            </div>

        </div>


        
        <!-- Buttons -->
        <div class="mt-6 flex justify-end">
            <x-button
                href="{{route('borrowing_librarian.requested_books.view')}}"
            >
                {{ __('Go Back') }}
            </x-button>

        </div>

        @if ($request_book[0]->memberStatus == 'PENDING')
            <p class="text-sm text-red-600 dark:text-red-400 text-center font-bold">
                The Borrower Card Application of this borrower is not yet approved!
            </p>

        @endif

        <br>
        <hr>
        <br>

        @if ($request_book[0]->memberStatus == 'DECLINED')
            <p class="text-sm text-red-600 dark:text-red-400 text-center font-bold">
                The Borrower Card Application of this borrower was declined! Thus you cannot
                approve nor decline this book borrow request.
            </p>
        @else
            @if ($request_book[0]->bookReqStatus == 'PENDING')
                @if ($request_book[0]->status == 'BORROWED')
                    <p class="text-sm text-red-600 dark:text-red-400 text-center font-bold">
                        The book that this borrower is requesting to borrow is already borrowed.
                    </p>
                    <br>
                @endif

                <div class="grid grid-cols-2 gap-2 text-center">
                    
                    <div class="sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('borrowing_librarian.partials.approve_book')
                        </div>
                    </div>   

                    <div class="sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('borrowing_librarian.partials.decline_book')
                        </div>
                    </div>   
                    
                </div>
            @endif

            @if ($request_book[0]->bookReqStatus == 'APPROVED')
                <div class="flex justify-center text-center">
                    
                    <p class="text-sm text-cyan-600 dark:text-cyan-400 text-center font-bold">
                        You have approved this Book Borrow Request.
                    </p>
                    
                </div>
            @endif

            @if ($request_book[0]->bookReqStatus == 'DECLINED')
                <div class="flex justify-center text-center">
                    
                    <p class="text-sm text-cyan-600 dark:text-cyan-400 text-center font-bold">
                        You have declined this Book Borrow Request.
                    </p> 
                    
                </div>
            @endif
            
        @endif
        

    </div>

   
</x-blibrarian-layout>



