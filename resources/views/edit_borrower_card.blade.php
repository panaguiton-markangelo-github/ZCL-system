<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __("Update Borrower Card Details") }}
            </h2>

           

        </div>
    </x-slot>

    <div class="p-6 mt-2 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
            Note: Your membership card will be updated, if you click the "update" button below. This will notify the librarian with the changes you have made.
        </p>
    </div>


    <div class="p-6 mt-2 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
       
        <form method="POST" action="{{ route('borrower.update')}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <input type="text" name="id" id="id" value="{{$member->id}}" hidden readonly>

            <div class="grid grid-cols-3 gap-3">
                <!-- Email -->
                <div class="space-y-2">
                    <x-form.label
                        for="email"
                        :value="__('Email')"
                    />

                    <x-form.input
                        id="email"
                        class="block w-full"
                        type="email"
                        name="email"
                        :value="$member->email"
                        required
                        autofocus
                        placeholder="{{ __('Email') }}"
                    />
                    
                </div>

                <!-- Phone -->
                <div class="space-y-2">
                    <x-form.label
                        for="phone"
                        :value="__('Phone')"
                    />

                    <x-form.input
                        id="phone"
                        class="block w-full"
                        type="text"
                        name="phone"
                        :value="$member->phone"
                        required
                        autofocus
                        placeholder="{{ __('Phone') }}"
                    />
                    
                </div>

                <!-- Address -->
                <div class="space-y-2">
                    <x-form.label
                        for="address"
                        :value="__('Address')"
                    />

                    <x-form.input
                        id="address"
                        class="block w-full"
                        type="text"
                        name="address"
                        :value="$member->address"
                        autofocus
                        required
                        placeholder="{{ __('Address') }}"
                    />
                    
                </div>

            </div>

            <!-- student/prof -->
            <div class="space-y-2 mt-5">
                <x-form.label
                    for="stud_prof"
                    :value="__('Please select if you are a student or professional')"
                />
                <select name="stud_prof" id="stud_prof" class="py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring
                focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1
                dark:text-gray-300 dark:focus:ring-offset-dark-eval-1" required>
                
                @if ($is_prof->count())
                    <option value="0"> Student</option>
                    <option value="1" selected> Professional </option> 
                @endif

                @if ($is_stud->count())
                    <option value="0" selected> Student</option>
                    <option value="1"> Professional </option>
                @endif

                </select>
            </div>

             
            <!-- If student fields -->
            <h2 id="stud_label" class="text-md mt-5 font-semibold leading-tight" style="display:none;">
                {{ __("If you are a student:") }}
            </h2>
            <div id="stud_fields" class="grid grid-cols-2 gap-2 mt-2" style="display:none;">
                @if ($is_stud->count())
                    <!-- School -->
                    <div class="space-y-2">
                        <x-form.label
                            for="school"
                            :value="__('School')"
                        />
                        <x-form.input
                            id="school"
                            class="block w-full"
                            type="text"
                            name="school"
                            :value="$is_stud[0]->school"
                            placeholder="{{ __('School') }}"
                            autofocus
                        />

                        @error('school')
                        <p class="text-red-500 text-xs p-1">
                            @error('school')
                                {{ $message }}
                            @enderror
                        </p>
                        @enderror
                        
                    </div>

                    <!-- Out of school-->
                    <div class="space-y-2">
                        <x-form.label
                            for="oos"
                            :value="__('Out of School')"
                        />

                        <select name="oos" id="oos" class="py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring
                        focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1
                        dark:text-gray-300 dark:focus:ring-offset-dark-eval-1 w-full">
                        
                        @if ($is_stud[0]->out_of_school == "NO")
                            <option value="NO" selected> NO </option>
                            <option value="YES"> YES </option>
                        @endif

                        @if ($is_stud[0]->out_of_school == "YES")
                            <option value="NO"> NO </option>
                            <option value="YES" selected> YES </option>
                        @endif

                    
                    
                        </select>

                        @error('oos')
                        <p class="text-red-500 text-xs p-1">
                            @error('oos')
                                {{ $message }}
                            @enderror
                        </p>
                        @enderror
                        
                    </div>

                    <!-- School Level -->
                    <div class="space-y-2">
                        <x-form.label
                            for="school_level"
                            :value="__('School Level')"
                        />

                        <select name="school_level" id="school_level" class="py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring
                        focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1
                        dark:text-gray-300 dark:focus:ring-offset-dark-eval-1 w-full">


                        @if($is_stud[0]->school_level == "Elementary")
                            <option value="Elementary" selected> Elementary </option>
                            <option value="Highschool"> Highschool </option>
                            <option value="College"> College </option>
                        @endif

                        @if($is_stud[0]->school_level == "Highschool")
                            <option value="Elementary"> Elementary </option>
                            <option value="Highschool" selected> Highschool </option>
                            <option value="College"> College </option>
                        @endif

                        @if($is_stud[0]->school_level == "College")
                            <option value="Elementary"> Elementary </option>
                            <option value="Highschool"> Highschool </option>
                            <option value="College" selected> College </option>
                        @endif
        
                        
                        </select>
                        
                        @error('school_level')
                        <p class="text-red-500 text-xs p-1">
                            @error('school_level')
                                {{ $message }}
                            @enderror
                        </p>
                        @enderror
                        
                    </div>

                    <!-- Grade/Year Level -->
                    <div class="space-y-2">
                        <x-form.label
                            for="grade_year_level"
                            :value="__('Grade/Year Level')"
                        />

                        <x-form.input
                            id="grade_year_level"
                            class="block w-full"
                            type="text"
                            name="grade_year_level"
                            :value="$is_stud[0]->grade_year_level"
                            autofocus
                            placeholder="{{ __('Grade/Year Level') }}"
                        />

                        @error('grade_year_level')
                        <p class="text-red-500 text-xs p-1">
                            @error('grade_year_level')
                                {{ $message }}
                            @enderror
                        </p>
                        @enderror
                        
                    </div>
                @else
                    <!-- School -->
                    <div class="space-y-2">
                        <x-form.label
                            for="school"
                            :value="__('School')"
                        />
                        <x-form.input
                            id="school"
                            class="block w-full"
                            type="text"
                            name="school"
                            :value="old('school')"
                            placeholder="{{ __('School') }}"
                            autofocus
                        />

                        @error('school')
                        <p class="text-red-500 text-xs p-1">
                            @error('school')
                                {{ $message }}
                            @enderror
                        </p>
                        @enderror
                        
                    </div>

                    <!-- Out of school-->
                    <div class="space-y-2">
                        <x-form.label
                            for="oos"
                            :value="__('Out of School')"
                        />

                        <select name="oos" id="oos" class="py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring
                        focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1
                        dark:text-gray-300 dark:focus:ring-offset-dark-eval-1 w-full">
        
                        <option value="" selected></option>
                        <option value="NO"> NO </option>
                        <option value="YES"> YES </option>
                    
                        </select>

                        @error('oos')
                        <p class="text-red-500 text-xs p-1">
                            @error('oos')
                                {{ $message }}
                            @enderror
                        </p>
                        @enderror
                        
                    </div>

                    <!-- School Level -->
                    <div class="space-y-2">
                        <x-form.label
                            for="school_level"
                            :value="__('School Level')"
                        />

                        <select name="school_level" id="school_level" class="py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring
                        focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1
                        dark:text-gray-300 dark:focus:ring-offset-dark-eval-1 w-full">
        
                        <option value="" selected></option>
                        <option value="Elementary"> Elementary </option>
                        <option value="Highschool"> Highschool </option>
                        <option value="College"> College </option>
                        </select>
                        
                        @error('school_level')
                        <p class="text-red-500 text-xs p-1">
                            @error('school_level')
                                {{ $message }}
                            @enderror
                        </p>
                        @enderror
                        
                    </div>

                    <!-- Grade/Year Level -->
                    <div class="space-y-2">
                        <x-form.label
                            for="grade_year_level"
                            :value="__('Grade/Year Level')"
                        />

                        <x-form.input
                            id="grade_year_level"
                            class="block w-full"
                            type="text"
                            name="grade_year_level"
                            :value="old('grade_year_level')"
                            autofocus
                            placeholder="{{ __('Grade/Year Level') }}"
                        />

                        @error('grade_year_level')
                        <p class="text-red-500 text-xs p-1">
                            @error('grade_year_level')
                                {{ $message }}
                            @enderror
                        </p>
                        @enderror
                        
                    </div>
                @endif
                
            </div>
             
            <!-- If professional fields -->
            <h2 id="prof_label" class="text-md mt-5 font-semibold leading-tight" style="display:none;">
                {{ __("If you are a professional:") }}
            </h2>
            <div id="prof_fields" class="grid grid-cols-2 gap-2 mt-2" style="display:none;">
                @if ($is_prof->count())
                    <!-- position -->
                    <div class="space-y-2">
                        <x-form.label
                            for="position"
                            :value="__('Position')"
                        />
                        <x-form.input
                            id="position"
                            class="block w-full"
                            type="text"
                            name="position"
                            :value="$is_prof[0]->position"
                            placeholder="{{ __('Position') }}"
                            autofocus
                        />

                        @error('position')
                        <p class="text-red-500 text-xs p-1">
                            @error('position')
                                {{ $message }}
                            @enderror
                        </p>
                        @enderror
                        
                    </div>

                    <!-- office -->
                    <div class="space-y-2">
                        <x-form.label
                            for="office"
                            :value="__('Office')"
                        />

                        <x-form.input
                            id="office"
                            class="block w-full"
                            type="text"
                            name="office"
                            :value="$is_prof[0]->office"
                        
                            autofocus
                            placeholder="{{ __('Office') }}"
                        />

                        @error('office')
                        <p class="text-red-500 text-xs p-1">
                            @error('office')
                                {{ $message }}
                            @enderror
                        </p>
                        @enderror
                        
                    </div>

                    <!-- office address -->
                    <div class="space-y-2">
                        <x-form.label
                            for="office_address"
                            :value="__('Office Address')"
                        />

                        <x-form.input
                            id="office_address"
                            class="block w-full"
                            type="text"
                            name="office_address"
                            :value="$is_prof[0]->office_address"
                        
                            autofocus
                            placeholder="{{ __('Office Address') }}"
                        />

                        @error('office_address')
                        <p class="text-red-500 text-xs p-1">
                            @error('office_address')
                                {{ $message }}
                            @enderror
                        </p>
                        @enderror
                        
                    </div>

                    <!-- Tel.NO(work) -->
                    <div class="space-y-2">
                        <x-form.label
                            for="tel_no_work"
                            :value="__('Tel.No (Work)')"
                        />

                        <x-form.input
                            id="tel_no_work"
                            class="block w-full"
                            type="text"
                            name="tel_no_work"
                            :value="$is_prof[0]->tel_no_work"
                        
                            autofocus
                            placeholder="{{ __('Tel.No (Work)') }}"
                        />

                        @error('tel_no_work')
                        <p class="text-red-500 text-xs p-1">
                            @error('tel_no_work')
                                {{ $message }}
                            @enderror
                        </p>
                        @enderror
                        
                    </div>
                @else
                    <!-- position -->
                    <div class="space-y-2">
                        <x-form.label
                            for="position"
                            :value="__('Position')"
                        />
                        <x-form.input
                            id="position"
                            class="block w-full"
                            type="text"
                            name="position"
                            :value="old('position')"
                            placeholder="{{ __('Position') }}"
                            autofocus
                        />

                        @error('position')
                        <p class="text-red-500 text-xs p-1">
                            @error('position')
                                {{ $message }}
                            @enderror
                        </p>
                        @enderror
                        
                    </div>

                    <!-- office -->
                    <div class="space-y-2">
                        <x-form.label
                            for="office"
                            :value="__('Office')"
                        />

                        <x-form.input
                            id="office"
                            class="block w-full"
                            type="text"
                            name="office"
                            :value="old('office')"
                        
                            autofocus
                            placeholder="{{ __('Office') }}"
                        />

                        @error('office')
                        <p class="text-red-500 text-xs p-1">
                            @error('office')
                                {{ $message }}
                            @enderror
                        </p>
                        @enderror
                        
                    </div>

                    <!-- office address -->
                    <div class="space-y-2">
                        <x-form.label
                            for="office_address"
                            :value="__('Office Address')"
                        />

                        <x-form.input
                            id="office_address"
                            class="block w-full"
                            type="text"
                            name="office_address"
                            :value="old('office_address')"
                        
                            autofocus
                            placeholder="{{ __('Office Address') }}"
                        />

                        @error('office_address')
                        <p class="text-red-500 text-xs p-1">
                            @error('office_address')
                                {{ $message }}
                            @enderror
                        </p>
                        @enderror
                        
                    </div>

                    <!-- Tel.NO(work) -->
                    <div class="space-y-2">
                        <x-form.label
                            for="tel_no_work"
                            :value="__('Tel.No (Work)')"
                        />

                        <x-form.input
                            id="tel_no_work"
                            class="block w-full"
                            type="text"
                            name="tel_no_work"
                            :value="old('tel_no_work')"
                        
                            autofocus
                            placeholder="{{ __('Tel.No (Work)') }}"
                        />

                        @error('tel_no_work')
                        <p class="text-red-500 text-xs p-1">
                            @error('tel_no_work')
                                {{ $message }}
                            @enderror
                        </p>
                        @enderror
                        
                    </div>
                @endif

            </div>
            
             
           

            <!-- ID card -->
            <div class="space-y-2 mt-5">
                <x-form.label
                    for="id_card"
                    :value="__('Please select your ID card')"
                />
                <select name="id_card" id="id_card" class="py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring
                focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1
                dark:text-gray-300 dark:focus:ring-offset-dark-eval-1" required>

                @if($member->id_card == "Philhealth ID")
                    <option value="Ph National ID"> Ph National ID </option>
                    <option value="Philhealth ID" selected> Philhealth ID </option>
                    <option value="SSS ID"> SSS ID </option>
                    <option value="GSIS ID"> GSIS ID </option>
                    <option value="Government ID"> Government ID </option>
                    <option value="Student ID"> Student ID  </option>
                @endif

                @if($member->id_card == "SSS ID")
                    <option value="Ph National ID"> Ph National ID </option>
                    <option value="Philhealth ID"> Philhealth ID </option>
                    <option value="SSS ID" selected> SSS ID </option>
                    <option value="GSIS ID"> GSIS ID </option>
                    <option value="Government ID"> Government ID </option>
                    <option value="Student ID"> Student ID  </option>
                @endif

                @if($member->id_card == "GSIS ID")
                    <option value="Ph National ID"> Ph National ID </option>
                    <option value="Philhealth ID"> Philhealth ID </option>
                    <option value="SSS ID"> SSS ID </option>
                    <option value="GSIS ID" selected> GSIS ID </option>
                    <option value="Government ID"> Government ID </option>
                    <option value="Student ID"> Student ID  </option>
                @endif

                @if($member->id_card == "Government ID")
                    <option value="Ph National ID"> Ph National ID </option>
                    <option value="Philhealth ID"> Philhealth ID </option>
                    <option value="SSS ID"> SSS ID </option>
                    <option value="GSIS ID"> GSIS ID </option>
                    <option value="Government ID" selected> Government ID </option>
                    <option value="Student ID"> Student ID  </option>
                @endif

                @if($member->id_card == "Student ID")
                    <option value="Ph National ID"> Ph National ID </option>
                    <option value="Philhealth ID"> Philhealth ID </option>
                    <option value="SSS ID"> SSS ID </option>
                    <option value="GSIS ID"> GSIS ID </option>
                    <option value="Government ID"> Government ID </option>
                    <option value="Student ID" selected> Student ID  </option>
                @endif

                @if($member->id_card == "Ph National ID")
                    <option value="Ph National ID" selected> Ph National ID  </option>
                    <option value="Philhealth ID"> Philhealth ID </option>
                    <option value="SSS ID"> SSS ID </option>
                    <option value="GSIS ID"> GSIS ID </option>
                    <option value="Government ID"> Government ID </option>
                    <option value="Student ID"> Student ID  </option>
                @endif

                </select>
                <p class="mx-2 text-sm"> Note: The selected ID will be presented on the Zamboanga City Library, if your request to borrow books are approved.</p>
            </div>

            <!-- Image for the borrower ID -->
            <div class="mt-6 space-y-6">
                <x-form.label
                    for="b_image"
                    :value="__('Upload an image of your ID (max size: 5mb)')"
                />

                <x-form.input
                    id="b_image"
                    name="b_image"
                    type="file"
                    class="block w-3/4"
                    :value="old('b_image')"
                    placeholder="{{ __('Image') }}"
                    required
                    autofocus
                />

                @error('b_image')
                    <p class="text-red-500 text-xs p-1">
                        @error('b_image')
                            {{ $message }}
                        @enderror
                    </p>
                @enderror 
            </div>

          
            <x-button variant="success" class="justify-center mt-5 w-50 gap-2">
                {{ __('Update') }}
            </x-button>
            
        </form>
        
    </div>

    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

    <script>
        
        $('#stud_prof').change(function(){
          if($(this).val()==="0"){
            $('#stud_label').show();
            $('#stud_fields').show();
            $('#prof_label').hide();
            $('#prof_fields').hide();
           
          }
          else if($(this).val()==="1"){
            $('#stud_label').hide();
            $('#stud_fields').hide();
            $('#prof_label').show();
            $('#prof_fields').show();
          }

          else if($(this).val()===""){
            $('#stud_label').hide();
            $('#stud_fields').hide();
            $('#prof_label').hide();
            $('#prof_fields').hide();
          }
        }).change();
    </script>
    
</x-app-layout>

