<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __("User's Cart") }}
            </h2>


        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        @if ($cart->count() <= 0)
            <p class="text-sm text-red-500 dark:text-red-400">The cart is empty! Kindly add at least one book to your cart.</p>
        @else
            @if($is_status_member->count())
                @if ($is_status_member[0]->status == 'DECLINED')
                    <p class="text-sm text-orange-500 dark:text-orange-400">
                        Hi there! It seems your borrower card application was declined. 
                        Due to this, your previous request to borrow book/s will not be processed anymore.  
                        You may submit another request if you wish to borrow books from the catalog section.
                        <br>  
                        <br>
                        Note: You will have to have an approved borrower card, in order to borrow books from the 
                        Zamboanga City Library.
                    </p> 
                    <a class="text-sm text-cyan-500 dark:text-cyan-400" href="{{ route('borrower.app') }}">Click here to submit another borrower card application.</a>
                
                @else
                    <x-button href="{{ route('book_req.view') }}">
                        <i class="fa-solid fa-check pr-2"></i>
                        <span>{{ __('Borrow') }}</span>
                    </x-button>
                @endif
            
            @else
                <x-button href="{{ route('borrower.app') }}">
                    <i class="fa-solid fa-check pr-2"></i>
                    <span>{{ __('Borrow') }}</span>
                </x-button>
            @endif
        @endif
    </div>


    <div class="p-6 mt-2 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1" style="white-space: nowrap">
        @if(session('message') == 'Borrower card application was successfully sent for verification!') 
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

        @if(session('message') == 'Successfully deleted!') 
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
        

        <table id="table" class="display" style="width:100%;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th> </th>

                          
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($cart as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>
                            <form action="{{ route('cart.remove') }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{$item->rowId}}" name="row_id">
                                <x-button class="justify-center w-full">
                                    <i class="fa-solid fa-xmark pr-2"></i>
                                    <span>{{ __('Remove') }}</span>
                                </x-button>
                            </form>
                            
                        </td>
                    
                    </tr>
                    @endforeach
                        
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
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

