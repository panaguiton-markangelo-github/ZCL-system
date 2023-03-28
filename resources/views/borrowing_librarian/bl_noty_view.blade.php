<x-blibrarian-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __("Notifications") }}
            </h2>


        </div>
    </x-slot>

    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>
    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        @forelse (auth()->guard('librarians')->user()->unreadNotifications as $notification)

        <div
            class="mb-3 hidden w-full items-center rounded-lg bg-indigo-100 py-5 px-6 text-base text-indigo-800 data-[te-alert-show]:inline-flex"
            role="alert"
            data-te-alert-init
            data-te-alert-show>

            <p> {{ $notification->data['data'] }} <br> Borrower Name: {{ $notification->data['userFirstName'] }} {{ $notification->data['userLastName'] }}</p>
            <hr>
            <a href="{{url('/markAsRead/librarian')}}/{{$notification->id}}" class="ml-auto box-content rounded-none border-none p-1 text-warning-900 opacity-50 hover:text-warning-900 hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none">
               
                <span
                    class="w-[1em] focus:opacity-100 disabled:pointer-events-none disabled:select-none disabled:opacity-25 [&.disabled]:pointer-events-none [&.disabled]:select-none [&.disabled]:opacity-25">
                    <b>mark as read</b>
                </span>
               
            </a>
            
        </div>

       
        @empty
        <p> </p>
        @endforelse 
        
    </div>



    
</x-blibrarian-layout>


