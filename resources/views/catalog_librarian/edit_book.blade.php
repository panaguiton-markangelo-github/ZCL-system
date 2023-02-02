<x-clibrarian-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __("Edit details for") }} {{$book->title}}
            </h2>


        </div>
    </x-slot>

    
    <div class="p-6 mt-2 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1" style="white-space: nowrap">
    
        @if(session('message')) 
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2500)"
                class="text-sm text-green-600 dark:text-green-400 mb-2"
            >
                {{ __(session('message')) }}
            </p>
        @endif

        @if ($errors->any())

            @foreach ($errors->all() as $error)
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2500)"
                class="text-sm text-red-600 dark:text-red-400 mb-2"
            >
                {{ $error }}
            </p>
            @endforeach

        @endif 
    
        <form
            method="post"
            action="/catalog_librarian/update/book/{{ $book->id }}"
            class="p-6"
        >
            @csrf
            @method('PUT')
    
           
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Note: After clicking the update button, the details of this book will be updated.') }}
            </p>

            <br>

            <p class="mt-2 font-bold text-xl text-gray-600 dark:text-gray-400 text-center">
                {{ __('Book Details') }}
            </p>
    
            <br>
            <hr>

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
                    :value="$book->title"
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
                    :value="$book->author"
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
                    :value="$book->published"
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
                    :value="$book->subject"
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
                    :value="$book->publisher"
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
                    :value="$book->isbn"
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

            <br>

            <p class="mt-2 font-bold text-xl text-gray-600 dark:text-gray-400 text-center">
                {{ __('Summary') }}
            </p>
    
            <br>
            <hr>
            
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

                    {{$book->summary}}

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
            <p class="mt-2 font-bold text-xl text-gray-600 dark:text-gray-400 text-center">
                {{ __('Book Location') }}
            </p>
    
            <br>
            <hr>
            

            <!-- Collection -->
            <div class="mt-6 space-y-6">
                <x-form.label
                    for="collection"
                    :value="__('Collection')"
                />
                <select name="collection" id="collection" class="block w-3/4 py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring
                    focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1
                    dark:text-gray-300 dark:focus:ring-offset-dark-eval-1" required>
    
                    <option value="">Select collection</option>
                    @if ($book->collection == 'fiction')
                        <option value="fiction" selected> fiction</option>
                        <option value="non-fiction"> non-fiction </option>
                    @else
                        <option value="fiction"> fiction</option>
                        <option value="non-fiction" selected> non-fiction </option>
                    @endif
                    
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
                    :value="$book->shelf_location"
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
                <select name="status" id="status" class="py-2 block w-3/4 border-gray-400 rounded-md focus:border-gray-400 focus:ring
                    focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1
                    dark:text-gray-300 dark:focus:ring-offset-dark-eval-1" readonly required>
    
                    <option value=""></option>
                    @if ($book->status == 'AVAILABLE')
                        <option value="AVAILABLE" selected> AVAILABLE</option>
                        <option value="BORROWED"> BORROWED </option>
                    @else
                        <option value="AVAILABLE"> AVAILABLE</option>
                        <option value="BORROWED" selected> BORROWED </option>
                    @endif
                        
                </select>

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
                    variant="secondary"
                    href="{{route('catalog_librarian.view.books')}}"
                >
                    {{ __('Cancel') }}
                </x-button>

                <x-button
                    variant="success"
                    class="ml-3"
                >
                    {{ __('Update') }}
                </x-button> 
            </div>
        </form>

        <hr>
        <br>

        <div class="flex justify-center text-center">
                 
            
            <div class="sm:rounded-lg">
                <div class="max-w-xl">
                    @include('catalog_librarian.partials.del_confirm_book')
                </div>
            </div>   
            
        </div>
    </div>

   
</x-clibrarian-layout>



