<section class="space-y-6">
    <x-button
        variant="success"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'add-librarian')"
    >
        <i class="fa-solid fa-plus px-1"></i>
        {{ __('Add Librarian') }}
    </x-button>

    <x-modal
        name="add-librarian"
        {{-- :show="$errors->userDeletion->isNotEmpty()" --}}
        focusable
    >
        <form
            method="post"
            action="{{ route('librarians.store') }}"
            class="p-6"
        >
            @csrf
    
            <h2 class="text-lg font-medium">
                {{ __('Register a librarian') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Note: There are two types of librarians you can create. One is the librarian for cataloging and another one is for borrowing.') }}
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
                    :value="old('firstName')"
                    placeholder="{{ __('First Name') }}"
                    required
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
                    :value="old('lastName')"
                    placeholder="{{ __('Last Name') }}"
                    required
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
                    :value="old('email')"
                    placeholder="{{ __('Email') }}"
                    required
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
                    :value="old('password')"
                    placeholder="{{ __('Password') }}"
                    required
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
                    required
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
                    dark:text-gray-300 dark:focus:ring-offset-dark-eval-1" required>

                    <option value="" selected></option>
                    <option value="2"> Librarian for Borrowing System</option>
                    <option value="3"> Librarian for Cataloging System</option>
                
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
                    type="button"
                    variant="secondary"
                    x-on:click="$dispatch('close')"
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
    </x-modal>
</section>
