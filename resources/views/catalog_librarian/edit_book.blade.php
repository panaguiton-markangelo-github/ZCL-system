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

            <!-- place of publish -->
            <div class="mt-6 space-y-6">
                <x-form.label
                    for="place_pub"
                    :value="__('Place of Publication')"
                />

                <x-form.input
                    id="place_pub"
                    name="place_pub"
                    type="text"
                    class="block w-3/4"
                    :value="$book->place_pub"
                    placeholder="{{ __('Place of Pub') }}"
                    required
                    autofocus
                />

                @error('place_pub')
                    <p class="text-red-500 text-xs p-1">
                        @error('place_pub')
                            {{ $message }}
                        @enderror
                    </p>
                @enderror 
            </div>

            <!-- edition_vol -->
            <div class="mt-6 space-y-6">
                <x-form.label
                    for="edition_vol"
                    :value="__('Edition/Vol')"
                />

                <x-form.input
                    id="edition_vol"
                    name="edition_vol"
                    type="text"
                    class="block w-3/4"
                    :value="$book->edition_vol"
                    placeholder="{{ __('Edition/Vol') }}"
                    required
                    autofocus
                />

                @error('edition_vol')
                    <p class="text-red-500 text-xs p-1">
                        @error('edition_vol')
                            {{ $message }}
                        @enderror
                    </p>
                @enderror 
            </div>

            <!-- pagination -->
            <div class="mt-6 space-y-6">
                <x-form.label
                    for="pagination"
                    :value="__('Pagination:')"
                />

                <x-form.input
                    id="pagination"
                    name="pagination"
                    type="text"
                    class="block w-3/4"
                    :value="$book->pagination"
                    placeholder="{{ __('Pagination:') }}"
                    required
                    autofocus
                />

                @error('pagination')
                    <p class="text-red-500 text-xs p-1">
                        @error('pagination')
                            {{ $message }}
                        @enderror
                    </p>
                @enderror 
            </div>

            <!-- source -->
            <div class="mt-6 space-y-6">
                <x-form.label
                    for="source"
                    :value="__('Source of acquisition')"
                />

                <x-form.input
                    id="source"
                    name="source"
                    type="text"
                    class="block w-3/4"
                    :value="$book->source"
                    placeholder="{{ __('Source of acquisition') }}"
                    required
                    autofocus
                />

                @error('source')
                    <p class="text-red-500 text-xs p-1">
                        @error('source')
                            {{ $message }}
                        @enderror
                    </p>
                @enderror 
            </div>

            <!-- series -->
            <div class="mt-6 space-y-6">
                <x-form.label
                    for="series"
                    :value="__('Series')"
                />

                <x-form.input
                    id="series"
                    name="series"
                    type="text"
                    class="block w-3/4"
                    :value="$book->series"
                    placeholder="{{ __('Series') }}"
                    required
                    autofocus
                />

                @error('series')
                    <p class="text-red-500 text-xs p-1">
                        @error('series')
                            {{ $message }}
                        @enderror
                    </p>
                @enderror 
            </div>

            <!-- incls -->
            <div class="mt-6 space-y-6">
                <x-form.label
                    for="incls"
                    :value="__('Includes')"
                />

                <x-form.input
                    id="incls"
                    name="incls"
                    type="text"
                    class="block w-3/4"
                    :value="$book->incls"
                    placeholder="{{ __('Includes') }}"
                    required
                    autofocus
                />

                @error('incls')
                    <p class="text-red-500 text-xs p-1">
                        @error('incls')
                            {{ $message }}
                        @enderror
                    </p>
                @enderror 
            </div>

            <!-- date_acq -->
            <div class="mt-6 space-y-6">
                <x-form.label
                    for="date_acq"
                    :value="__('Date Acquired')"
                />

                <x-form.input
                    id="date_acq"
                    name="date_acq"
                    type="date"
                    class="block w-3/4"
                    :value="$book->date_acq"
                    placeholder="{{ __('Date Acquired') }}"
                    required
                    autofocus
                />

                @error('date_acq')
                    <p class="text-red-500 text-xs p-1">
                        @error('date_acq')
                            {{ $message }}
                        @enderror
                    </p>
                @enderror 
            </div>

            <!-- property_no -->
            <div class="mt-6 space-y-6">
                <x-form.label
                    for="property_no"
                    :value="__('Property No')"
                />

                <x-form.input
                    id="property_no"
                    name="property_no"
                    type="text"
                    class="block w-3/4"
                    :value="$book->property_no"
                    placeholder="{{ __('Property No') }}"
                    required
                    autofocus
                />

                @error('property_no')
                    <p class="text-red-500 text-xs p-1">
                        @error('property_no')
                            {{ $message }}
                        @enderror
                    </p>
                @enderror 
            </div>

            <!-- acc_no -->
            <div class="mt-6 space-y-6">
                <x-form.label
                    for="acc_no"
                    :value="__('Acc. No')"
                />

                <x-form.input
                    id="acc_no"
                    name="acc_no"
                    type="text"
                    class="block w-3/4"
                    :value="$book->acc_no"
                    placeholder="{{ __('Acc. No') }}"
                    required
                    autofocus
                />

                @error('acc_no')
                    <p class="text-red-500 text-xs p-1">
                        @error('acc_no')
                            {{ $message }}
                        @enderror
                    </p>
                @enderror 
            </div>

            <!-- amount -->
            <div class="mt-6 space-y-6">
                <x-form.label
                    for="amount"
                    :value="__('Amount')"
                />

                <x-form.input
                    id="amount"
                    name="amount"
                    type="text"
                    class="block w-3/4"
                    :value="$book->amount"
                    placeholder="{{ __('Amount') }}"
                    required
                    autofocus
                />

                @error('amount')
                    <p class="text-red-500 text-xs p-1">
                        @error('amount')
                            {{ $message }}
                        @enderror
                    </p>
                @enderror 
            </div>

            <!-- call_no -->
            <div class="mt-6 space-y-6">
                <x-form.label
                    for="call_no"
                    :value="__('Call No')"
                />

                <x-form.input
                    id="call_no"
                    name="call_no"
                    type="text"
                    class="block w-3/4"
                    :value="$book->call_no"
                    placeholder="{{ __('Call No') }}"
                    required
                    autofocus
                />

                @error('call_no')
                    <p class="text-red-500 text-xs p-1">
                        @error('call_no')
                            {{ $message }}
                        @enderror
                    </p>
                @enderror 
            </div>

            <!-- lc -->
            <div class="mt-6 space-y-6">
                <x-form.label
                    for="lc"
                    :value="__('LC')"
                />

                <x-form.input
                    id="lc"
                    name="lc"
                    type="text"
                    class="block w-3/4"
                    :value="$book->lc"
                    placeholder="{{ __('LC') }}"
                    required
                    autofocus
                />

                @error('lc')
                    <p class="text-red-500 text-xs p-1">
                        @error('lc')
                            {{ $message }}
                        @enderror
                    </p>
                @enderror 
            </div>

            <!-- ddc -->
            <div class="mt-6 space-y-6">
                <x-form.label
                    for="ddc"
                    :value="__('DDC')"
                />

                <x-form.input
                    id="ddc"
                    name="ddc"
                    type="text"
                    class="block w-3/4"
                    :value="$book->ddc"
                    placeholder="{{ __('DDC') }}"
                    required
                    autofocus
                />

                @error('ddc')
                    <p class="text-red-500 text-xs p-1">
                        @error('ddc')
                            {{ $message }}
                        @enderror
                    </p>
                @enderror 
            </div>

            <!-- author_no -->
            <div class="mt-6 space-y-6">
                <x-form.label
                    for="author_no"
                    :value="__('Author No')"
                />

                <x-form.input
                    id="author_no"
                    name="author_no"
                    type="text"
                    class="block w-3/4"
                    :value="$book->author_no"
                    placeholder="{{ __('Author No') }}"
                    required
                    autofocus
                />

                @error('author_no')
                    <p class="text-red-500 text-xs p-1">
                        @error('author_no')
                            {{ $message }}
                        @enderror
                    </p>
                @enderror 
            </div>

            <!-- c -->
            <div class="mt-6 space-y-6">
                <x-form.label
                    for="c"
                    :value="__('©')"
                />

                <x-form.input
                    id="c"
                    name="c"
                    type="text"
                    class="block w-3/4"
                    :value="$book->c"
                    placeholder="{{ __('©') }}"
                    required
                    autofocus
                />

                @error('c')
                    <p class="text-red-500 text-xs p-1">
                        @error('c')
                            {{ $message }}
                        @enderror
                    </p>
                @enderror 
            </div>

            <!-- section -->
            <div class="mt-6 space-y-6">
                <x-form.label
                    for="section"
                    :value="__('section')"
                />

                <x-form.input
                    id="section"
                    name="section"
                    type="text"
                    class="block w-3/4"
                    :value="$book->section"
                    placeholder="{{ __('section') }}"
                    required
                    autofocus
                />

                @error('section')
                    <p class="text-red-500 text-xs p-1">
                        @error('section')
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

            <hr>
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
                >{{$book->summary}}</textarea>

                @error('summary')
                    <p class="text-red-500 text-xs p-1">
                        @error('summary')
                            {{ $message }}
                        @enderror
                    </p>
                @enderror 
            </div>

            <br>

            <hr>
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
                    @if ($book->collection == 'non-fiction')
                        <option value="non-fiction" selected> non-fiction </option>
                        <option value="fiction-college"> fiction for College </option>
                        <option value="fiction-children"> fiction for Children </option>
                        <option value="fiction-hs"> fiction for High School </option>
                        <option value="rotary-collection"> Rotary Collection </option>
                        <option value="filipiniana"> Filipiniana </option>
                        <option value="circulation"> Circulation </option>
                        <option value="general-references"> General References </option>
                        <option value="special-collection"> Special Collection </option>
                        <option value="zamboanga-collection"> Zamboanga Collection </option>
                        <option value="periodical-collection"> Periodical Collection </option>
                        <option value="chinese-collection"> Chinese Collection </option>
                        <option value="law-books"> Law Books </option>
                    @endif

                    @if ($book->collection == 'fiction-college')
                        <option value="non-fiction"> non-fiction </option>
                        <option value="fiction-college" selected> fiction for College </option>
                        <option value="fiction-children"> fiction for Children </option>
                        <option value="fiction-hs"> fiction for High School </option>
                        <option value="rotary-collection"> Rotary Collection </option>
                        <option value="filipiniana"> Filipiniana </option>
                        <option value="circulation"> Circulation </option>
                        <option value="general-references"> General References </option>
                        <option value="special-collection"> Special Collection </option>
                        <option value="zamboanga-collection"> Zamboanga Collection </option>
                        <option value="periodical-collection"> Periodical Collection </option>
                        <option value="chinese-collection"> Chinese Collection </option>
                        <option value="law-books"> Law Books </option>
                    @endif

                    @if ($book->collection == 'fiction-children')
                        <option value="non-fiction"> non-fiction </option>
                        <option value="fiction-college"> fiction for College </option>
                        <option value="fiction-children" selected> fiction for Children </option>
                        <option value="fiction-hs"> fiction for High School </option>
                        <option value="rotary-collection"> Rotary Collection </option>
                        <option value="filipiniana"> Filipiniana </option>
                        <option value="circulation"> Circulation </option>
                        <option value="general-references"> General References </option>
                        <option value="special-collection"> Special Collection </option>
                        <option value="zamboanga-collection"> Zamboanga Collection </option>
                        <option value="periodical-collection"> Periodical Collection </option>
                        <option value="chinese-collection"> Chinese Collection </option>
                        <option value="law-books"> Law Books </option>
                    @endif

                    @if ($book->collection == 'fiction-hs')
                        <option value="non-fiction"> non-fiction </option>
                        <option value="fiction-college"> fiction for College </option>
                        <option value="fiction-children"> fiction for Children </option>
                        <option value="fiction-hs" selected> fiction for High School </option>
                        <option value="rotary-collection"> Rotary Collection </option>
                        <option value="filipiniana"> Filipiniana </option>
                        <option value="circulation"> Circulation </option>
                        <option value="general-references"> General References </option>
                        <option value="special-collection"> Special Collection </option>
                        <option value="zamboanga-collection"> Zamboanga Collection </option>
                        <option value="periodical-collection"> Periodical Collection </option>
                        <option value="chinese-collection"> Chinese Collection </option>
                        <option value="law-books"> Law Books </option>
                    @endif

                    @if ($book->collection == 'rotary-collection')
                        <option value="non-fiction"> non-fiction </option>
                        <option value="fiction-college"> fiction for College </option>
                        <option value="fiction-children"> fiction for Children </option>
                        <option value="fiction-hs"> fiction for High School </option>
                        <option value="rotary-collection" selected> Rotary Collection </option>
                        <option value="filipiniana"> Filipiniana </option>
                        <option value="circulation"> Circulation </option>
                        <option value="general-references"> General References </option>
                        <option value="special-collection"> Special Collection </option>
                        <option value="zamboanga-collection"> Zamboanga Collection </option>
                        <option value="periodical-collection"> Periodical Collection </option>
                        <option value="chinese-collection"> Chinese Collection </option>
                        <option value="law-books"> Law Books </option>
                    @endif

                    @if ($book->collection == 'filipiniana')
                        <option value="non-fiction"> non-fiction </option>
                        <option value="fiction-college"> fiction for College </option>
                        <option value="fiction-children"> fiction for Children </option>
                        <option value="fiction-hs"> fiction for High School </option>
                        <option value="rotary-collection"> Rotary Collection </option>
                        <option value="filipiniana" selected> Filipiniana </option>
                        <option value="circulation"> Circulation </option>
                        <option value="general-references"> General References </option>
                        <option value="special-collection"> Special Collection </option>
                        <option value="zamboanga-collection"> Zamboanga Collection </option>
                        <option value="periodical-collection"> Periodical Collection </option>
                        <option value="chinese-collection"> Chinese Collection </option>
                        <option value="law-books"> Law Books </option>
                    @endif

                    @if ($book->collection == 'circulation')
                        <option value="non-fiction"> non-fiction </option>
                        <option value="fiction-college"> fiction for College </option>
                        <option value="fiction-children"> fiction for Children </option>
                        <option value="fiction-hs"> fiction for High School </option>
                        <option value="rotary-collection"> Rotary Collection </option>
                        <option value="filipiniana"> Filipiniana </option>
                        <option value="circulation" selected> Circulation </option>
                        <option value="general-references"> General References </option>
                        <option value="special-collection"> Special Collection </option>
                        <option value="zamboanga-collection"> Zamboanga Collection </option>
                        <option value="periodical-collection"> Periodical Collection </option>
                        <option value="chinese-collection"> Chinese Collection </option>
                        <option value="law-books"> Law Books </option>
                    @endif

                    @if ($book->collection == 'general-references')
                        <option value="non-fiction"> non-fiction </option>
                        <option value="fiction-college"> fiction for College </option>
                        <option value="fiction-children"> fiction for Children </option>
                        <option value="fiction-hs"> fiction for High School </option>
                        <option value="rotary-collection"> Rotary Collection </option>
                        <option value="filipiniana"> Filipiniana </option>
                        <option value="circulation"> Circulation </option>
                        <option value="general-references" selected> General References </option>
                        <option value="special-collection"> Special Collection </option>
                        <option value="zamboanga-collection"> Zamboanga Collection </option>
                        <option value="periodical-collection"> Periodical Collection </option>
                        <option value="chinese-collection"> Chinese Collection </option>
                        <option value="law-books"> Law Books </option>
                    @endif

                    @if ($book->collection == 'special-collection')
                        <option value="non-fiction"> non-fiction </option>
                        <option value="fiction-college"> fiction for College </option>
                        <option value="fiction-children"> fiction for Children </option>
                        <option value="fiction-hs"> fiction for High School </option>
                        <option value="rotary-collection"> Rotary Collection </option>
                        <option value="filipiniana"> Filipiniana </option>
                        <option value="circulation"> Circulation </option>
                        <option value="general-references"> General References </option>
                        <option value="special-collection" selected> Special Collection </option>
                        <option value="zamboanga-collection"> Zamboanga Collection </option>
                        <option value="periodical-collection"> Periodical Collection </option>
                        <option value="chinese-collection"> Chinese Collection </option>
                        <option value="law-books"> Law Books </option>
                    @endif

                    @if ($book->collection == 'zamboanga-collection')
                        <option value="non-fiction"> non-fiction </option>
                        <option value="fiction-college"> fiction for College </option>
                        <option value="fiction-children"> fiction for Children </option>
                        <option value="fiction-hs"> fiction for High School </option>
                        <option value="rotary-collection"> Rotary Collection </option>
                        <option value="filipiniana"> Filipiniana </option>
                        <option value="circulation"> Circulation </option>
                        <option value="general-references"> General References </option>
                        <option value="special-collection"> Special Collection </option>
                        <option value="zamboanga-collection" selected> Zamboanga Collection </option>
                        <option value="periodical-collection"> Periodical Collection </option>
                        <option value="chinese-collection"> Chinese Collection </option>
                        <option value="law-books"> Law Books </option>
                    @endif

                    @if ($book->collection == 'periodical-collection')
                        <option value="non-fiction"> non-fiction </option>
                        <option value="fiction-college"> fiction for College </option>
                        <option value="fiction-children"> fiction for Children </option>
                        <option value="fiction-hs"> fiction for High School </option>
                        <option value="rotary-collection"> Rotary Collection </option>
                        <option value="filipiniana"> Filipiniana </option>
                        <option value="circulation"> Circulation </option>
                        <option value="general-references"> General References </option>
                        <option value="special-collection"> Special Collection </option>
                        <option value="zamboanga-collection"> Zamboanga Collection </option>
                        <option value="periodical-collection" selected> Periodical Collection </option>
                        <option value="chinese-collection"> Chinese Collection </option>
                        <option value="law-books"> Law Books </option>
                    @endif

                    @if ($book->collection == 'chinese-collection')
                        <option value="non-fiction"> non-fiction </option>
                        <option value="fiction-college"> fiction for College </option>
                        <option value="fiction-children"> fiction for Children </option>
                        <option value="fiction-hs"> fiction for High School </option>
                        <option value="rotary-collection"> Rotary Collection </option>
                        <option value="filipiniana"> Filipiniana </option>
                        <option value="circulation"> Circulation </option>
                        <option value="general-references"> General References </option>
                        <option value="special-collection"> Special Collection </option>
                        <option value="zamboanga-collection"> Zamboanga Collection </option>
                        <option value="periodical-collection"> Periodical Collection </option>
                        <option value="chinese-collection" selected> Chinese Collection </option>
                        <option value="law-books"> Law Books </option>
                    @endif

                    @if ($book->collection == 'law-books')
                        <option value="non-fiction"> non-fiction </option>
                        <option value="fiction-college"> fiction for College </option>
                        <option value="fiction-children"> fiction for Children </option>
                        <option value="fiction-hs"> fiction for High School </option>
                        <option value="rotary-collection"> Rotary Collection </option>
                        <option value="filipiniana"> Filipiniana </option>
                        <option value="circulation"> Circulation </option>
                        <option value="general-references"> General References </option>
                        <option value="special-collection"> Special Collection </option>
                        <option value="zamboanga-collection"> Zamboanga Collection </option>
                        <option value="periodical-collection"> Periodical Collection </option>
                        <option value="chinese-collection"> Chinese Collection </option>
                        <option value="law-books" selected> Law Books </option>
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
                    variant="danger"
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



