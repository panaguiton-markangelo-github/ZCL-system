<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-center">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Browse the online catalog for books') }}
            </h2>

            @include('partials.rate')

            @if (session('member.0.id'))
                <x-button class="justify-center" href="/borrower/card/view/{{auth()->user()->id}}">
                    <i class="fa-solid fa-users-rectangle px-1"></i>
                    {{ __('Borrower Card') }}
                </x-button>
            @endif

        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        Welcome! {{auth()->user()->firstName}} {{auth()->user()->lastName}}
        @if (!session('member.0.id'))
            <br>
            <br>
            <p class="text-sm text-orange-500 dark:text-orange-400">
                Hi there! It seems you have not yet applied for a borrower card application. 
                <br>
                Note: You will have to apply for a borrower card, in order to borrow books from the 
                Zamboanga City Library.
                <br>  
            </p> 

            <a class="text-sm text-cyan-500 dark:text-cyan-400" href="{{ route('borrower.app') }}">Click here to apply.</a>
                        
        @endif
        
        @if($is_status_member->count())
            @if ($is_status_member[0]->status == 'DECLINED')
                <br>
                <br>
                <p class="text-sm text-orange-500 dark:text-orange-400">
                    Hi there! It seems your borrower card application was declined. 
                    Due to this, your previous request to borrow book/s will not be processed anymore.  
                    You may submit another request if you wish to borrow books from the catalog section.
                    <br>  
                    <br>
                    Note: You need to have an approved borrower card, in order to borrow books from the 
                    Zamboanga City Library.
                </p> 
                <a class="text-sm text-cyan-500 dark:text-cyan-400" href="{{ route('borrower.app') }}">Click here to submit another borrower card application.</a>
                <br>
                <p class="text-sm text-orange-500 dark:text-orange-400">
                    Please take note that you need to request to borrow books again after submitting another borrower card
                    application.
                </p>
            @endif
        @endif
        
    </div>

    <div class="p-6 mt-5 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
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

        @if(session('error_message'))
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2500)"
                class="text-sm text-red-600 dark:text-red-400 mb-2"
            >
                {{ __(session('error_message')) }}
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
        
        <div class="overflow-x-auto" >
            <table id="table" class="min-w-full">
                <thead>
                    <tr>
                        <th scope="col" class="text-sm font-medium  text-left">No</th>
                        <th scope="col" class="text-sm font-medium  text-left">Title</th>
                        <th scope="col" class="text-sm font-medium  text-left">Author</th>
                        <th scope="col" class="text-sm font-medium  text-left">Published</th>
                        <th scope="col" class="text-sm font-medium  text-left">Collection</th>
                        <th scope="col" class="text-sm font-medium  text-left">Status</th>
                        <th scope="col" class="text-sm font-medium  text-left"> </th>
                        <th scope="col" class="text-sm font-medium  text-left"> </th>
                    </tr>

                    <tr>
                        <th scope="col" class="text-sm font-medium  text-left"></th>
                        <th scope="col" class="text-sm font-medium  dark:text-gray-900  text-left"></th>
                        <th scope="col" class="text-sm font-medium  dark:text-gray-900  text-left select_search">Author</th>
                        <th scope="col" class="text-sm font-medium  dark:text-gray-900 text-left select_search">Published</th>
                        <th scope="col" class="text-sm font-medium  dark:text-gray-900 text-left select_search">Collection</th>
                        <th scope="col" class="text-sm font-medium  dark:text-gray-900 text-left select_search">Status</th>
                        <th scope="col" class="text-sm font-medium  dark:text-gray-900  text-left"> </th>
                        <th scope="col" class="text-sm font-medium  dark:text-gray-900  text-left"> </th>
                    </tr>
                </thead>
                <tbody>
                        @foreach ($books as $book)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$book->title}}</td>
                                <td>{{$book->author}}</td>                                  
                                <td>{{$book->published}}</td>      
                                <td>{{$book->collection}}</td>
                                @if($book->status == "AVAILABLE")
                                    <td class="text-green-500">{{$book->status}}</td>                     
                                @endif 

                                @if($book->status == "BORROWED")
                                    <td class="text-red-500">{{$book->status}}</td>                     
                                @endif 
                                    
                                <td class="text-center">
                                    <x-button href="/catalog/book/{{ $book->id }}" class="justify-center">
                                        <i class="fa-solid fa-circle-info"></i>
                                    </x-button>
                                </td>
                                @if ($cart->where('id', $book->id)->count())
                                    <td class="text-center">In Cart</td>
                                @else
                                <td class="text-center">
                                    <form action="{{ route('cart.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{$book->id}}" name="book_id">
                                        <input type="number" value="1" name="quantity" hidden>
                                        <x-button class="justify-center">
                                            <i class="fa-solid fa-cart-plus"></i>
                                        </x-button>
                                    </form>
                                </td>
                                @endif        
                            </tr>
                        @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th scope="col" class="text-sm font-medium  text-left">No</th>
                        <th scope="col" class="text-sm font-medium  text-left">Title</th>
                        <th scope="col" class="text-sm font-medium  text-left">Author</th>
                        <th scope="col" class="text-sm font-medium  text-left">Published</th>
                        <th scope="col" class="text-sm font-medium  text-left">Collection</th>
                        <th scope="col" class="text-sm font-medium  text-left">Status</th>
                        <th scope="col" class="text-sm font-medium  text-left"> </th>
                        <th scope="col" class="text-sm font-medium  text-left"> </th>
                    </tr>
                </tfoot>
              </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
             $('#table').DataTable({
                responsive: true,
                "language": {
                    "emptyTable": "There are no books currently available in the catalog."
                },
                 initComplete: function () {
                     this.api()
                         .columns()
                         .every(function () {
                             var column = this;
                             if ($(column.header()).hasClass('select_search')) {

                                var select = $('<select><option value=""></option></select>')
                                    .appendTo($(column.header()).empty())
                                    .on('change', function () {
                                        var val = $.fn.dataTable.util.escapeRegex(
                                            $(this).val()
                                        );
                                        column
                                            .search(val ? '^' + val + '$' : '', true, false)
                                            .draw();
                                    });
                                column.data().unique().sort().each(function (d, j) {
                                    select.append('<option value="' + d + '">' + d + '</option>')
                                });

                            }
                         });
                 },
             });
         });
 </script>
</x-app-layout>

<style>
    .dataTables_wrapper .dataTables_length select {
        padding-right: 25px;
        font-weight: 900;
        background-color: #9d4edd;
        color: white;
    }
    tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
</style>

