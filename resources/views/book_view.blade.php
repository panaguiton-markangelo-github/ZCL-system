<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __("Book's Details") }}
            </h2>

            {{-- {{if auth() }} --}}
           
            {{-- <x-button target="_blank" href="https://github.com/kamona-wd/kui-laravel-breeze" variant="black"
                class="justify-center max-w-xs gap-2">
                <span>Cart</span>
                
            </x-button> --}}

        </div>
    </x-slot>


    <div class="p-6 mt-2 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1" style="white-space: nowrap">
        <x-button href="{{ route('dashboard') }}">
            <span>{{ __('Go Back') }}</span>
        </x-button>
    </div>

    <div class="p-6 mt-2 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1" style="white-space: nowrap">
        <div class="mb-2">Title: <span class="font-bold">{{$book->title}}</span> </div>
        <div class="mb-2">Summary: <span class="font-bold">{{$book->summary}}</span></div>

        <div class="mb-2">Author: <span class="font-bold">{{$book->author}}</span> </div>
        <div class="mb-2">Published: <span class="font-bold">{{$book->published}}</span> </div>
        <div class="mb-7">Subjects: <span class="font-bold">{{$book->subject}}</span> </div>

        <div class="text-center">Shelf Location at Zamboanga City Library</div>
        <div class="flex justify-center">
            <table class="table-fixed border-separate border-spacing-8 text-center">
                <thead>
                    <tr>
                      <th>Collection: </th>
                      <th>Shelf Location: </th>
                      <th>Status: </th>
                    </tr>
                </thead>
                <tbody>
                    <td>
                        <span class="font-bold">{{$book->collection}}</span>
                    </td>
                    <td>
                        <span class="font-bold">{{$book->shelf_location}}</span>
                    </td>
                    <td>
                        <span class="font-bold">{{$book->status}}
                    </td>
                </tbody>
            </table>
        </div>

        <hr> 
        <br>

        @if ($cart->where('id', $book->id)->count())
            <div class="text-center" >
                This book is already on your cart.
            </div>
        @else
        <div>
            <form action="{{ route('cart.store') }}" method="POST">
                @csrf
                <input type="hidden" value="{{$book->id}}" name="book_id">
                <input type="number" value="1" name="quantity" hidden>
                <x-button class="justify-center w-full">
                    <i class="fa-solid fa-cart-plus mx-2"></i>
                    <span>{{ __('Add to cart') }}</span>
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

