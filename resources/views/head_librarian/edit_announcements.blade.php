<x-hlibrarian-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __("Edit announcement's details") }}
            </h2>

           

        </div>
    </x-slot>

    
    <div class="p-6 mt-2 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1" style="white-space: nowrap">
    
        @if(session('message')) 
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2500)"
                class="text-sm text-green-600 dark:text-green-400 mb-2"
            >
                {{ __(session('message')) }}
            </p>
        @endif

        @if ($errors->any())

            @foreach ($errors->all() as $error)
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2500)"
                class="text-sm text-red-600 dark:text-red-400 mb-2"
            >
                {{ $error }}
            </p>
            @endforeach

        @endif 
    
        <form
            method="post"
            action="/head_librarian/update/announcement/{{ $announcement->id }}"
            class="p-6"
        >
            @csrf
            @method('PUT')
    
           
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Note: After clicking the confirm button, the details of this announcement will be updated.') }}
            </p>

            

            <!-- details -->
            <div class="mt-6 space-y-6">
                <x-form.label
                    for="details"
                    :value="__('Details (maximum of 300 characters)')"
                />

                <textarea 
                    name="details" 
                    id="details" 
                    cols="60" 
                    rows="10" 
                    class="block w-3/4 py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring
                    focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1
                    dark:text-gray-300 dark:focus:ring-offset-dark-eval-1" 
                    required
                    autofocus
                    maxlength="300"
                >

                {{$announcement->details}}

                </textarea>

                @error('details')
                    <p class="text-red-500 text-xs p-1">
                        @error('details')
                            {{ $message }}
                        @enderror
                    </p>
                @enderror 
            </div>

            
        
            

            <!-- Buttons -->
            <div class="mt-6 flex justify-end">
                <x-button
                    variant="secondary"
                    href="{{route('head_librarian.view.announcements')}}"
                >
                    {{ __('Cancel') }}
                </x-button>

                <x-button
                    variant="success"
                    class="ml-3"
                >
                    {{ __('Update') }}
                </x-button> 
            </div>
        </form>

        <hr>
        <br>
        <div class="flex justify-center text-center">
                 
            
            <div class="sm:rounded-lg">
                <div class="max-w-xl">
                    @include('head_librarian.partials.del_confirm_announcement')
                </div>
            </div>   
            
        </div>
    </div>

   
</x-hlibrarian-layout>



