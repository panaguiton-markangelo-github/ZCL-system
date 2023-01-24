<x-hlibrarian-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __("Librarians") }}
            </h2>

            {{-- {{if auth() }} --}}
           
            {{-- <x-button target="_blank" href="https://github.com/kamona-wd/kui-laravel-breeze" variant="black"
                class="justify-center max-w-xs gap-2">
                <span>Cart</span>
                
            </x-button> --}}

        </div>
    </x-slot>

    <div class="p-6 mt-2 bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <div class="sm:rounded-lg">
            <div class="max-w-xl">
                @include('head_librarian.partials.add_librarian')
            </div>
        </div>   
        
    </div>


    <div class="p-6 mt-2 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1" style="white-space: nowrap">
    
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
    
        <table id="table" class="display" style="width:100%;">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Type</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                     @foreach ($data as $user)
                     
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$user->firstName}}</td>
                        <td>{{$user->lastName}}</td>
                        <td>{{$user->email}}</td>
                        
                        @if ($user->type == '2')
                            <td>Librarian for Borrowing</td>
                        @endif
                        @if ($user->type == '3')
                            <td>Librarian for Cataloging</td>
                        @endif

                        <td>
                           
    
                            <x-button class="w-full" variant="success" href="/head_librarian/edit/librarian/{{ $user->id }}">
                                <i class="fa-solid fa-user-pen mx-2"></i>
                                <span>{{ __('Edit') }}</span>
                            </x-button>
                            

                        
                            
                        </td>


        
                    
                    </tr>
                    @endforeach 
                        
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Type</th>
                            <th></th>
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
</x-hlibrarian-layout>

<style>
    tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
</style>

