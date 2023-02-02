<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Browse the online catalog for books') }}
            </h2>

            @include('partials.rate')
            

        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        Welcome! {{auth()->user()->firstName}} {{auth()->user()->lastName}}

        @if (!session('member.0.id'))
            <br>
            <br>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Hi there! It seems you have not yet applied for a borrower card application. 
                <br>
                Note: You will have to apply for a borrower card, in order to borrow books from the 
                Zamboanga City Library.
                <br>  
            </p> 

            <a class="text-sm text-cyan-500 dark:text-cyan-400" href="{{ route('borrower.app') }}">Click here to apply.</a>
                        
        @endif
    </div>

    <div class="p-6 mt-7 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1" style="white-space: nowrap">
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

        <table id="table" class="display" style="width:100%;">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Published</th>
                            <th> </th>
                            <th> </th>

                          
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($books as $book)
                    <tr>
                        <td>
                            <a href="/catalog/book/{{ $book->id }}">
                                {{$book->title}}
                            </a>
                        </td>
                        <td>
                            <a href="/catalog/book/{{ $book->id }}">
                                {{$book->author}}
                            </a>
                        </td>
                        <td>
                            <a href="/catalog/book/{{ $book->id }}">
                                {{$book->published}}
                            </a>
                        </td>
                        @if ($cart->where('id', $book->id)->count())
                            <td>
                                In Cart
                            </td>
                        @else
                        <td>
                            <form action="{{ route('cart.store') }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{$book->id}}" name="book_id">
                                <input type="number" value="1" name="quantity" hidden>
                                <x-button class="justify-center w-full">
                                    <i class="fa-solid fa-cart-plus mx-2"></i>
                                    <span>{{ __('Add to cart') }}</span>
                                </x-button>
                            </form>
                        </td>
                        @endif

                        <td>
                            <x-button href="/catalog/book/{{ $book->id }}" class="justify-center w-full">
                                <i class="fa-solid fa-circle-info  mx-2"></i>
                                <span>{{ __('View') }}</span>
                            </x-button>
                        </td>
                        
                       
    
                    </tr>
                    @endforeach
                        
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Published</th>
                            <th> </th>
                            <th> </th>
                        
                        </tr>
                    </tfoot>
                </table>
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

