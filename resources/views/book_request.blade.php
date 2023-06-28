<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __("Choose book/s to borrow from your basket:") }}
            </h2>

        </div>
    </x-slot>

    <div class="p-6 mt-2 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
            Note: Your request to borrow book/s will be processed by the librarian,
            kindly wait for the notification if your request was approved or declined.
        </p>
    </div>


    <div class="p-6 mt-2 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">

        <input type="checkbox" name = "select_all"  id="select_all">
        <label for="select_all">Book Title</label> 

        <form action="{{ route('book_req.store') }}" method="POST">
            @csrf
            @foreach ($cart as $item)
                <input type="checkbox" class="checkbox" name = "book_reqs[]" value="{{$item->id}}" id="book_reqs.{{$item->id}}">
                <label for="book_reqs.{{$item->id}}">{{$item->name}}</label>    
            @endforeach
                @error('book_reqs')
                <p class="text-red-500 text-xs p-1">
                    @error('book_reqs')
                        {{ $message }}
                    @enderror
                </p>
                @enderror 

            <div>
                <x-button variant="success" class="justify-center mt-5 w-50 gap-2">
                    <span>{{ __('Confirm') }}</span>
                </x-button>
            </div>
       </form>

       
    </div>

    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function(){
            $('#select_all').on('click',function(){
                if(this.checked){
                    $('.checkbox').each(function(){
                        this.checked = true;
                    });
                }else{
                    $('.checkbox').each(function(){
                        this.checked = false;
                    });
                }
            });
            
            $('.checkbox').on('click',function(){
                if($('.checkbox:checked').length == $('.checkbox').length){
                    $('#select_all').prop('checked',true);
                }else{
                    $('#select_all').prop('checked',false);
                }
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

    /*Checkboxes styles*/
    input[type="checkbox"] { 
        display: none; 
    }

    input[type="checkbox"] + label {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 20px;
        cursor: pointer;
    }

    input[type="checkbox"] + label:last-child { margin-bottom: 0; }

    input[type="checkbox"] + label:before {
        content: '';
        display: block;
        width: 20px;
        height: 20px;
        border: 1px solid #6cc0e5;
        position: absolute;
        left: 0;
        top: 0;
        opacity: .6;
        -webkit-transition: all .12s, border-color .08s;
        transition: all .12s, border-color .08s;
    }

    input[type="checkbox"]:checked + label:before {
        width: 10px;
        top: -5px;
        left: 5px;
        border-radius: 0;
        opacity: 1;
        border-top-color: transparent;
        border-left-color: transparent;
        -webkit-transform: rotate(45deg);
        transform: rotate(45deg);
    }

    input[type=checkbox] {
        display:none;
    }
</style>

