<x-blibrarian-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    @if (session('status') == 'password-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-green-600 dark:text-green-400 mb-2"
            >
                {{ __('Password has been successfully updated.') }}
            </p>
    @endif

    @if (session('status') === 'profile-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-green-600 dark:text-green-400 mb-2"
            >
                {{ __('Profile information has been successfully updated.') }}
            </p>
    @endif

    <div class="space-y-6">
    
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-800">
            <div class="max-w-xl">
                @include('borrowing_librarian.profile.partials.update-profile-information-form')
            </div>
        </div>


        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-800">
            <div class="max-w-xl">
                @include('borrowing_librarian.profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-800">
            <div class="max-w-xl">
                @include('borrowing_librarian.profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-blibrarian-layout>
