<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Browse the online catalog for books') }}
            </h2>

            {{-- {{if auth() }} --}}
           
            {{-- <x-button target="_blank" href="https://github.com/kamona-wd/kui-laravel-breeze" variant="black"
                class="justify-center max-w-xs gap-2">
                <span>Cart</span>
                
            </x-button> --}}

            <!-- ALMOST DONE HERE IN PUBLIC USER SIDE! LAST ONE IS TO 
                MAKE THE STAR RATING AND CONNECT IT TO DB ALSO. CONNECT ALL THE FORMS-->

        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <x-button href="{{ route('book_req.view') }}" class="justify-center w-full">
            <i class="fa-solid fa-circle-info  mx-2"></i>
            <span>{{ __('book request view') }}</span>
        </x-button>
        Welcome! {{auth()->user()->firstName}} {{auth()->user()->lastName}}
    </div>

    <div class="p-6 mt-7 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1" style="white-space: nowrap">
        @if(session('message'))
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-green-600 dark:text-green-400 mb-2"
            >
                {{ __(session('message')) }}
            </p>
                
        @endif
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

