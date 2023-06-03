    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
     .rate {
         float: left;
         height: 46px;
         padding: 0 10px;
         }
         .rate:not(:checked) > input {
         position:absolute;
         display: none;
         }
         .rate:not(:checked) > label {
         float:right;
         width:1em;
         overflow:hidden;
         white-space:nowrap;
         cursor:pointer;
         font-size:30px;
         color:#ccc;
         }
         .rated:not(:checked) > label {
         float:right;
         width:1em;
         overflow:hidden;
         white-space:nowrap;
         cursor:pointer;
         font-size:30px;
         color:#ccc;
         }
         .rate:not(:checked) > label:before {
         content: '★ ';
         }
         .rate > input:checked ~ label {
         color: #ffc700;
         }
         .rate:not(:checked) > label:hover,
         .rate:not(:checked) > label:hover ~ label {
         color: #deb217;
         }
         .rate > input:checked + label:hover,
         .rate > input:checked + label:hover ~ label,
         .rate > input:checked ~ label:hover,
         .rate > input:checked ~ label:hover ~ label,
         .rate > label:hover ~ input:checked ~ label {
         color: #c59b08;
         }
         .star-rating-complete{
            color: #c59b08;
         }
         .rating-container .form-control:hover, .rating-container .form-control:focus{
         background: #fff;
         border: 1px solid #ced4da;
         }
         .rating-container textarea:focus, .rating-container input:focus {
         color: #000;
         }         .rated {
         float: left;
         height: 46px;
         padding: 0 10px;
         }
         .rated:not(:checked) > input {
         position:absolute;
         display: none;
         }
         .rated:not(:checked) > label {
         float:right;
         width:1em;
         overflow:hidden;
         white-space:nowrap;
         cursor:pointer;
         font-size:30px;
         color:#ffc700;
         }
         .rated:not(:checked) > label:before {
         content: '★ ';
         }
         .rated > input:checked ~ label {
         color: #ffc700;
         }
         .rated:not(:checked) > label:hover,
         .rated:not(:checked) > label:hover ~ label {
         color: #deb217;
         }
         .rated > input:checked + label:hover,
         .rated > input:checked + label:hover ~ label,
         .rated > input:checked ~ label:hover,
         .rated > input:checked ~ label:hover ~ label,
         .rated > label:hover ~ input:checked ~ label {
         color: #c59b08;
         }
</style>

<section class="space-y-6">
    <x-button
        variant="danger"
        class="justify-center max-w-xs gap-2"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'add-rating')"
    >
        <i class="fa-sharp fa-solid fa-star pr-1"></i>
        
        {{ __('Feedback') }}
    </x-button>

    <x-modal
        name="add-rating"
        {{-- :show="$errors->userDeletion->isNotEmpty()" --}}
        focusable
    >
        <form
            method="post"
            action="{{ route('user.review.store') }}"
            class="p-6"
        >
            @csrf
    
            <h2 class="text-lg font-medium">
                {{ __('Review') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Your feedback will help us improve.') }}
            </p>

            @error('rating')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2500)"
                    class="text-sm text-red-500 dark:text-red-400"
                >
                    @error('rating')
                    <p class="text-sm text-red-500 dark:text-red-400">You need to select a star to submit the review form!</p> 
                    @enderror
                </p>
        
            @enderror 

            
            <div class="container">
                <div class="row">
                    <div class="col mt-4">
                        <div class="row">
                            <div class="col">
                                <div class="rate">
                                    <input type="radio" id="star5" class="rate" name="rating" value="5"/>
                                    <label for="star5" title="text">5 stars</label>
                                    <input type="radio" id="star4" class="rate" name="rating" value="4"/>
                                    <label for="star4" title="text">4 stars</label>
                                    <input type="radio" id="star3" class="rate" name="rating" value="3"/>
                                    <label for="star3" title="text">3 stars</label>
                                    <input type="radio" id="star2" class="rate" name="rating" value="2">
                                    <label for="star2" title="text">2 stars</label>
                                    <input type="radio" id="star1" class="rate" name="rating" value="1"/>
                                    <label for="star1" title="text">1 star</label>
                                </div>
                            </div>
                        </div>
             
                     
                        <div class="mt-4">
                            <textarea class="border-gray-400 rounded-md focus:border-gray-400 focus:ring
                            focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1
                            dark:text-gray-300 dark:focus:ring-offset-dark-eval-1" name="comment" rows="10" cols="50" placeholder="Comment" maxlength="200"></textarea>
                        </div>
                        
                    
                    </div>
                </div>
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
                    {{ __('Submit') }}
                </x-button>
            </div>
        </form>
    </x-modal>
</section>

