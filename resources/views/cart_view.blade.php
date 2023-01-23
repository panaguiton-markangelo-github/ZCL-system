<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __("User's Cart") }}
            </h2>

            {{-- {{if auth() }} --}}
           
            {{-- <x-button target="_blank" href="https://github.com/kamona-wd/kui-laravel-breeze" variant="black"
                class="justify-center max-w-xs gap-2">
                <span>Cart</span>
                
            </x-button> --}}

        </div>
    </x-slot>


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
        
        <!-- If user has already sent a member card app, the user should not be redirected 
            to the member card app anymore
         -->
        @if ($cart->count() <= 0)
            <p class="text-sm text-red-500 dark:text-red-400">The cart is empty! Kindly add at least one book to your cart.</p>
        @else
            @if (session('member.0.id'))
                <x-button href="{{ route('book_req.view') }}" class="mb-6">
                    <i class="fa-solid fa-check mx-2"></i>
                    <span>{{ __('Borrow') }}</span>
                </x-button>
            @else
                <x-button href="{{ route('borrower.app') }}" class="mb-6">
                    <i class="fa-solid fa-check mx-2"></i>
                    <span>{{ __('Borrow') }}</span>
                </x-button>
            @endif
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
                                    <i class="fa-solid fa-xmark mx-2"></i>
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

