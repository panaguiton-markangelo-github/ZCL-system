<x-librarian-guest-layout>
    <x-auth-card>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <h3 class="text-2xl font-bold text-center">ADMIN</h3>

        <form method="POST" action="{{ route('librarian.login') }}">
            @csrf

            <div class="grid gap-6">
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
                            placeholder="{{ __('Email') }}"
                            required
                            autofocus
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
                            autocomplete="current-password"
                            placeholder="{{ __('Password') }}"
                        />
                    </x-form.input-with-icon-wrapper>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center">
                        <input
                            id="remember_me"
                            type="checkbox"
                            class="text-purple-500 border-gray-300 rounded focus:border-purple-300 focus:ring focus:ring-purple-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1"
                            name="remember"
                        >

                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Remember me') }}
                        </span>
                    </label>

                    @if (Route::has('librarian.password.request'))
                        <a class="text-sm text-blue-500 hover:underline" href="{{ route('librarian.password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <div>
                    <x-button variant="danger" class="justify-center w-full gap-2">
                        <x-heroicon-o-login class="w-6 h-6" aria-hidden="true" />

                        <span>{{ __('Log in') }}</span>
                    </x-button>
                </div>

                @if (Route::has('librarian.register'))
                    @if ($hLibrarian == 0)
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Create the account for the head librarian') }}
                            <a href="{{ route('librarian.register') }}" class="text-blue-500 hover:underline">
                                {{ __('Here') }}
                            </a>
                        </p>
                    @endif
                @endif

                <p class="text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Login as Public User') }}
                    <a href="{{ route('login') }}" class="text-blue-500 hover:underline">
                        {{ __('here') }}
                    </a>
                </p>

                <p class="text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Go back') }}
                    <a href="/" class="text-blue-500 hover:underline">
                        {{ __('home') }}
                    </a>
                </p>
                
            </div>
        </form>
    </x-auth-card>
</x-librarian-guest-layout>
