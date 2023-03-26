<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __("Borrower Card Details") }}
            </h2>

           

        </div>
    </x-slot>

    <div class="p-6 mt-2 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
            Note: In this page, your membership card details are shown. You can choose to start edit your details by clicking the "edit" button below.
        </p>
    </div>


    <div class="p-6 mt-2 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
       
        <p class="mt-1 font-bold text-xl text-gray-600 dark:text-gray-400 text-center">
            {{ __('Borrower Card Information') }}
        </p>

        <br>
        <hr>

        <div class="grid grid-cols-4 gap-4 text-center">
            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('First Name: ') }} {{$member[0]->firstName}} 
                </p>
            </div>
            
            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('Last Name: ') }} {{$member[0]->lastName}} 
                </p>

            </div>

            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('Email: ') }} {{$member[0]->email}} 
                </p>

            </div>

            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('Phone: ') }} {{$member[0]->phone}} 
                </p>

            </div>

           
        </div>

        <br>

        <div class="grid grid-cols-4 gap-4 text-center">
            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('Address: ') }} {{$member[0]->address}} 
                </p>
            </div>
            
            <div>
                @if ($member[0]->type == '0')
                    <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                        {{ __('Borrower Type: ') }} {{ __('NON-LGU') }} 
                    </p>
                @endif

                @if ($member[0]->type == '1')
                    <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                        {{ __('Borrower Type: ') }} {{ __('LGU') }} 
                    </p>
                 @endif

                 @if ($member[0]->type == '2')
                    <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                        {{ __('Borrower Type: ') }} {{ __('RECOMMENDED') }} 
                    </p>
                 @endif
               

            </div>

            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('ID card: ') }} {{$member[0]->id_card}} 
                </p>

            </div>

            <div>
                <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                    {{ __('Status: ') }} {{$member[0]->status}} 
                </p>

            </div>

           
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

        @endif

        <div>
            <x-button class="justify-center mt-5" href="/borrower/card/edit/{{$member[0]->id}}">
                <span>{{ __('Edit') }}</span>
            </x-button>
        </div>
        
       
    </div>

</x-app-layout>


