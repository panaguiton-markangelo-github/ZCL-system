<x-blibrarian-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __("Book/s requested for borrowing") }}
            </h2>

        

        </div>
    </x-slot>

    <div class="p-6 mt-2 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
    
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

        @if ($errors->any())

            @foreach ($errors->all() as $error)
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2500)"
                class="text-sm text-red-600 dark:text-red-400 mb-2"
            >
                {{ $error }}
            </p>
            @endforeach

        @endif

        <div class="overflow-x-auto">
            <table id="table" class="min-w-full">
                <thead>
                    <tr>
                        <th scope="col" class="text-sm font-medium   px-6 py-4 text-left">No.</th>
                        <th scope="col" class="text-sm font-medium   px-6 py-4 text-left">Request Date</th>
                        <th scope="col" class="text-sm font-medium   px-6 py-4 text-left">Book Title</th>
                        <th scope="col" class="text-sm font-medium   px-6 py-4 text-left">Borrower's First Name</th>
                        <th scope="col" class="text-sm font-medium   px-6 py-4 text-left">Borrower's Last Name</th>            
                        <th scope="col" class="text-sm font-medium   px-6 py-4 text-left">Status</th>
                        <th scope="col" class="text-sm font-medium   px-6 py-4 text-left"></th>     
                    </tr>
                    <tr>
                        <th scope="col" class="text-sm font-medium  dark:text-gray-900 px-6 py-4 text-left"></th>
                        <th scope="col" class="text-sm font-medium  dark:text-gray-900 px-6 py-4 text-left select_search">Request Date</th>
                        <th scope="col" class="text-sm font-medium  dark:text-gray-900 px-6 py-4 text-left"></th>
                        <th scope="col" class="text-sm font-medium  dark:text-gray-900 px-6 py-4 text-left"></th>
                        <th scope="col" class="text-sm font-medium  dark:text-gray-900 px-6 py-4 text-left"></th>            
                        <th scope="col" class="text-sm font-medium  dark:text-gray-900 px-6 py-4 text-left select_search">Status</th>
                        <th scope="col" class="text-sm font-medium  dark:text-gray-900 px-6 py-4 text-left"></th> 
                            
                    </tr>
                </thead>
                <tbody>
                    @foreach ($request_books as $rbook)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$rbook->created_at}}</td>
                            <td>{{$rbook->title}}</td>
                            <td>{{$rbook->firstName}}</td>
                            <td>{{$rbook->lastName}}</td>
                            @if ($rbook->status == 'PENDING')
                                <td class="text-yellow-500 dark:text-yellow-400">{{$rbook->status}}</td>
                            @endif
                            @if ($rbook->status == 'APPROVED')
                                <td class="text-green-500 dark:text-green-400">{{$rbook->status}}</td>
                            @endif
                            @if ($rbook->status == 'RELEASED')
                                <td class="text-green-500 dark:text-green-400">{{$rbook->status}}</td>
                            @endif
                            @if ($rbook->status == 'RETURNED')
                                <td class="text-green-500 dark:text-green-400">{{$rbook->status}}</td>
                            @endif
                            @if ($rbook->status == 'DECLINED')
                                <td class="text-red-500 dark:text-red-400">{{$rbook->status}}</td>
                            @endif
                            @if ($rbook->status == 'CANCELLED')
                                <td class="text-red-500 dark:text-red-400">{{$rbook->status}}</td>
                            @endif

                            <td>
                                <div class="sm:rounded-lg">
                                    <div class="max-w-xl">
                                        <x-button variant="danger" href="/borrowing_librarian/requested/books/{{$rbook->id}}">
                                            {{-- <i class="fa-solid fa-pen-to-square mx-2"></i> --}}
                                            <i class="fa-solid fa-circle-info"></i>
                                        </x-button> 
                                        
                                    </div>
                                </div>  
                            </td> 

                        </tr>
                    @endforeach 

                </tbody>
                <tfoot>
                    <tr>
                        <th scope="col" class="text-sm font-medium   px-6 py-4 text-left">No.</th>
                        <th scope="col" class="text-sm font-medium   px-6 py-4 text-left">Request Date</th>
                        <th scope="col" class="text-sm font-medium   px-6 py-4 text-left">Book Title</th>
                        <th scope="col" class="text-sm font-medium   px-6 py-4 text-left">Borrower's First Name</th>
                        <th scope="col" class="text-sm font-medium   px-6 py-4 text-left">Borrower's Last Name</th>            
                        <th scope="col" class="text-sm font-medium   px-6 py-4 text-left">Status</th>
                        <th scope="col" class="text-sm font-medium   px-6 py-4 text-left"></th>      
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
</x-blibrarian-layout>

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

