<x-clibrarian-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __("Books Catalog") }}
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
                @include('catalog_librarian.partials.add_book')
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
    
        <table id="table" class="table-auto display" style="width:100%;">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Published</th>
                            
                            <th>collection</th>
            
                            <th>Status</th>
                            <th></th> 
                            <th> </th>
                             
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
                        <td>{{$book->status}}</td>
                       
                    
                        <td>
                           
    
                            <div class="sm:rounded-lg">
                                <div class="max-w-xl">
                                    <x-button variant="success" href="/catalog_librarian/show/book/{{ $book->id }}">
                                        {{-- <i class="fa-solid fa-pen-to-square mx-2"></i> --}}
                                        <i class="fa-solid fa-circle-info mx-2"></i>
                                        <span>{{ __('View More') }}</span>
                                    </x-button> 
                                   
                                </div>
                            </div>  
                            
                    
                        </td> 

                        <td>
                           
    
                            <div class="sm:rounded-lg">
                                <div class="max-w-xl">
                                    <x-button variant="success" href="/catalog_librarian/edit/book/{{ $book->id }}">
                                        <i class="fa-solid fa-pen-to-square mx-2"></i>
                                        <span>{{ __('Edit Book') }}</span>
                                    </x-button> 
                                   
                                </div>
                            </div>  
                            
                    
                        </td> 

                    </tr>
                    @endforeach 
                        

                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Published</th>
                            
                            <th>collection</th>
            
                            <th>Status</th>  
                            <th></th>
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
</x-clibrarian-layout>

<style>
    tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
</style>
