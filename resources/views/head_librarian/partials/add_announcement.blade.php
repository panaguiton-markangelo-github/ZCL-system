<section class="space-y-6">
    <x-button
        variant="success"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'add-announcement')"
    >
        <i class="fa-solid fa-plus px-1"></i>
        {{ __('Add Announcement') }}
    </x-button>

    <x-modal
        name="add-announcement"
        {{-- :show="$errors->userDeletion->isNotEmpty()" --}}
        focusable
    >
        <form
            method="post"
            action="{{ route('announce.store') }}"
            class="p-6"
        >
            @csrf
    
            <h2 class="text-lg font-medium">
                {{ __('Create an Announcement') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Note: The announcements you have created will be displayed on the landing page.') }}
            </p>

            
            <!-- details -->
            <div class="mt-6 space-y-6">
                <x-form.label
                    for="details"
                    :value="__('Details (maximum of 300 characters)')"
                />

                <textarea 
                    name="details" 
                    id="details" 
                    cols="60" 
                    rows="10" 
                    class="block w-3/4 py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring
                    focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1
                    dark:text-gray-300 dark:focus:ring-offset-dark-eval-1" 
                    required
                    autofocus
                    maxlength="300"
                >

                </textarea>

                @error('details')
                    <p class="text-red-500 text-xs p-1">
                        @error('details')
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
