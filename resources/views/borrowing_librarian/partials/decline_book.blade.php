<section class="space-y-6">
    <x-button
        variant="danger"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'del-confirm-book')"
    >
        <i class="fa-solid fa-thumbs-down pr-2"></i>
        {{ __('Decline') }}
    </x-button>

    <x-modal
        name="del-confirm-book"
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
                    {{ __('Decline this book borrow request') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Note: After confirmation, the request to borrow this book will be declined and will not update the status of the book.') }}
                </p>


                <input type="text" name="status" id="status" value="DECLINED" hidden>

                <!-- Remarks -->
                <div class="mt-6 space-y-6 text-left">
                    <x-form.label
                        for="remarks"
                        :value="__('Remarks (maximum of 100 characters)')"
                    />

                    <textarea 
                        name="remarks" 
                        id="remarks" 
                        cols="60" 
                        rows="10" 
                        class="block w-3/4 py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring
                        focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1
                        dark:text-gray-300 dark:focus:ring-offset-dark-eval-1" 
                        required
                        autofocus
                        maxlength="100"
                    ></textarea>

                    @error('remarks')
                        <p class="text-red-500 text-xs p-1">
                            @error('remarks')
                                {{ $message }}
                            @enderror
                        </p>
                    @enderror 

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Kindly enter the remarks as to why this request was declined.') }}
                    </p>
                </div>

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
                        {{ __('Decline') }}
                    </x-button>
                </div>

                
            @endif


                        


            @if ($member_info->status == 'PENDING')
                <h2 class="text-lg font-medium">
                    {{ __('Cannot decline this book borrow request') }}
                </h2>

                <br>
            
                <p class="text-sm text-red-600 dark:text-red-400 text-center font-bold">
                    You cannot decline this book request, since the Borrower Card
                    Application of this borrower is not yet approved. 
                    <br>
                    Kindly go to the "Borrower's card" tab and approved first the Borrower Card Application 
                    for this borrower.
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
        </form>
    </x-modal>
</section>
