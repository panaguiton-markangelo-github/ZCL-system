<x-hlibrarian-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __("Additional information for feedback") }}
            </h2>

        </div>
    </x-slot>

    
    <div class="p-6 mt-2 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">

        <p class="mt-1 font-bold text-xl text-gray-600 dark:text-gray-400 text-center">
            {{ __('User Information') }}
        </p>

        <br>
        <hr>

        <div class="grid grid-cols-2 gap-2">
            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('First Name: ') }} {{$member_info->firstName}} 
                </p>
            </div>
            
            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('Last Name: ') }} {{$member_info->lastName}} 
                </p>

            </div>

            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('Email: ') }} {{$member_info->email}} 
                </p>

            </div>

            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('Phone: ') }} {{$member_info->phone}} 
                </p>

            </div>

            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('Borrower Card Status: ') }} {{$member_info->status}} 
                </p>

            </div>

        </div>

        <br>


        <p class="mt-1 font-bold text-xl text-gray-600 dark:text-gray-400 text-center">
            {{ __('Feedback Information') }}
        </p>

        <br>
        <hr>

        <div class="grid grid-cols-2 gap-2">
            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('Comment: ') }} {{$user_id[0]->comments}} 
                </p>

            </div>
            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('Star rating: ') }} {{$user_id[0]->star_rating}} 
                </p>

            </div>
        </div>

        
        <!-- Buttons -->
        <div class="mt-6 flex justify-end">
            <x-button
                variant="danger"
                href="{{route('head_librarian.view.feedbacks')}}"
            >
                {{ __('Go Back') }}
            </x-button>

        </div>

        @if ($user_id[0]->reviewed == '0')
            <br>
            <hr>
            <br>

            <div class="flex justify-center text-center">
                <div class="sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('head_librarian.partials.confirm_review_feedback')
                    </div>
                </div>
            </div>
            

        @endif

        @if ($user_id[0]->reviewed == '1')
            <br>
            <hr>
            <br>

            <div class="flex justify-center text-center">
                        
                <p class="text-sm text-cyan-600 dark:text-cyan-400 text-center font-bold">
                    You have reviewed this feedback.
                </p> 
                
            </div>
            
        @endif

    </div>

   
</x-hlibrarian-layout>



