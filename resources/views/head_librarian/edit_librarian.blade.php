<x-hlibrarian-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __("Edit Librarian's details") }}
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
            action="/head_librarian/update/librarian/{{ $user->id }}"
            class="p-6"
        >
            @csrf
            @method('PUT')
    
           
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Note: After clicking the confirm button, the details of this librarian will be updated.') }}
            </p>

            
            <!-- First name -->
            <div class="mt-6 space-y-6">
                <x-form.label
                    for="firstName"
                    :value="__('First Name')"
                />

                <x-form.input
                    id="firstName"
                    name="firstName"
                    type="text"
                    class="block w-3/4"
                    :value="$user->firstName"
                    placeholder="{{ __('First Name') }}"
                    autofocus
                />

                @error('firstName')
                    <p class="text-red-500 text-xs p-1">
                        @error('firstName')
                            {{ $message }}
                        @enderror
                    </p>
                @enderror 
            </div>

            <!-- Last name -->

            <div class="mt-6 space-y-6">
                <x-form.label
                    for="lastName"
                    :value="__('Last Name')"
                />

                <x-form.input
                    id="lastName"
                    name="lastName"
                    type="text"
                    class="block w-3/4"
                    :value="$user->lastName"
                    placeholder="{{ __('Last Name') }}"
                    autofocus
                />

                @error('lastName')
                    <p class="text-red-500 text-xs p-1">
                        @error('lastName')
                            {{ $message }}
                        @enderror
                    </p>
                @enderror 
            </div>

            <!-- Email -->

            <div class="mt-6 space-y-6">
                <x-form.label
                    for="email"
                    :value="__('Email')"
                />

                <x-form.input
                    id="email"
                    name="email"
                    type="email"
                    class="block w-3/4"
                    :value="$user->email"
                    placeholder="{{ __('Email') }}"
                  
                    autofocus
                />

                @error('email')
                    <p class="text-red-500 text-xs p-1">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </p>
                @enderror 
            </div>

            <!-- Password -->

            <div class="mt-6 space-y-6">
                <x-form.label
                    for="password"
                    :value="__('Password')"
                />

                <x-form.input
                    id="password"
                    name="password"
                    type="password"
                    class="block w-3/4"
                    
                    placeholder="{{ __('Password') }}"
                   
                    autofocus
                />

                @error('password')
                    <p class="text-red-500 text-xs p-1">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </p>
                @enderror 
            </div>

            <!-- Confirm Password -->
            <div class="mt-6 space-y-6">
                <x-form.label
                    for="password_confirmation"
                    :value="__('Confirm Password')"
                />

                <x-form.input
                    id="password_confirmation"
                    class="block w-3/4"
                    type="password"
                    name="password_confirmation"
                    
                   
                    placeholder="{{ __('Confirm Password') }}"
                />

                @error('password_confirmation')
                    <p class="text-red-500 text-xs p-1">
                        @error('password_confirmation')
                            {{ $message }}
                        @enderror
                    </p>
                @enderror
            
            </div>


            <!-- Type -->

            <div class="mt-6 space-y-6">
                <x-form.label
                    for="type"
                    :value="__('Select the type of librarian')"
                />
                <select name="type" id="type" class="border-gray-400 rounded-md focus:border-gray-400 focus:ring
                    focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1
                    dark:text-gray-300 dark:focus:ring-offset-dark-eval-1">
                    
                    <option value=""></option>

                    @if($user->type == 2)
                        <option value="{{$user->type}}" selected>  
                            Librarian for Borrowing System  
                        </option>
                        <option value="3" >
                            Librarian for Cataloging System
                        </option>
                        
                    @endif

                    @if($user->type == 3)
                        <option value="2" >
                            Librarian for Borrowing System  
                        </option>
                        <option value="{{$user->type}}" selected>  
                            Librarian for Cataloging System
                        </option>
                        
                    @endif
                   
                </select>

                @error('type')
                    <p class="text-red-500 text-xs p-1">
                        @error('type')
                            {{ $message }}
                        @enderror
                    </p>
                @enderror 
            </div>


            <!-- Buttons -->
            <div class="mt-6 flex justify-end">
                <x-button
                    variant="secondary"
                    href="{{route('librarians.view')}}"
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
                    @include('head_librarian.partials.del_confirm')
                </div>
            </div>   
            
        </div>
    </div>

    {{-- Almost done with this head librarian user Finish up here--}}

   
</x-hlibrarian-layout>



