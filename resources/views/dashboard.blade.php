<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-center">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Browse the online catalog for books') }}
            </h2>

            @include('partials.rate')

            @if (session('member.0.id'))
                <form method="POST" action="{{ route('borrower.view') }}">
                    <input name="user_id" type="number" value="{{auth()->user()->id}}" hidden readonly>
                    @csrf
                    <x-button variant="danger" class="justify-center">
                        <i class="fa-solid fa-users-rectangle px-1"></i>
                        {{ __('Borrower Card') }}
                    </x-button>
                </form>
                
            @endif

        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <h2 class="font-bold mb-2">
            Important Reminder: Online ZC Library Services Operating Hours
        </h2>
        <p class="text-m text-orange-700 dark:text-orange-400">   
            We would like to remind you that the online services provided by the ZC Library will be processed exclusively during our regular work hours, <b>Monday to Friday, from 8:00 AM to 5:00 PM.</b> 
            <br>
            <br>
            Please note that any requests submitted outside of our operating hours will be addressed promptly on the next business day. We kindly request your understanding and patience in such cases.
        </p>
    </div>

    <div class="p-6 mt-5 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        Welcome! {{auth()->user()->firstName}} {{auth()->user()->lastName}}
        @if (!session('member.0.id'))
            <br>
            <br>
            <p class="text-sm text-orange-500 dark:text-orange-400">
                Hi there! It seems you have not yet applied for a borrower card application. 
                <br>
                Note: You will have to apply for a borrower card, in order to borrow books or start transactions from the 
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
        <h3 class="font-semibold mb-2">
            Hints:
        </h3>
        <p class="text-sm"> 
            To add a book to your cart, kindly click the button that indicates a "cart icon".
            <br>
            To know more about a specific book, kindly click the button that indicates a "info circle icon".
        </p>
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
                        <th scope="col" class="text-sm font-medium   px-6 py-4 text-left">No</th>
                        <th scope="col" class="text-sm font-medium  px-6 py-4 text-left"></th>
                        <th scope="col" class="text-sm font-medium   px-6 py-4 text-left">Title</th>
                        <th scope="col" class="text-sm font-medium   px-6 py-4 text-left">Author</th>
                        <th scope="col" class="text-sm font-medium   px-6 py-4 text-left">Published</th>
                        <th scope="col" class="text-sm font-medium   px-6 py-4 text-left">Collection</th>
                        <th scope="col" class="text-sm font-medium   px-6 py-4 text-left">Status</th>
                        <th scope="col" class="text-sm font-medium   px-6 py-4 text-left"> </th>
                        <th scope="col" class="text-sm font-medium   px-6 py-4 text-left"> </th>
                    </tr>

                    <tr>
                        <th scope="col" class="text-sm font-medium   px-6 py-4 text-left"></th>
                        <th scope="col" class="text-sm font-medium  dark:text-gray-900 px-6 py-4 text-left"></th>
                        <th scope="col" class="text-sm font-medium  dark:text-gray-900   px-6 py-4 text-left"></th>
                        <th scope="col" class="text-sm font-medium  dark:text-gray-900   px-6 py-4 text-left select_search">Author</th>
                        <th scope="col" class="text-sm font-medium  dark:text-gray-900  px-6 py-4 text-left select_search">Published</th>
                        <th scope="col" class="text-sm font-medium  dark:text-gray-900  px-6 py-4 text-left select_search">Collection</th>
                        <th scope="col" class="text-sm font-medium  dark:text-gray-900  px-6 py-4 text-left select_search">Status</th>
                        <th scope="col" class="text-sm font-medium  dark:text-gray-900   px-6 py-4 text-left"> </th>
                        <th scope="col" class="text-sm font-medium  dark:text-gray-900   px-6 py-4 text-left"> </th>
                    </tr>
                </thead>
                <tbody>
                        @foreach ($books as $book)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    <img class="border-solid border-4 border-red-500" src="{{ asset('storage/'.$book->image) }}" alt="none" width="150" height="150">
                                </td>
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
                                    <x-button variant="danger" href="/catalog/book/{{ $book->id }}" class="justify-center">
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
                                        <x-button variant="danger" class="justify-center">
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
                        <th scope="col" class="text-sm font-medium   px-6 py-4 text-left">No</th>
                        <th scope="col" class="text-sm font-medium  px-6 py-4 text-left"></th>
                        <th scope="col" class="text-sm font-medium   px-6 py-4 text-left">Title</th>
                        <th scope="col" class="text-sm font-medium   px-6 py-4 text-left">Author</th>
                        <th scope="col" class="text-sm font-medium   px-6 py-4 text-left">Published</th>
                        <th scope="col" class="text-sm font-medium   px-6 py-4 text-left">Collection</th>
                        <th scope="col" class="text-sm font-medium   px-6 py-4 text-left">Status</th>
                        <th scope="col" class="text-sm font-medium   px-6 py-4 text-left"> </th>
                        <th scope="col" class="text-sm font-medium   px-6 py-4 text-left"> </th>
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
    }
    tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
</style>

