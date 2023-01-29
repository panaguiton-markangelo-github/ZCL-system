<section class="space-y-6">
    <x-button
        variant="success"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'add-book')"
    >
        <i class="fa-solid fa-plus px-1"></i>
        {{ __('Add Book') }}
    </x-button>

    <x-modal
        name="add-book"
        {{-- :show="$errors->userDeletion->isNotEmpty()" --}}
        focusable
    >
        <form
            method="post"
            action="{{ route('catalog_librarian.add.books') }}"
            class="p-6"
        >
            @csrf
    
            <h2 class="text-lg font-medium">
                {{ __('Create a book') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Note: This will create a new book that is availabe to be borrowed by a member.') }}
            </p>

            <br>
           
            <p class="text-md text-center font-bold">Book's Details</p>
            
        
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

            <!-- author -->
            <div class="mt-6 space-y-6">
                <x-form.label
                    for="author"
                    :value="__('Author')"
                />

                <x-form.input
                    id="author"
                    name="author"
                    type="text"
                    class="block w-3/4"
                    :value="old('author')"
                    placeholder="{{ __('Author') }}"
                    required
                    autofocus
                />

                @error('author')
                    <p class="text-red-500 text-xs p-1">
                        @error('author')
                            {{ $message }}
                        @enderror
                    </p>
                @enderror 
            </div>

            <!-- Published -->
            <div class="mt-6 space-y-6">
                <x-form.label
                    for="published"
                    :value="__('Published')"
                />

                <x-form.input
                    id="published"
                    name="published"
                    type="text"
                    class="block w-3/4"
                    :value="old('published')"
                    placeholder="{{ __('Published') }}"
                    required
                    autofocus
                />

                @error('published')
                    <p class="text-red-500 text-xs p-1">
                        @error('published')
                            {{ $message }}
                        @enderror
                    </p>
                @enderror 
            </div>

            <!-- Subject -->
            <div class="mt-6 space-y-6">
                <x-form.label
                    for="subject"
                    :value="__('Subject')"
                />

                <x-form.input
                    id="subject"
                    name="subject"
                    type="text"
                    class="block w-3/4"
                    :value="old('subject')"
                    placeholder="{{ __('Subject') }}"
                    required
                    autofocus
                />

                @error('subject')
                    <p class="text-red-500 text-xs p-1">
                        @error('subject')
                            {{ $message }}
                        @enderror
                    </p>
                @enderror 
            </div>

            <!-- Publisher-->
            <div class="mt-6 space-y-6">
                <x-form.label
                    for="publisher"
                    :value="__('Publisher')"
                />

                <x-form.input
                    id="publisher"
                    name="publisher"
                    type="text"
                    class="block w-3/4"
                    :value="old('publisher')"
                    placeholder="{{ __('Publisher') }}"
                    required
                    autofocus
                />

                @error('publisher')
                    <p class="text-red-500 text-xs p-1">
                        @error('publisher')
                            {{ $message }}
                        @enderror
                    </p>
                @enderror 
            </div>

            <!-- ISBN -->
            <div class="mt-6 space-y-6">
                <x-form.label
                    for="isbn"
                    :value="__('ISBN')"
                />

                <x-form.input
                    id="isbn"
                    name="isbn"
                    type="text"
                    class="block w-3/4"
                    :value="old('isbn')"
                    placeholder="{{ __('ISBN') }}"
                    required
                    autofocus
                />

                @error('isbn')
                    <p class="text-red-500 text-xs p-1">
                        @error('isbn')
                            {{ $message }}
                        @enderror
                    </p>
                @enderror 
            </div>
            
            <!-- Summary -->
            <div class="mt-6 space-y-6">
                <x-form.label
                    for="summary"
                    :value="__('Summary (maximum of 200 characters)')"
                />

                <textarea 
                    name="summary" 
                    id="summary" 
                    cols="60" 
                    rows="10" 
                    class="block w-3/4 py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring
                    focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1
                    dark:text-gray-300 dark:focus:ring-offset-dark-eval-1" 
                    required
                    autofocus
                    maxlength="200"
                >

                </textarea>

                @error('summary')
                    <p class="text-red-500 text-xs p-1">
                        @error('summary')
                            {{ $message }}
                        @enderror
                    </p>
                @enderror 
            </div>

            <br>
            
            <p class="text-md text-center font-bold">Book Location</p>
            

            <!-- Collection -->
            <div class="mt-6 space-y-6">
                <x-form.label
                    for="collection"
                    :value="__('Collection')"
                />
                <select name="collection" id="collection" class="block w-3/4 py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring
                    focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1
                    dark:text-gray-300 dark:focus:ring-offset-dark-eval-1" required>
    
                    <option value="" selected>Select collection</option>
                    <option value="fiction"> fiction</option>
                    <option value="non-fiction"> non-fiction </option>
                
                </select> 

                @error('collection')
                    <p class="text-red-500 text-xs p-1">
                        @error('collection')
                            {{ $message }}
                        @enderror
                    </p>
                @enderror 
            </div>

            <!-- Shelf Location -->
            <div class="mt-6 space-y-6">
                <x-form.label
                    for="shelf_location"
                    :value="__('Shelf Location')"
                />

                <x-form.input
                    id="shelf_location"
                    name="shelf_location"
                    type="text"
                    class="block w-3/4"
                    :value="old('shelf_location')"
                    placeholder="{{ __('Shelf Location') }}"
                    required
                    autofocus
                />

                @error('shelf_location')
                    <p class="text-red-500 text-xs p-1">
                        @error('shelf_location')
                            {{ $message }}
                        @enderror
                    </p>
                @enderror 
            </div>

            <!-- Status -->
            <div class="mt-6 space-y-6">
               
                
                <x-form.label
                    for="status"
                    :value="__('Status')"
                />
                {{-- <select name="status" id="status" class="py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring
                    focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1
                    dark:text-gray-300 dark:focus:ring-offset-dark-eval-1" readonly required>
    
                    <option value=""></option>
                    <option value="AVAILABLE" selected> AVAILABLE</option>
                    <option value="BORROWED"> BORROWED </option>
                
                </select> --}}

                <x-form.input
                    id="status"
                    name="status"
                    type="text"
                    class="block w-3/4"
                    value="AVAILABLE"
                    placeholder="{{ __('Status') }}"
                    required
                    readonly
                    autofocus
                />
                

                @error('status')
                    <p class="text-red-500 text-xs p-1">
                        @error('status')
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
