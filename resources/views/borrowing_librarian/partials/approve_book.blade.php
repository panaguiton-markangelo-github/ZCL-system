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
            action="/borrowing_librarian/update/requested/books/{{$request_book[0]->id}}"
            class="p-6"
        >
            @csrf

            @method('put')

            @if ($request_book[0]->memberStatus == 'APPROVED')
                @if ($request_book[0]->status == 'AVAILABLE')
                    <h2 class="text-lg font-medium">
                        {{ __('Approve this book borrow request') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Note: After confirmation, the request to borrow this book will be approved and will update the status of the book into "borrowed".') }}
                    </p>

                    <br>

                    <p class="text-sm text-center font-bold">
                        Current status of this book: {{$request_book[0]->status}}
                    </p>


                    <br>
                
                    <p class="text-md text-center font-bold">
                        Current status of this request: {{$request_book[0]->bookReqStatus}}

                    </p>

                    <input type="text" name="status" id="status" value="APPROVED" hidden>

                    <input type="text" name="statusBook" id="statusBook" value="BORROWED" hidden>



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
                @endif
                
            @endif
            

            @if ($request_book[0]->memberStatus == 'PENDING')
                <h2 class="text-lg font-medium">
                    {{ __('Cannot approve this book borrow request') }}
                </h2>

                <br>
            
                <p class="text-sm text-red-600 dark:text-red-400 text-center font-bold">
                    You cannot approve this book request, since the Borrower Card
                    Application of this borrower is not yet approved. 
                    <br>
                    Kindly go to the "Borrower's card" tab and approved first the Borrower Card Application 
                    for this borrower.
                </p>

                @if ($request_book[0]->status == 'BORROWED')
                <br>
            
                <p class="text-sm text-red-600 dark:text-red-400 text-center font-bold">
                    In addition, you cannot approve this book request, since the book
                    is already borrowed.
                </p>

                @endif

                <!-- Buttons -->
                <div class="mt-6 flex justify-end">
                    <x-button
                        type="button"
                        variant="success"
                        x-on:click="$dispatch('close')"
                    >
                        {{ __('Okay') }}
                    </x-button>
                </div>

            @endif

            @if ($request_book[0]->memberStatus == 'APPROVED')
                @if ($request_book[0]->status == 'BORROWED')
                    <h2 class="text-lg font-medium">
                        {{ __('Cannot approve this book borrow request') }}
                    </h2>

                    <br>

                    <p class="text-sm text-red-600 dark:text-red-400 text-center font-bold">
                        The book that this borrower is requesting to borrow is already borrowed.
                    </p>

                    <!-- Buttons -->
                    <div class="mt-6 flex justify-end">
                        <x-button
                            type="button"
                            variant="success"
                            x-on:click="$dispatch('close')"
                        >
                            {{ __('Okay') }}
                        </x-button>
                    </div>
                @endif
            @endif

            
        </form>
    </x-modal>
</section>
