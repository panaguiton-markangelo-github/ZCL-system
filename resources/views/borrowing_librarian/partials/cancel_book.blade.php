<section class="space-y-6">
    <x-button
        variant="danger"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'can-confirm-book')"
    >
        <i class="fa-solid fa-thumbs-down pr-2"></i>
        {{ __('Cancel Approved Book Request') }}
    </x-button>

    <x-modal
        name="can-confirm-book"
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
                    {{ __('Cancel this approved book borrow request') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Note: After confirmation, this approved book borrow request will be cancelled and the status of the book will become AVAILABLE again. The request status will also be flagged as CANCELLED.') }}
                </p>


                <input type="text" name="status" id="status" value="CANCELLED" hidden>
                <input type="text" name="statusBook" id="statusBook" value="AVAILABLE" hidden>

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
                        {{ __('Kindly enter the remarks as to why this request was cancelled.') }}
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
                        {{ __('Confirm') }}
                    </x-button>
                </div>

                
            @endif
                      
        </form>
    </x-modal>
</section>
