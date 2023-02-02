<section>
    <header>
        <h2 class="text-lg font-medium">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('librarian.verification.send') }}">
        @csrf
    </form>

    <form
        method="post"
        action="{{ route('librarian.profile.update') }}"
        class="mt-6 space-y-6"
    >
        @csrf
        @method('patch')

        <div class="space-y-2">
            <x-form.label
                for="firstName"
                :value="__('First Name')"
            />

            <x-form.input
                id="firstName"
                name="firstName"
                type="text"
                class="block w-full"
                :value="old('firstName', $user->firstName)"
                required
                autofocus
                autocomplete="firstName"
            />

            <x-form.error :messages="$errors->get('firstName')" />
        </div>

        <div class="space-y-2">
            <x-form.label
                for="lastName"
                :value="__('Last Name')"
            />

            <x-form.input
                id="lastName"
                name="lastName"
                type="text"
                class="block w-full"
                :value="old('lastName', $user->lastName)"
                required
                autofocus
                autocomplete="lastName"
            />

            <x-form.error :messages="$errors->get('lastName')" />
        </div>

        <div class="space-y-2">
            <x-form.label
                for="email"
                :value="__('Email')"
            />

            <x-form.input
                id="email"
                name="email"
                type="email"
                class="block w-full"
                :value="old('email', $user->email)"
                required
                autocomplete="email"
            />

            <x-form.error :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-300">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500  dark:text-gray-400 dark:hover:text-gray-200 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-button>
                {{ __('Save') }}
            </x-button>
        </div>
    </form>
</section>
