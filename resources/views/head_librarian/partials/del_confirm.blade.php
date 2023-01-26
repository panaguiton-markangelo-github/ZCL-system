<section class="space-y-6">
    <x-button
        variant="danger"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'del-confirm-librarian')"
    >
        <i class="fa-solid fa-user-xmark mx-2"></i>
        {{ __('Delete this Librarian account credentials') }}
    </x-button>

    <x-modal
        name="del-confirm-librarian"
        {{-- :show="$errors->userDeletion->isNotEmpty()" --}}
        focusable
    >

        <form
            method="post"
            action="/head_librarian/delete/librarian/{{ $user->id }}"
            class="p-6"
        >
            @csrf
        
            @method('delete')

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Note: Proceed with caution, this will delete the account credentials for this librarian permanently.') }}
            </p>
            
            <input type="number" name="id" value= {{ $user->id }} hidden>
            


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
