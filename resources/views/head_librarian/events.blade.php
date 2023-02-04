<x-hlibrarian-layout>
    {{-- This is the style sheet for full calendar css --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" />
    <link rel="stylesheet" href="@sweetalert2/theme-material-ui/material-ui.css">

    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __("Events") }}
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
                @include('head_librarian.partials.add_event')
            </div>
        </div>   
        
    </div>


    <div class="p-6 mt-2 bg-white rounded-md shadow-md dark:bg-dark-eval-1">
    
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
        
        <div id="calendar"></div>
    
    </div>

    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script> --}}

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
    
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    {{-- script tag for full calendar --}}
    <script>
      $(document).ready(function () {
          $.ajaxSetup({
              headers:{
                  'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
              }
          });
  
          var calendar = $('#calendar').fullCalendar({
            editable:true,
            timeZone: 'Asia/Manila',
            allDay:true,
            initialView: 'listWeek',
            views: {
                listDay: { buttonText: 'list day' },
                listWeek: { buttonText: 'list week' },
                listMonth: { buttonText: 'list month' }
            },
            header:{
                left:'prev,next,today',
                center:'title',
                right:'month,agendaWeek,agendaDay,listWeek,listMonth'
            },
            events:'/head_librarian/events',
            selectable:true,
            selectHelper:true,
            select: async function(start, end, allDay)
            {   
                const { value: title } = await Swal.fire({
                    title: 'Create an event',
                    input: 'text',
                    inputLabel: 'Event Title (for the date/s): ',
                    inputPlaceholder: 'Enter the event title',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Confirm',
                    inputValidator: (value) => {
                        if (!value) {
                            return 'You need to enter some title!'
                        }
                    }
                })

                // if (email) {
                //     Swal.fire(`Entered email: ${email}`)
                // }

                // var title = prompt('Event Title (Create an event):');

                if(title)
                {
                    var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');

                    var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');

                    $.ajax({
                        url:"/head_librarian/add/event",
                        type:"POST",
                        data:{
                            title: title,
                            start: start,
                            end: end,
                            type: 'add'
                        },
                        success:function(data)
                        {
                            calendar.fullCalendar('refetchEvents');
                            Swal.fire(
                                'Created!',
                                'The event was successfully created!.',
                                'success'
                            )
                            // alert("Event Created Successfully");
                        }
                    })
                }
            },
            editable:true,
            eventResize: function(event, delta)
            {
                var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                var title = event.title;
                var id = event.id;
                $.ajax({
                    url:"/head_librarian/update/event",
                    type:"POST",
                    data:{
                        title: title,
                        start: start,
                        end: end,
                        id: id,
                        type: 'update'
                    },
                    success:function(response)
                    {
                        calendar.fullCalendar('refetchEvents');
                        Swal.fire(
                            'Updated!',
                            'The event was updated successfully!',
                            'success'
                        )
                    }
                })
            },
            eventDrop: function(event, delta)
            {
                var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                var title = event.title;
                var id = event.id;
                $.ajax({
                    url:"/head_librarian/update/event",
                    type:"POST",
                    data:{
                        title: title,
                        start: start,
                        end: end,
                        id: id,
                        type: 'update'
                    },
                    success:function(response)
                    {
                        calendar.fullCalendar('refetchEvents');
                        Swal.fire(
                            'Updated!',
                            'The event was updated successfully!',
                            'success'
                        )
                    }
                })
            },

            eventClick:function(event)
            {

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This will permanently delete the event!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var id = event.id;
                        $.ajax({
                            url:"/head_librarian/delete/event",
                            type:"POST",
                            data:{
                                id:id,
                                type:"delete"
                            },
                            success:function(response)
                            {
                                calendar.fullCalendar('refetchEvents');
                                Swal.fire(
                                    'Deleted!',
                                    'The event was successfully deleted!.',
                                    'success'
                                )
                            }
                        })
                        
                    }
                })
                
                // if(confirm("Are you sure you want to remove it?"))
                // {
                //     var id = event.id;
                //     $.ajax({
                //         url:"/head_librarian/delete/event",
                //         type:"POST",
                //         data:{
                //             id:id,
                //             type:"delete"
                //         },
                //         success:function(response)
                //         {
                //             calendar.fullCalendar('refetchEvents');
                //             alert("Event Deleted Successfully");
                //         }
                //     })
                // }
            }

          });
      });
  </script>


    {{-- <script>
           $(document).ready(function () {
                $('#table').DataTable({
                responsive: true,
                scrollX: true
            });
            });
    </script> --}}
</x-hlibrarian-layout>

<style>
    tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
</style>

