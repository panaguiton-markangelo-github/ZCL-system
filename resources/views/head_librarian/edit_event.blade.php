<x-hlibrarian-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __("Edit event's details") }}
            </h2>

            {{-- {{if auth() }} --}}
           
            {{-- <x-button target="_blank" href="https://github.com/kamona-wd/kui-laravel-breeze" variant="black"
                class="justify-center max-w-xs gap-2">
                <span>Cart</span>
                
            </x-button> --}}

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
            action="/head_librarian/update/event/{{ $event->id }}"
            class="p-6"
        >
            @csrf
            @method('PUT')
    
           
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Note: After clicking the confirm button, the details of this event will be updated.') }}
            </p>

            <!-- Title -->
            <div class="mt-6 space-y-6">
                <x-form.label
                    for="title"
                    :value="__('Title')"
                />

                <x-form.input
                    id="title"
                    name="title"
                    type="text"
                    class="block w-3/4"
                    :value="$event->title"
                    placeholder="{{ __('Title') }}"
                    required
                    autofocus
                />

                @error('title')
                    <p class="text-red-500 text-xs p-1">
                        @error('title')
                            {{ $message }}
                        @enderror
                    </p>
                @enderror 
            </div>

            <!-- Description -->

            <div class="mt-6 space-y-6">
                <x-form.label
                    for="description"
                    :value="__('Description (maximum of 300 characters)')"
                />

                <textarea 
                    name="description" 
                    id="description" 
                    cols="60" 
                    rows="10" 
                    class="block w-3/4 py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring
                    focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1
                    dark:text-gray-300 dark:focus:ring-offset-dark-eval-1"    
                    required
                    autofocus
                    maxlength="300"
                >

                    {{$event->description}}

                </textarea>

               

                @error('description')
                    <p class="text-red-500 text-xs p-1">
                        @error('description')
                            {{ $message }}
                        @enderror
                    </p>
                @enderror 
            </div>

            <!-- Date -->

            <div class="mt-6 space-y-6">
                <x-form.label
                    for="Date"
                    :value="__('Date')"
                />

               
            <x-form.input
                id="date"
                name="date"
                type="date"
                class="block w-3/4"
                :value="$event->date"
                placeholder="{{ __('Date') }}"
                required
                autofocus
            />
            

                @error('date')
                    <p class="text-red-500 text-xs p-1">
                        @error('date')
                            {{ $message }}
                        @enderror
                    </p>
                @enderror 
            </div>

            
            

            <!-- Buttons -->
            <div class="mt-6 flex justify-end">
                <x-button
                    variant="secondary"
                    href="{{route('head_librarian.view.events')}}"
                >
                    {{ __('Cancel') }}
                </x-button>

                <x-button
                    variant="success"
                    class="ml-3"
                >
                    {{ __('Confirm') }}
                </x-button> 
            </div>
        </form>

        <hr>
        <br>
        <div class="flex justify-center text-center">
                 
            
            <div class="sm:rounded-lg">
                <div class="max-w-xl">
                    @include('head_librarian.partials.del_confirm_event')
                </div>
            </div>   
            
        </div>
    </div>

   
</x-hlibrarian-layout>



