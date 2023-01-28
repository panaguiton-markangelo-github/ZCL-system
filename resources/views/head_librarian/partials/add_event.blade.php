<section class="space-y-6">
    <x-button
        variant="success"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'add-event')"
    >
        <i class="fa-solid fa-plus px-1"></i>
        {{ __('Add Event') }}
    </x-button>

    <x-modal
        name="add-event"
        {{-- :show="$errors->userDeletion->isNotEmpty()" --}}
        focusable
    >
        <form
            method="post"
            action="{{ route('events.store') }}"
            class="p-6"
        >
            @csrf
    
            <h2 class="text-lg font-medium">
                {{ __('Create an Event') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Note: The events you have created will be displayed on the landing page.') }}
            </p>

            
            <!-- Title -->
            <div class="mt-6 space-y-6">
                <x-form.label
                    for="title"
                    :value="__('Title')"
                />

                <x-form.input
                    id="title"
                    name="title"
                    type="text"
                    class="block w-3/4"
                    :value="old('title')"
                    placeholder="{{ __('Title') }}"
                    required
                    autofocus
                />

                @error('title')
                    <p class="text-red-500 text-xs p-1">
                        @error('title')
                            {{ $message }}
                        @enderror
                    </p>
                @enderror 
            </div>

            <!-- Start -->

            <div class="mt-6 space-y-6">
                <x-form.label
                    for="start"
                    :value="__('Start')"
                />

               
            <x-form.input
                id="start"
                name="start"
                type="datetime-local"
                class="block w-3/4"
                :value="old('start')"
                placeholder="{{ __('Start') }}"
                required
                autofocus
            />
            

                @error('start')
                    <p class="text-red-500 text-xs p-1">
                        @error('start')
                            {{ $message }}
                        @enderror
                    </p>
                @enderror 
            </div>

            <!-- End -->

            <div class="mt-6 space-y-6">
                <x-form.label
                    for="end"
                    :value="__('End')"
                />

               
            <x-form.input
                id="end"
                name="end"
                type="datetime-local"
                class="block w-3/4"
                :value="old('end')"
                placeholder="{{ __('End') }}"
                required
                autofocus
            />
            

                @error('end')
                    <p class="text-red-500 text-xs p-1">
                        @error('end')
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
