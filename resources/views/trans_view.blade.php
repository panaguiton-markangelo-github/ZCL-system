<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __("Book Borrow Transactions") }}
            </h2>


        </div>
    </x-slot>

    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        @if($request_book->count() == 0)
            <p>No transactions</p>
        @else
            @foreach ($request_book as $req)
                @if($req->bookReqStatus == "APPROVED")
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                        <p class="font-bold">Request status: {{$req->bookReqStatus}}</p>
                        <p>Book title: {{$req->title}}</p>
                        <p>Available pickup at (date and time): {{$req->avail_at}}</p>
                        <p>Due date for the books to be returned (date and time): {{$req->due_at}}</p>
                        <p>Request sent at: {{$req->created_at}}</p>
                        <p>Request updated at: {{$req->updated_at}}</p>
                    </div>
                @endif

                @if($req->bookReqStatus == "RELEASED")
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                        <p class="font-bold">Request status: {{$req->bookReqStatus}}</p>
                        <p>Book title: {{$req->title}}</p>
                        <p>Important Notes:
                            <br>
                            Lost/Damaged Books = Replacement.
                            <br>
                           Over-due fine = Php 2.00/day per book
                        </p>
                        <p>Due date for the books to be returned (date and time): {{$req->due_at}}</p>
                        <p>Request sent at: {{$req->created_at}}</p>
                        <p>Request updated at: {{$req->updated_at}}</p>
                    </div>
                @endif

                @if($req->bookReqStatus == "PENDING")
                    <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
                        <p class="font-bold">Request status: {{$req->bookReqStatus}}</p>
                        <p>Book title: {{$req->title}}</p>
                        <p>Request sent at: {{$req->created_at}}</p>
                        <p>Request updated at: {{$req->updated_at}}</p>
                    </div>
                @endif

                @if($req->bookReqStatus == "DECLINED")
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                        <p class="font-bold">Request status: {{$req->bookReqStatus}}</p>
                        <p>Book title: {{$req->title}}</p>
                        <p>Request sent at: {{$req->created_at}}</p>
                        <p>Request updated at: {{$req->updated_at}}</p>
                    </div>
                @endif

                @if($req->bookReqStatus == "CANCELLED")
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                        <p class="font-bold">Request status: {{$req->bookReqStatus}}</p>
                        <p>Book title: {{$req->title}}</p>
                        <p>Request sent at: {{$req->created_at}}</p>
                        <p>Request updated at: {{$req->updated_at}}</p>
                    </div>
                @endif
                
            @endforeach
        @endif

    </div>

    
</x-app-layout>


