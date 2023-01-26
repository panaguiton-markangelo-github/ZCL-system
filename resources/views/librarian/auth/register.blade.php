<x-librarian-guest-layout>
    <x-auth-card>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        @if ($hLibrarian != 0)
            <p class="text-sm text-gray-600 dark:text-gray-400">
                {{ __('An account is already existing for head librarian ') }}
                <a href="{{ route('librarian.login') }}" class="text-blue-500 hover:underline">
                    {{ __('Login here') }}
                </a>
            </p>
        @endif

        @if ($hLibrarian == 0)
        <h3 class="text-2xl font-bold text-center">Create an account for Head Librarian</h3>
        <form method="POST" action="{{ route('librarian.register') }}">
            @csrf

            <div class="grid gap-6">
                <!-- FIRST NAME -->
                <div class="space-y-2">
                    <x-form.label
                        for="firstName"
                        :value="__('First Name')"
                    />

                    <x-form.input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-user aria-hidden="true" class="w-5 h-5" />
                        </x-slot>

                        <x-form.input
                            withicon
                            id="firstName"
                            class="block w-full"
                            type="text"
                            name="firstName"
                            :value="old('firstName')"
                            required
                            autofocus
                            placeholder="{{ __('First Name') }}"
                        />
                    </x-form.input-with-icon-wrapper>
                </div>

                <!-- LAST NAME -->
                <div class="space-y-2">
                    <x-form.label
                        for="lastName"
                        :value="__('Last Name')"
                    />

                    <x-form.input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-user aria-hidden="true" class="w-5 h-5" />
                        </x-slot>

                        <x-form.input
                            withicon
                            id="lastName"
                            class="block w-full"
                            type="text"
                            name="lastName"
                            :value="old('lastName')"
                            required
                            autofocus
                            placeholder="{{ __('Last Name') }}"
                        />
                    </x-form.input-with-icon-wrapper>
                </div>

                <!-- Email Address -->
                <div class="space-y-2">
                    <x-form.label
                        for="email"
                        :value="__('Email')"
                    />

                    <x-form.input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-mail aria-hidden="true" class="w-5 h-5" />
                        </x-slot>

                        <x-form.input
                            withicon
                            id="email"
                            class="block w-full"
                            type="email"
                            name="email"
                            :value="old('email')"
                            required
                            placeholder="{{ __('Email') }}"
                        />
                    </x-form.input-with-icon-wrapper>
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <x-form.label
                        for="password"
                        :value="__('Password')"
                    />

                    <x-form.input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-lock-closed aria-hidden="true" class="w-5 h-5" />
                        </x-slot>

                        <x-form.input
                            withicon
                            id="password"
                            class="block w-full"
                            type="password"
                            name="password"
                            required
                            autocomplete="new-password"
                            placeholder="{{ __('Password') }}"
                        />
                    </x-form.input-with-icon-wrapper>
                </div>

                <!-- Confirm Password -->
                <div class="space-y-2">
                    <x-form.label
                        for="password_confirmation"
                        :value="__('Confirm Password')"
                    />

                    <x-form.input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-lock-closed aria-hidden="true" class="w-5 h-5" />
                        </x-slot>

                        <x-form.input
                            withicon
                            id="password_confirmation"
                            class="block w-full"
                            type="password"
                            name="password_confirmation"
                            required
                            placeholder="{{ __('Confirm Password') }}"
                        />
                    </x-form.input-with-icon-wrapper>
                </div>

                <div>
                    @if ($hLibrarian == 0)
                        <x-button class="justify-center w-full gap-2">
                            <x-heroicon-o-user-add class="w-6 h-6" aria-hidden="true" />

                            <span>{{ __('Register') }}</span>
                        </x-button>
                    @endif
                    
                </div>

                
                @if ($hLibrarian == 0)
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Go back') }}
                        <a href="{{ route('librarian.login') }}" class="text-blue-500 hover:underline">
                            {{ __('Here') }}
                        </a>
                    </p>
                @endif

            </div>
        </form>
        @endif
        
    </x-auth-card>
</x-librarian-guest-layout>
