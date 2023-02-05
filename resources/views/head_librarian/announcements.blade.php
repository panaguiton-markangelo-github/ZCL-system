<x-hlibrarian-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __("Announcements") }}
            </h2>

           
        </div>
    </x-slot>

    <div class="p-6 mt-2 bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <div class="sm:rounded-lg">
            <div class="max-w-xl">
                @include('head_librarian.partials.add_announcement')
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

        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
              <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-x-auto">
                  <table id="table" class="min-w-full">
                    <thead>
                         <tr>
                            <th scope="col" class="text-sm font-medium  px-6 py-4 text-left">No.</th>
                            <th scope="col" class="text-sm font-medium  px-6 py-4 text-left">Details</th>
                            <th scope="col" class="text-sm font-medium  px-6 py-4 text-left"></th>
                            
                        </tr>

                        <tr>
                            <th scope="col" class="text-sm font-medium  dark:text-gray-900 px-6 py-4 text-left">No.</th>
                            <th scope="col" class="text-sm font-medium  dark:text-gray-900 px-6 py-4 text-left">Details</th>
                            <th scope="col" class="text-sm font-medium  dark:text-gray-900 px-6 py-4 text-left"></th>
                            
                        </tr>
                    </thead>
                    <tbody>

                            @foreach ($data as $announce)
                     
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$announce->details}}</td>
                                

                                    <td>
                                    
                
                                        <div class="sm:rounded-lg">
                                            <div class="max-w-xl">
                                                <x-button variant="success" href="/head_librarian/edit/announcement/{{ $announce->id }}">
                                                    <i class="fa-solid fa-pen-to-square mx-2"></i>
                                                    <span>{{ __('Edit Announcement') }}</span>
                                                </x-button> 
                                            
                                            </div>
                                        </div>  
                                        

                                
                                    </td>
                                </tr>
                            @endforeach 
                           
                           
                       </tbody>
               
                       <tfoot>
                           <tr>
                                <th scope="col" class="text-sm font-medium  px-6 py-4 text-left">No.</th>
                                <th scope="col" class="text-sm font-medium  px-6 py-4 text-left">Details</th>
                                <th scope="col" class="text-sm font-medium  px-6 py-4 text-left"></th>
                                
                            </tr>
                       </tfoot>
                  </table>
                </div>
              </div>
            </div>
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
                             var select = $('<select><option value=""></option></select>')
                                 .appendTo($(column.header()).empty())
                                 .on('change', function () {
                                     var val = $.fn.dataTable.util.escapeRegex($(this).val());
         
                                     column.search(val ? '^' + val + '$' : '', true, false).draw();
                                 });
         
                             column
                                 .data()
                                 .unique()
                                 .sort()
                                 .each(function (d, j) {
                                     select.append('<option value="' + d + '">' + d + '</option>');
                                 });
                         });
                 },
             });
         });
    </script>
</x-hlibrarian-layout>

<style>
    .dataTables_wrapper .dataTables_length select {
        padding-right: 25px;
    }
    tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
</style>

