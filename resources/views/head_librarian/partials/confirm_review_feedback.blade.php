<section class="space-y-6">
    <x-button
        variant="success"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-review')"
    >
        <i class="fa-solid fa-check-to-slot mr-2"></i>
        {{ __('Review') }}
    </x-button>

    <x-modal
        name="confirm-review"
        {{-- :show="$errors->userDeletion->isNotEmpty()" --}}
        focusable
    >

        <form
            method="post"
            action="/head_librarian/update/feedback/{{ $user_id[0]->id }}"
            class="p-6"
        >
            @csrf
        
            @method('put')

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Note: Proceed with caution, this will flag this feedback as "reviewed" meaning you have successfully reviewed this feedback, and this will make it visible in the landing page.') }}
            </p>
            
            <input type="number" name="id" value= {{ $user_id[0]->id }} hidden>
            


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
