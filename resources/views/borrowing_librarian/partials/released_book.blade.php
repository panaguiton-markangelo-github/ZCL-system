<section class="space-y-6">
    <x-button
        variant="success"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'rel-confirm-book')"
    >
        <i class="fa-solid fa-thumbs-up pr-2"></i>
        {{ __('Release Requested Book') }}
    </x-button>

    <x-modal
        name="rel-confirm-book"
        {{-- :show="$errors->userDeletion->isNotEmpty()" --}}
        focusable
    >

        <form
            method="post"
            action="/borrowing_librarian/update/requested/books/{{$request_book[0]->id}}"
            class="p-6"
        >
            @csrf
        
            @method('put')

            @if ($member_info->status == 'APPROVED')
                <h2 class="text-lg font-medium">
                    {{ __('Release this approved book borrow request to the user') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Note: After confirmation, the requested book can now be released to the user and the status of the book will become BORROWED. The request status will also be flagged as RELEASED.') }}
                </p>


                <input type="text" name="status" id="status" value="RELEASED" hidden>
                <input type="text" name="statusBook" id="statusBook" value="BORROWED" hidden>

                <br>

                <p class="text-sm text-center font-bold">
                    Current status of this book: {{$request_book[0]->status}}
                </p>

                <br>
            
                <p class="text-md text-center font-bold">
                    Current status of this request: {{$request_book[0]->bookReqStatus}}
                </p>


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

                
            @endif
                      
        </form>
    </x-modal>
</section>
