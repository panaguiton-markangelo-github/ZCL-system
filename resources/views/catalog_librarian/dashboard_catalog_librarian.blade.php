<x-clibrarian-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Dashboard') }}
            </h2>

            
            
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        {{ __("Welcome Catalog Librarian ")  }} {{Auth::guard('librarians')->user()->firstName}} {{Auth::guard('librarians')->user()->lastName}}
        {{ __("!")  }}
    </div>

    <br>
    
    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1 grid grid-cols-2 gap-2">
        
        <div class="flex justify-center">
            <div class="block py-6 px-6 rounded-lg shadow-lg  text-center w-3/4">
                <i class="fa-solid fa-users text-2xl"></i>
                <h5 class="text-md leading-tight font-medium mb-2"> 
                     Total users:
                </h5>
                <p class="text-base mb-4">

                @if ($allUsers->count() == 0)
                    There are currently no registered users.
                @endif

                @if ($allUsers->count() == 1)
                    There is currently {{$allUsers->count()}} registered user.
                @endif

                @if ($allUsers->count() > 1)
                    There are currently {{$allUsers->count()}} registered users.
                @endif
                
                </p>

            </div>
        </div>

        <div class="flex justify-center">
            <div class="block py-6 px-6 rounded-lg shadow-lg text-center w-3/4">
                <i class="fa-solid fa-book text-2xl"></i>
                <h5 class=" text-md leading-tight font-medium mb-2 "> 
                     Total books:
                </h5>
                <p class=" text-base mb-4">
                    @if ($allBooks->count() == 0)
                        There are currently no registered books.
                    @endif

                    @if ($allBooks->count() == 1)
                        There is currently {{$allBooks->count()}} registered book.
                    @endif

                    @if ($allBooks->count() > 1)
                        There are currently {{$allBooks->count()}} registered books..
                    @endif
                </p>

            </div>
        </div>
    
    </div>

    <br>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <div class="tem-grid">
            <div class="registered_users">
                <div class="card">
                    <div class="card-header">
                        <h3>Books</h3>
                        <x-button variant="success" href="{{route('catalog_librarian.view.books')}}">
                            <span>{{ __('See all') }}</span>
                            <i class="fa-solid fa-arrow-right ml-2"></i>
                        </x-button> 
                    </div>
                    
                    <div class="card-body">
                        <div class="table-responsive-cus">
                            <table width="100%">
                                <thead>
                                    <tr>
                                        
                                        <td>No.</td>
                                        <td> Title </td>
                                        <td> Author </td>
                                        <td> Published </td>
                                        <td> Collection </td>
                                        <td> Status </td>                                 
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($books as $book) 
                                    <tr>
                                        
                                        <td> {{$loop->iteration}} </td>
                                        <td> {{$book->title}} </td>
                                        <td> {{$book->author}} </td>
                                        <td> {{$book->published}} </td>
                                        <td> {{$book->collection}} </td>
                                        <td> {{$book->status}} </td>
                                    </tr>
                                    @endforeach 

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-clibrarian-layout>

<style>
    .tem-grid {
        display: grid;
        grid-gap: 2rem;
        grid-template-columns: 100%;
    }
    
    .card {
        border-radius:5px
    }
    
    .card-header
    {
        padding: 1rem;
    }
    
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #f0f0f0;
    }
    
    .card-header h3{
        font-size: 1.2rem;
    }
    
    .card-header a {
        border-radius:10px;
        font-size: .8rem;
        padding: .5rem 1rem;
        text-decoration: none;
    }
    
    .card-body a {
        border-radius:10px;
        font-size: 1.1rem;
        padding: .3rem .8rem;
        text-decoration: none;
    }
    
    .card-body button {
        border-radius:10px;
        font-size: 1.1rem;
        padding: .3rem .8rem;
        text-decoration: none;
    }
    
    table {
        border-collapse: collapse;
    }
    
    thead tr {
        border-top: 1px solid #f0f0f0;
        border-bottom: 1px solid #f0f0f0;
    }
    
    thead td {
        font-weight: 700;
    }
    
    td {
        padding: .5rem 1rem;
        font-size: .9rem;
       
    }
    
    td .status {
        display: inline-block;
        height: 10px;
        width: 10px;
        border-radius: 50%;
        margin-right: 1rem;
    }
    
    td button {
        border-radius:8px;
        font-size: 1rem;
        padding: .3rem .7rem;
        text-decoration: none;
    }
</style>
