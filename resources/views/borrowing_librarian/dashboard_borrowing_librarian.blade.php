<x-blibrarian-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Dashboard') }}
            </h2>
 
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        {{ __("Welcome Borrowing Librarian ")  }} {{Auth::guard('librarians')->user()->firstName}} {{Auth::guard('librarians')->user()->lastName}}
        {{ __("!")  }}
    </div>

    <br>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1 grid grid-cols-3 gap-3">
        
        <div class="flex justify-center">
            <div class="block py-6 px-6 rounded-lg shadow-lg text-center  w-3/4">
                <i class="fa-solid fa-book-open-reader text-2xl"></i>
                <h5 class="text-sm leading-tight font-medium mb-2"> 
                     Books currently borrowed:
                </h5>
                <p class="text-base mb-4">
                   
                @if ($borrowed_books->count() == 0)
                    There are currently no borrowed books
                @endif

                @if ($borrowed_books->count() == 1)
                    There is currently {{$borrowed_books->count()}} borrowed book.
                @endif

                @if ($borrowed_books->count() > 1)
                    There are currently {{$borrowed_books->count()}} borrowed books.
                @endif
                
                </p>

            </div>
        </div>

        <div class="flex justify-center">
            <div class="block py-6 px-6 rounded-lg shadow-lg  text-center w-3/4">
                <i class="fa-solid fa-book text-2xl"></i> 
                <h5 class=" text-sm leading-tight font-medium mb-2">
                    Book/s request/s for borrowing:
                </h5>
                
                <p class=" text-base mb-4">
                
                    @if ($request_books->count() == 0)
                        There are currently no request.
                    @endif

                    @if ($request_books->count() == 1)
                        There is currently {{$request_books->count()}} request.
                    @endif

                    @if ($request_books->count() > 1)
                        There are currently {{$request_books->count()}} requests.
                    @endif
                </p>

            </div>
        </div>

        <div class="flex justify-center">
            <div class="block py-6 px-6 rounded-lg shadow-lg text-center  w-3/4">
                <i class="fa-solid fa-users-rectangle text-2xl"></i>
                <h5 class=" text-sm leading-tight font-medium mb-2 "> 
                    Borrower's card application:
                </h5>
                
                <p class=" text-base mb-4">
                    
                    @if ($borrowers_app->count() == 0)
                        There are currently no application
                    @endif

                    @if ($borrowers_app->count()== 1)
                        There is currently {{$borrowers_app->count()}} application.
                    @endif

                    @if ($borrowers_app->count() > 1)
                        There are currently {{$borrowers_app->count()}} applications.
                    @endif
                </p>

            </div>
        </div>
    
    </div>

    <br>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <div class="tem-grid">
            <div class="books_borrowed">
                <div class="card">
                    <div class="card-header">
                        <h3>Books currently borrowed</h3>
                        <x-button variant="danger" href="{{route('borrowing_librarian.borrowed_books.view')}}">
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
                                        <td>Borrowed Date</td>
                                        <td> Title </td>
                                        <td> Author </td>
                                        <td> Published </td>
                                        <td> Collection </td>
                                        <td> Status </td>                                  
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach ($borrowed_books as $book) 
                                    <tr>
                                        
                                        <td> {{$loop->iteration}} </td>
                                        <td> {{$book->borrowed_at}} </td>
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
            <div class="books_requested">
                <div class="card">
                    <div class="card-header">
                        <h3>Book/s request/s for borrowing</h3>
                        <x-button variant="danger" href="{{route('borrowing_librarian.requested_books.view')}}">
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
                                        <td>Request Date</td>
                                        <td> Book Title </td>
                                        <td> Borrower's First Name </td>
                                        <td> Borrower's Last Name </td>   
                                        <td> Status </td>
                                                                   
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach ($request_books as $rbook) 
                                    <tr>
                                        
                                        <td> {{$loop->iteration}} </td>
                                        <td> {{$rbook->created_at}} </td>
                                        <td> {{$rbook->title}} </td>
                                        <td> {{$rbook->firstName}} </td>
                                        <td> {{$rbook->lastName}} </td>
                                        <td> {{$rbook->status}} </td>
                                    </tr>
                                    @endforeach 
                                    

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="borrowers_card_app">
                <div class="card">
                    <div class="card-header">
                        <h3>Borrower's card application</h3>
                        <x-button variant="danger" href="{{route('borrowing_librarian.borrower_card_app.view')}}">
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
                                        <td>Request Date</td>
                                        <td> Borrower's First Name </td>
                                        <td> Borrower's Last Name </td>  
                                        <td> ID card</td> 
                                        <td> Status </td>                               
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($borrowers_app as $rborrower) 
                                    <tr>
                                        
                                        <td> {{$loop->iteration}} </td>
                                        <td> {{$rborrower->created_at}} </td>
                                        <td> {{$rborrower->firstName}} </td>
                                        <td> {{$rborrower->lastName}} </td>
                                        <td> {{$rborrower->id_card}} </td>
                                        <td> {{$rborrower->status}} </td>
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
</x-blibrarian-layout>

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
    font-size: 1rem;
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