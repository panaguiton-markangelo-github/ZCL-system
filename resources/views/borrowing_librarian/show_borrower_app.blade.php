<x-blibrarian-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __("Information for this application") }}
            </h2>

        </div>
    </x-slot>

    
    <div class="p-6 mt-2 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">

        <p class="mt-1 font-bold text-xl text-gray-600 dark:text-gray-400 text-center">
            {{ __('Borrower Card Application Information') }} (Request Status: {{$borrowers_app[0]->status}})
        </p>

        <p class="mt-1 font-bold text-md text-gray-600 dark:text-gray-400 text-center">
            {{ __('Request Date: ') }} {{$borrowers_app[0]->created_at}}
        </p>

        <br>
        <hr>
        <br>
        
        <p class="mt-1 font-bold text-xl text-gray-600 dark:text-gray-400 text-center">
            {{ __('Borrower Card Application Information') }}
        </p>

        <br>
        <hr>

        <div class="grid grid-cols-4 gap-4 text-center">
            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('First Name: ') }} {{$borrowers_app[0]->firstName}} 
                </p>
            </div>
            
            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('Last Name: ') }} {{$borrowers_app[0]->lastName}} 
                </p>

            </div>

            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('Email: ') }} {{$borrowers_app[0]->email}} 
                </p>

            </div>

            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('Phone: ') }} {{$borrowers_app[0]->phone}} 
                </p>

            </div>

           
        </div>

        <br>

        <div class="grid grid-cols-4 gap-4 text-center">
            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('Address: ') }} {{$borrowers_app[0]->address}} 
                </p>
            </div>
            
            <div>
                @if ($borrowers_app[0]->type == '0')
                    <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                        {{ __('Borrower Type: ') }} {{ __('NON-LGU') }} 
                    </p>
                @endif

                @if ($borrowers_app[0]->type == '1')
                    <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                        {{ __('Borrower Type: ') }} {{ __('LGU') }} 
                    </p>
                 @endif

                 @if ($borrowers_app[0]->type == '2')
                    <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                        {{ __('Borrower Type: ') }} {{ __('RECOMMENDED') }} 
                    </p>
                 @endif
               

            </div>

            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('ID card: ') }} {{$borrowers_app[0]->id_card}} 
                </p>

            </div>

            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('Status: ') }} {{$borrowers_app[0]->status}} 
                </p>

            </div>

           
        </div>

        <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
            {{ __('ID card (image): ') }}
        </p>
        <div class="mt-2 flex justify-start">
            <img class="border-solid border-4 border-red-500" src="{{ asset('storage/'.$borrowers_app[0]->b_image) }}" alt="none" width="200" height="200">
        </div>

        @if ($is_prof->count())

            <br>

            <p class="mt-1 font-bold text-xl text-gray-600 dark:text-gray-400 text-center">
                {{ __('Profession Information') }}
            </p>
    
            <br>
            <hr>

            <div class="grid grid-cols-4 gap-4 text-center">

                <div>
                    <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                        {{ __('Position: ') }} {{$is_prof[0]->position}} 
                    </p>
                </div>
                
                <div>
                
                    <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                        {{ __('Office: ') }}  {{$is_prof[0]->office}} 
                    </p>

                </div>

                <div>
                    <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                        {{ __('Office Address: ') }} {{$is_prof[0]->office_address}} 
                    </p>

                </div>

                <div>
                    <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                        {{ __('Telephone No. (Work): ') }} {{$is_prof[0]->tel_no_work}} 
                    </p>
                </div>

            
            </div>

        @endif

        @if ($is_stud->count())

            <br>

            <p class="mt-1 font-bold text-xl text-gray-600 dark:text-gray-400 text-center">
                {{ __('Student Information') }}
            </p>
    
            <br>
            <hr>

            <div class="grid grid-cols-4 gap-4 text-center">

                <div>
                    <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                        {{ __('School: ') }} {{$is_stud[0]->school}} 
                    </p>
                </div>
                
                <div>
                
                    <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                        {{ __('Out of School: ') }}  {{$is_stud[0]->out_of_school}} 
                    </p>

                </div>

                <div>
                    <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                        {{ __('School Level: ') }} {{$is_stud[0]->school_level}} 
                    </p>

                </div>

                <div>
                    <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                        {{ __('Grade/Year Level: ') }} {{$is_stud[0]->grade_year_level}} 
                    </p>
                </div>

            
            </div>

        @endif

        @if ($is_rec->count())

            <br>

            <p class="mt-1 font-bold text-xl text-gray-600 dark:text-gray-400 text-center">
                {{ __('Recommended Information') }}
            </p>
    
            <br>
            <hr>

            <div class="grid grid-cols-4 gap-4 text-center">

                <div>
                    <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                        {{ __('Recommended by: ') }} {{$is_rec[0]->rec_by}} 
                    </p>
                </div>
                
                <div>
                
                    <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                        {{ __('Position: ') }}  {{$is_rec[0]->rec_by_position}} 
                    </p>

                </div>

                <div>
                    <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                        {{ __('Office: ') }} {{$is_rec[0]->rec_by_office}} 
                    </p>

                </div>

                <div>
                    <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                        {{ __('Office Address: ') }} {{$is_rec[0]->rec_by_office_address}} 
                    </p>
                </div>

            
            </div>

            <br>

            <div class="grid grid-cols-3 gap-3 text-center">

                <div>
                    <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                        {{ __('Home Adress: ') }} {{$is_rec[0]->rec_by_home_address}} 
                    </p>
                </div>
                
                <div>
                
                    <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                        {{ __('Telephone No. (Work): ') }}  {{$is_rec[0]->rec_by_tel_no_work}} 
                    </p>

                </div>

                <div>
                    <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                        {{ __('Cellphone No.: ') }} {{$is_rec[0]->rec_by_cel_no}} 
                    </p>

                </div>
            
            </div>

            <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                {{ __('ID card (image): ') }}
            </p>
            <div class="mt-2 flex justify-start">
                <img class="border-solid border-4 border-red-500" src="{{ asset('storage/'.$is_rec[0]->r_image) }}" alt="none" width="200" height="200">
            </div>

        @endif


        
        <!-- Buttons -->
        <div class="mt-6 flex justify-end">
            <x-button
                variant="danger"
                href="{{route('borrowing_librarian.borrower_card_app.view')}}"
            >
                {{ __('Go Back') }}
            </x-button>

        </div>

        <br>
        <hr>
        <br>

        @if ($borrowers_app[0]->status == 'PENDING')
            <div class="grid grid-cols-2 gap-2 text-center">
                    
                
                <div class="sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('borrowing_librarian.partials.approve_borrower')
                    </div>
                </div>   

                <div class="sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('borrowing_librarian.partials.decline_borrower')
                    </div>
                </div>   
                
            </div>
        @endif

        @if ($borrowers_app[0]->status == 'APPROVED')
            <div class="flex justify-center text-center">
                     
                <p class="text-sm text-cyan-600 dark:text-cyan-400 text-center font-bold">
                    You have approved this Borrower Card Application.
                </p>
                
            </div>
        @endif

        @if ($borrowers_app[0]->status == 'DECLINED')
            <div class="flex justify-center text-center">
                
                <p class="text-sm text-cyan-600 dark:text-cyan-400 text-center font-bold">
                    You have declined this Borrower Card Application.
                </p>

            </div>
        @endif
        

    </div>

   
</x-blibrarian-layout>



