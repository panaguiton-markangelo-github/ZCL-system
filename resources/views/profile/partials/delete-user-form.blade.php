<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    @if (!session('member.0.id'))
        <x-button
                variant="danger"
                x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            >
                {{ __('Delete Account') }}
        </x-button>
    @endif

    @if (session('member.0.id'))
        @if(count($request_book) == 0)
            <x-button
                variant="danger"
                x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            >
                {{ __('Delete Account') }}
            </x-button>
        @endif

        @if(count($request_book) > 0)
            <p class="text-sm text-gray-600 dark:text-gray-400">
                {{ __('Delete account button is disabled.') }}
            </p>

            <x-button
                variant="secondary"
                disabled="true"
            >
                {{ __('Delete Account') }}
            </x-button>

            <p class="text-sm text-orange-600 dark:text-orange-500">
                {{ __('Note: You cannot delete your account, because you still have pending transactions (such as borrowed books are not yet returned.)') }}
            </p>
        @endif
    @endif

    
    <x-modal
        name="confirm-user-deletion"
        :show="$errors->userDeletion->isNotEmpty()"
        focusable
    >
        <form
            method="post"
            action="{{ route('profile.destroy') }}"
            class="p-6"
        >
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6 space-y-6">
                <x-form.label
                    for="delete-user-password"
                    value="Password"
                    class="sr-only"
                />

                <x-form.input
                    id="delete-user-password"
                    name="password"
                    type="password"
                    class="block w-3/4"
                    placeholder="Password"
                />

                <x-form.error :messages="$errors->userDeletion->get('password')" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-button
                    type="button"
                    variant="secondary"
                    x-on:click="$dispatch('close')"
                >
                    {{ __('Cancel') }}
                </x-button>

                <x-button
                    variant="danger"
                    class="ml-3"
                >
                    {{ __('Delete Account') }}
                </x-button>
            </div>
        </form>
    </x-modal>
</section>
