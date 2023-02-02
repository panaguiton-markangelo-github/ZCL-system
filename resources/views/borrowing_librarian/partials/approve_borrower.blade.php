<section class="space-y-6">
    <x-button
        variant="success"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'add-book')"
    >
        <i class="fa-solid fa-thumbs-up pr-1"></i>
        {{ __('Approve') }}
    </x-button>

    <x-modal
        name="add-book"
        {{-- :show="$errors->userDeletion->isNotEmpty()" --}}
        focusable
    >
        <form
            method="post"
            action="/borrowing_librarian/update/application/borrower/{{$borrowers_app[0]->id}}"
            class="p-6"
        >
            @csrf

            @method('put')
    
            <h2 class="text-lg font-medium">
                {{ __('Approve this borrower card application') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Note: After confirmation, this borrower card application will be approved and will update the status into "approved".') }}
            </p>

          
            <br>
           
            <p class="text-md text-center font-bold">
                Current status of this application: {{$borrowers_app[0]->status}}
            </p>

            <input type="text" name="status" id="status" value="APPROVED" hidden>
            
        
            
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
                    {{ __('Approve') }}
                </x-button>
            </div>
        </form>
    </x-modal>
</section>
