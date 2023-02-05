<x-hlibrarian-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Dashboard') }}
            </h2>

            
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        {{ __("Welcome Head Librarian ")  }} {{Auth::guard('librarians')->user()->firstName}} {{Auth::guard('librarians')->user()->lastName}}
        {{ __("!")  }}

    </div>

    <br>


    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1 grid grid-cols-2 gap-1">

        <div class="flex justify-center">
            <div class="block py-6 px-6 rounded-lg shadow-lg  w-1/2">
                <h5 class=" text-xl leading-tight font-medium mb-2 text-center"> 
                    <i class="fa-solid fa-calendar text-2xl"></i> Total events
                </h5>
                <p class=" text-base mb-4">
                    @if ($events == 0)
                        There are currently no events.
                    @endif

                    @if ($events == 1)
                        There is currently {{$events}} event.
                    @endif

                    @if ($events > 1)
                        There are currently {{$events}} events.
                    @endif
                </p>

            </div>
        </div>

        <div class="flex justify-center">
            <div class="block py-6 px-6 rounded-lg shadow-lg  w-1/2">
                <h5 class="text-xl leading-tight font-medium mb-2 text-center"> 
                    <i class="fa-solid fa-bullhorn text-2xl"></i> Total announcements 
                </h5>
                <p class=" text-base mb-4">
                    @if ($announcements == 0)
                    There are currently no announcements.
                    @endif

                    @if ($announcements == 1)
                        There is currently {{$announcements}} announcement.
                    @endif

                    @if ($announcements > 1)
                        There are currently {{$announcements}} announcements.
                    @endif
                </p>

            </div>
        </div>

        <div class="flex justify-center">
            <div class="block py-6 px-6 rounded-lg shadow-lg  w-1/2">
                
                <h5 class="text-xl leading-tight font-medium mb-2 text-center"> 
                    <i class="fa-solid fa-users text-2xl"></i> Total users 
                </h5>
                <p class="text-base mb-4">

                @if ($users == 0)
                    There are currently no registered users.
                @endif

                @if ($users == 1)
                    There is currently {{$users}} registered user.
                @endif

                @if ($users > 1)
                    There are currently {{$users}} registered users.
                @endif
                
                </p>

            </div>
        </div>

        <div class="flex justify-center">
            <div class="block py-6 px-6 rounded-lg shadow-lg  w-1/2">
                <h5 class=" text-xl leading-tight font-medium mb-2 text-center"> 
                    <i class="fa-solid fa-book text-2xl"></i> Total books
                </h5>
                <p class=" text-base mb-4">
                    @if ($books == 0)
                        There are currently no registered books.
                    @endif

                    @if ($books == 1)
                        There is currently {{$books}} registered book.
                    @endif

                    @if ($books > 1)
                        There are currently {{$books}} registered books..
                    @endif
                </p>

            </div>
        </div>
       
        
          
    </div>


</x-hlibrarian-layout>

