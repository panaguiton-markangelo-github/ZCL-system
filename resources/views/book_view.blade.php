<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __("Book's Details for") }} {{$book->title}}
            </h2>


        </div>
    </x-slot>


    <div class="p-6 mt-2 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1" >
        <x-button variant="danger" href="{{ route('dashboard') }}">
            <span>{{ __('Go Back') }}</span>
        </x-button>
    </div>

    <div class="p-6 mt-2 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <p class="mt-1 text-xl text-gray-600 dark:text-gray-400 text-center">
            {{ __('Book Details') }}
        </p>

        <br>
        <hr>

        <br>

        <div class="flex justify-center">
            <img class="mr-2 border-solid border-4 border-red-500" src="{{ asset('storage/'.$book->image) }}" alt="none" width="300" height="300">
            
            <div class="ml-3">
                <div>
                    <p class="mt-2 text-md text-gray-600 dark:text-gray-400" style="font-weight: 900">
                        {{ __('Title: ') }} {{$book->title}}
                    </p>
    
                </div>
                
                <div>
                    <p class="mt-2 text-md text-gray-600 dark:text-gray-400" style="font-weight: 900">
                        {{ __('Author: ') }} {{$book->author}}
                    </p>

                </div>
    
                <div>
                    <p class="mt-2 text-md text-gray-600 dark:text-gray-400" style="font-weight: 900">
                        {{ __('Published: ') }} {{$book->published}}
                    </p>
    
                </div>
    
                <div>
                    <p class="mt-2 text-md text-gray-600 dark:text-gray-400" style="font-weight: 900">
                        {{ __('Subject: ') }} {{$book->subject}}
                    </p>
    
                </div>
    
                <div>
                    <p class="mt-2 text-md text-gray-600 dark:text-gray-400" style="font-weight: 900">
                        {{ __('Publisher: ') }} {{$book->publisher}}
                    </p>

                </div>
                
                <div>
                    <p class="mt-2 text-md text-gray-600 dark:text-gray-400" style="font-weight: 900">
                        {{ __('ISBN: ') }} {{$book->isbn}}
                    </p>
            
                </div>
            </div>
        </div>


    
        <br>

        <p class="mt-1 text-xl text-gray-600 dark:text-gray-400 text-center">
            {{ __('Summary') }}
        </p>

        <br>
        <hr>
        
        <div>
            <p class="mt-2 text-md text-gray-600 dark:text-gray-400" style="font-weight: 900">
                {{ __('Summary: ') }}
            </p>

            <p class="mt-2 text-md text-gray-600 dark:text-gray-400" >
                {{$book->summary}} 
            </p>

        </div>

        <br>

        <p class="mt-1 text-xl text-gray-600 dark:text-gray-400 text-center">
            {{ __('Book Location') }}
        </p>

        <br>
        <hr>

        <div class="grid grid-cols-3 gap-3 text-center">
            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400" style="font-weight: 900">
                    {{ __('Collection: ') }}  
                </p>

                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{$book->collection}}
                </p>
            </div>
            
            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400" style="font-weight: 900">
                    {{ __('Shelf Location: ') }}
                </p>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{$book->shelf_location}} 
                </p>

            </div>

            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400" style="font-weight: 900">
                    {{ __('Status: ') }}
                </p>

                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                     {{$book->status}} 
                </p>

            </div>
        </div>

        <br>
        <br>
        <hr> 
        <br>

        @if ($cart->where('id', $book->id)->count())
            <div class="text-center" >
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('This book is already on your basket.') }}
                </p>
            </div>
        @else
        <div>
            <form action="{{ route('cart.store') }}" method="POST">
                @csrf
                <input type="hidden" value="{{$book->id}}" name="book_id">
                <input type="number" value="1" name="quantity" hidden>
                <x-button variant="success" class="justify-center w-full">
                    <i class="fa-solid fa-cart-plus mx-2"></i>
                    <span>{{ __('Add to basket') }}</span>
                </x-button>
            </form>
        </div>
        @endif
    </div>

    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

    <script>
           $(document).ready(function () {
                $('#table').DataTable({
                responsive: true,
                scrollX: true
            });
            });
    </script>
</x-app-layout>

<style>
    tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
</style>

