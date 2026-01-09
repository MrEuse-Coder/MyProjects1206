<x-layout>
    <div class="min-h-screen bg-gray-50">
        <form action="/class_batch/students/{{ $student->id }}/store"
              method="POST"
              class="max-w-7xl mx-auto p-6"
              onsubmit="handleSubmit(event)">
            @csrf

            <!-- Student Info Header -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <div class="flex flex-wrap gap-6 items-center">
                    <div class="text-lg">
                        <span class="text-gray-600">Student No.:</span>
                        <span class="font-bold text-gray-900 uppercase ml-2">{{ $student->student_number }}</span>
                    </div>
                    <div class="h-8 w-px bg-gray-300"></div>
                    <div class="text-lg">
                        <span class="text-gray-600">Name:</span>
                        <span class="font-bold text-gray-900 uppercase ml-2">
                            {{ $student->last_name }}, {{ $student->first_name }}
                        </span>
                    </div>
                </div>
            </div>

            @if($subjectExist)
                <!-- Table Header -->
                <div class="bg-gradient-to-r from-violet-600 to-violet-700 rounded-t-lg p-4 mb-1 shadow-md sticky top-0 z-10">
                    <div class="grid grid-cols-3 text-white font-bold text-center items-center">
                        <div class="flex justify-center gap-4">
                            <div class="w-32">MIDTERM</div>
                            <div class="w-32">FINALS</div>
                        </div>
                        <div>COURSE CODE</div>
                        <div>DESCRIPTIVE TITLE</div>
                    </div>
                </div>

                <!-- Subjects by Year and Semester -->
                @php
                    $yearSemesters = [
                        ['year' => 'FIRST YEAR', 'semesters' => [
                            ['title' => 'First Semester', 'subjects' => $subjectsYear1Sem1],
                            ['title' => 'Second Semester', 'subjects' => $subjectsYear1Sem2]
                        ]],
                        ['year' => 'SECOND YEAR', 'semesters' => [
                            ['title' => 'First Semester', 'subjects' => $subjectsYear2Sem1],
                            ['title' => 'Second Semester', 'subjects' => $subjectsYear2Sem2]
                        ]],
                        ['year' => 'THIRD YEAR', 'semesters' => [
                            ['title' => 'First Semester', 'subjects' => $subjectsYear3Sem1],
                            ['title' => 'Second Semester', 'subjects' => $subjectsYear3Sem2]
                        ]],
                        ['year' => 'FOURTH YEAR', 'semesters' => [
                            ['title' => 'First Semester', 'subjects' => $subjectsYear4Sem1],
                            ['title' => 'Second Semester', 'subjects' => $subjectsYear4Sem2]
                        ]]
                    ];
                @endphp

                @foreach($yearSemesters as $yearData)
                    <!-- Year Header -->
                    <div class="bg-violet-100 border-l-4 border-violet-600 px-4 py-3 mt-6 mb-3 rounded">
                        <h2 class="text-xl font-bold text-violet-900">{{ $yearData['year'] }}</h2>
                    </div>

                    @foreach($yearData['semesters'] as $semesterData)
                        @if(count($semesterData['subjects']) > 0)
                            <!-- Semester Header -->
                            <div class="bg-gray-100 px-4 py-2 mb-2 rounded">
                                <h3 class="text-lg font-semibold text-gray-700">{{ $semesterData['title'] }}</h3>
                            </div>

                            <!-- Subject List -->
                            <div class="space-y-2 mb-4">
                                @foreach($semesterData['subjects'] as $subject)
                                    <div class="grid grid-cols-3 items-center bg-white rounded-lg shadow-sm p-4 hover:shadow-md transition-shadow duration-200">

                                        @php
                                            // Get the pivot data for this student
                                            $studentSubject = $subject->students->first();
                                            $midterm = $studentSubject->pivot->midterm ?? '';
                                            $final = $studentSubject->pivot->final ?? '';
                                        @endphp

                                        <!-- Grades Input -->
                                        <div class="flex justify-center gap-4">
                                            <input type="text"
                                                   name="midterm[{{ $subject->id }}]"
                                                   class="w-32 px-3 py-2 bg-violet-50 border border-violet-200 rounded-md text-center focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition"
                                                   placeholder="0.0"
                                                   value="{{ $midterm}}"
                                                   pattern="[0-9]*\.?[0-9]*"
                                                   maxlength="4"/>

                                            <input type="text"
                                                   name="final[{{ $subject->id }}]"
                                                   class="w-32 px-3 py-2 bg-violet-50 border border-violet-200 rounded-md text-center focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition"
                                                   placeholder="0.0"
                                                   value="{{ $final}}"
                                                   pattern="[0-9]*\.?[0-9]*"
                                                   maxlength="4"/>
                                        </div>

                                        <!-- Course Code -->
                                        <div class="text-center">
                                            <span class="inline-block px-3 py-1 bg-violet-100 text-violet-800 font-bold rounded-md uppercase text-sm">
                                                {{ $subject->course_code }}
                                            </span>
                                        </div>

                                        <!-- Descriptive Title -->
                                        <div class="text-center">
                                            <span class="font-semibold text-gray-800 uppercase text-sm">
                                                {{ $subject->descriptive_title }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @endforeach
                @endforeach

                <!-- Submit Button -->
                <div class="flex items-center justify-center mt-8 mb-6">
                    <button
                        type="submit"
                        id="submitBtn"
                        class="bg-violet-800 text-white font-bold py-3 px-8 rounded-lg transition-all duration-200 transform hover:scale-105 active:scale-95 hover:bg-violet-900 hover:shadow-lg">
                        Save Grades
                    </button>
                </div>

                <script>
                    function handleSubmit(event) {
                        const btn = document.getElementById('submitBtn');
                        btn.disabled = true;
                        btn.innerHTML = `
                            <span class="flex items-center gap-2">
                                <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Saving...
                            </span>
                        `;
                        btn.classList.add('opacity-50', 'cursor-not-allowed');
                        // Form will submit naturally after this
                    }
                </script>

            @else
                <!-- Empty State -->
                <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                    <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">No Subjects Available</h3>
                    <p class="text-gray-500">There are no subjects assigned to this curriculum yet.</p>
                </div>
            @endif
        </form>
    </div>
</x-layout>

{{--<x-layout>--}}

{{--    <form action="/class_batch/students/{{ $student->id }}/store"--}}
{{--          method="POST"--}}
{{--          class="min-h-screen max-w-6xl mx-auto p-6">--}}
{{--        @csrf--}}

{{--        <div class="flex gap-5 m-3 font-semibold text-xl mb-5">--}}
{{--            <div><span class="font-bold">Student No.:</span> <span class="uppercase">{{$student->student_number}}</span></div>--}}

{{--            <div class="flex gap-2">--}}
{{--                <div><span class="font-bold">Name:</span> <span class="uppercase">{{$student->last_name}}</span>,</div>--}}
{{--                <div><span class="uppercase">{{$student->first_name}}</span></div>--}}
{{--            </div>--}}

{{--        </div>--}}


{{--        @if($subjectExist)--}}

{{--            <!-- Header -->--}}
{{--            <div class="grid grid-cols-3 bg-gray-100 rounded-lg p-4 mb-4 font-bold text-center">--}}
{{--                <div class="flex justify-center gap-4">--}}
{{--                    <div class="w-[8rem]">MIDTERM</div>--}}
{{--                    <div class="w-[8rem]">FINALS</div>--}}
{{--                </div>--}}
{{--                <div>COURSE CODE</div>--}}
{{--                <div>DESCRIPTIVE TITLE</div>--}}
{{--            </div>--}}

{{--            <div class="text-xl font-bold">FIRST YEAR</div>--}}
{{--            <div class="text-xl  mb-2">First Semester</div>--}}

{{--            <!-- Subject List -->--}}
{{--            <div class="space-y-3">--}}
{{--                @foreach($subjectsYear1Sem1 as $subject)--}}

{{--                    <div class="grid grid-cols-3 items-center bg-white rounded-xl shadow-sm p-4 hover:shadow-md transition">--}}
{{--                        @php--}}
{{--                            // Get the pivot data for this student--}}
{{--                            $studentSubject = $subject->students->first();--}}
{{--                            $midterm = $studentSubject->pivot->midterm ?? '';--}}
{{--                            $final = $studentSubject->pivot->final ?? '';--}}
{{--                        @endphp--}}
{{--                        <!-- Grades -->--}}
{{--                        <div class="flex justify-center gap-4">--}}
{{--                            <input type="text"--}}
{{--                                   name="midterm[{{ $subject->id }}]"--}}
{{--                                   class="input w-[8rem] bg-violet-100 text-center"--}}
{{--                                   placeholder="Midterm" value="{{ $midterm }}"/>--}}

{{--                            <input type="text"--}}
{{--                                   name="final[{{ $subject->id }}]"--}}
{{--                                   class="input w-[8rem] bg-violet-100 text-center"--}}
{{--                                   placeholder="Final" value="{{ $final }}"/>--}}
{{--                        </div>--}}

{{--                        <!-- Course Code -->--}}
{{--                        <div class="text-center font-bold uppercase">--}}
{{--                            {{ $subject->course_code }}--}}
{{--                        </div>--}}

{{--                        <!-- Descriptive Title -->--}}
{{--                        <div class="text-center max-w-md mx-auto break-words whitespace-normal uppercase font-bold">--}}
{{--                            {{ $subject->descriptive_title }}--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}

{{--            <div class="text-xl mb-2 mt-4">Second Semester</div>--}}
{{--            <!-- Subject List -->--}}
{{--            <div class="space-y-3m ">--}}
{{--                @foreach($subjectsYear1Sem2 as $subject)--}}

{{--                    <div class="grid grid-cols-3 items-center bg-white rounded-xl shadow-sm p-4 hover:shadow-md transition">--}}

{{--                        <!-- Grades -->--}}
{{--                        <div class="flex justify-center gap-4">--}}
{{--                            <input type="text"--}}
{{--                                   name="midterm[{{ $subject->id }}]"--}}
{{--                                   class="input w-[8rem] bg-violet-100 text-center"--}}
{{--                                   placeholder="Midterm" value="{{ $subject->pivot->midterm ?? '' }}"/>--}}

{{--                            <input type="text"--}}
{{--                                   name="final[{{ $subject->id }}]"--}}
{{--                                   class="input w-[8rem] bg-violet-100 text-center"--}}
{{--                                   placeholder="Final" value="{{ $subject->pivot->final ?? ''}}"/>--}}
{{--                        </div>--}}

{{--                        <!-- Course Code -->--}}
{{--                        <div class="text-center font-bold uppercase">--}}
{{--                            {{ $subject->course_code }}--}}
{{--                        </div>--}}

{{--                        <!-- Descriptive Title -->--}}
{{--                        <div class="text-center max-w-md mx-auto break-words whitespace-normal uppercase font-bold">--}}
{{--                            {{ $subject->descriptive_title }}--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}

{{--        ---------------------------------------------------------------------------------}}
{{--            <div class="text-xl font-bold">SECOND YEAR</div>--}}
{{--            <div class="text-xl  mb-2">First Semester</div>--}}

{{--            <!-- Subject List -->--}}
{{--            <div class="space-y-3">--}}
{{--                @foreach($subjectsYear2Sem1 as $subject)--}}

{{--                    <div class="grid grid-cols-3 items-center bg-white rounded-xl shadow-sm p-4 hover:shadow-md transition">--}}

{{--                        <!-- Grades -->--}}
{{--                        <div class="flex justify-center gap-4">--}}
{{--                            <input type="text"--}}
{{--                                   name="midterm[{{ $subject->id }}]"--}}
{{--                                   class="input w-[8rem] bg-violet-100 text-center"--}}
{{--                                   placeholder="Midterm" value="{{ $subject->pivot->midterm ?? '' }}"/>--}}

{{--                            <input type="text"--}}
{{--                                   name="final[{{ $subject->id }}]"--}}
{{--                                   class="input w-[8rem] bg-violet-100 text-center"--}}
{{--                                   placeholder="Final" value="{{ $subject->pivot->final ?? '' }}"/>--}}
{{--                        </div>--}}

{{--                        <!-- Course Code -->--}}
{{--                        <div class="text-center font-bold uppercase">--}}
{{--                            {{ $subject->course_code }}--}}
{{--                        </div>--}}

{{--                        <!-- Descriptive Title -->--}}
{{--                        <div class="text-center max-w-md mx-auto break-words whitespace-normal uppercase font-bold">--}}
{{--                            {{ $subject->descriptive_title }}--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}

{{--            --}}{{--        ---------------------------------------------------------------------------------}}
{{--            <div class="text-xl  mb-2">Second Semester</div>--}}

{{--            <!-- Subject List -->--}}
{{--            <div class="space-y-3">--}}
{{--                @foreach($subjectsYear2Sem2 as $subject)--}}

{{--                    <div class="grid grid-cols-3 items-center bg-white rounded-xl shadow-sm p-4 hover:shadow-md transition">--}}

{{--                        <!-- Grades -->--}}
{{--                        <div class="flex justify-center gap-4">--}}
{{--                            <input type="text"--}}
{{--                                   name="midterm[{{ $subject->id }}]"--}}
{{--                                   class="input w-[8rem] bg-violet-100 text-center"--}}
{{--                                   placeholder="Midterm" value="{{ $subject->pivot->midterm ?? '' }}"/>--}}

{{--                            <input type="text"--}}
{{--                                   name="final[{{ $subject->id }}]"--}}
{{--                                   class="input w-[8rem] bg-violet-100 text-center"--}}
{{--                                   placeholder="Final" value="{{ $subject->pivot->final ?? '' }}"/>--}}
{{--                        </div>--}}

{{--                        <!-- Course Code -->--}}
{{--                        <div class="text-center font-bold uppercase">--}}
{{--                            {{ $subject->course_code }}--}}
{{--                        </div>--}}

{{--                        <!-- Descriptive Title -->--}}
{{--                        <div class="text-center max-w-md mx-auto break-words whitespace-normal uppercase font-bold">--}}
{{--                            {{ $subject->descriptive_title }}--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}


{{--            --}}{{--        ---------------------------------------------------------------------------------}}
{{--            <div class="text-xl font-bold">THIRD YEAR</div>--}}
{{--            <div class="text-xl  mb-2">First Semester</div>--}}

{{--            <!-- Subject List -->--}}
{{--            <div class="space-y-3">--}}
{{--                @foreach($subjectsYear3Sem1 as $subject)--}}

{{--                    <div class="grid grid-cols-3 items-center bg-white rounded-xl shadow-sm p-4 hover:shadow-md transition">--}}

{{--                        <!-- Grades -->--}}
{{--                        <div class="flex justify-center gap-4">--}}
{{--                            <input type="text"--}}
{{--                                   name="midterm[{{ $subject->id }}]"--}}
{{--                                   class="input w-[8rem] bg-violet-100 text-center"--}}
{{--                                   placeholder="Midterm" value="{{ $subject->pivot->midterm ?? '' }}"/>--}}

{{--                            <input type="text"--}}
{{--                                   name="final[{{ $subject->id }}]"--}}
{{--                                   class="input w-[8rem] bg-violet-100 text-center"--}}
{{--                                   placeholder="Final" value="{{ $subject->pivot->final ?? '' }}"/>--}}
{{--                        </div>--}}

{{--                        <!-- Course Code -->--}}
{{--                        <div class="text-center font-bold uppercase">--}}
{{--                            {{ $subject->course_code }}--}}
{{--                        </div>--}}

{{--                        <!-- Descriptive Title -->--}}
{{--                        <div class="text-center max-w-md mx-auto break-words whitespace-normal uppercase font-bold">--}}
{{--                            {{ $subject->descriptive_title }}--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}


{{--            --}}{{--        ---------------------------------------------------------------------------------}}
{{--            <div class="text-xl  mb-2">Second Semester</div>--}}

{{--            <!-- Subject List -->--}}
{{--            <div class="space-y-3">--}}
{{--                @foreach($subjectsYear3Sem2 as $subject)--}}

{{--                    <div class="grid grid-cols-3 items-center bg-white rounded-xl shadow-sm p-4 hover:shadow-md transition">--}}

{{--                        <!-- Grades -->--}}
{{--                        <div class="flex justify-center gap-4">--}}
{{--                            <input type="text"--}}
{{--                                   name="midterm[{{ $subject->id }}]"--}}
{{--                                   class="input w-[8rem] bg-violet-100 text-center"--}}
{{--                                   placeholder="Midterm" value="{{ $subject->pivot->midterm ?? '' }}"/>--}}

{{--                            <input type="text"--}}
{{--                                   name="final[{{ $subject->id }}]"--}}
{{--                                   class="input w-[8rem] bg-violet-100 text-center"--}}
{{--                                   placeholder="Final" value="{{ $subject->pivot->final ?? '' }}"/>--}}
{{--                        </div>--}}

{{--                        <!-- Course Code -->--}}
{{--                        <div class="text-center font-bold uppercase">--}}
{{--                            {{ $subject->course_code }}--}}
{{--                        </div>--}}

{{--                        <!-- Descriptive Title -->--}}
{{--                        <div class="text-center max-w-md mx-auto break-words whitespace-normal uppercase font-bold">--}}
{{--                            {{ $subject->descriptive_title }}--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}


{{--            --}}{{--        ---------------------------------------------------------------------------------}}
{{--            <div class="text-xl font-bold">FOURTH YEAR</div>--}}
{{--            <div class="text-xl  mb-2">First Semester</div>--}}

{{--            <!-- Subject List -->--}}
{{--            <div class="space-y-3">--}}
{{--                @foreach($subjectsYear4Sem1 as $subject)--}}

{{--                    <div class="grid grid-cols-3 items-center bg-white rounded-xl shadow-sm p-4 hover:shadow-md transition">--}}

{{--                        <!-- Grades -->--}}
{{--                        <div class="flex justify-center gap-4">--}}
{{--                            <input type="text"--}}
{{--                                   name="midterm[{{ $subject->id }}]"--}}
{{--                                   class="input w-[8rem] bg-violet-100 text-center"--}}
{{--                                   placeholder="Midterm" value="{{ $subject->pivot->midterm ?? '' }}"/>--}}

{{--                            <input type="text"--}}
{{--                                   name="final[{{ $subject->id }}]"--}}
{{--                                   class="input w-[8rem] bg-violet-100 text-center"--}}
{{--                                   placeholder="Final" value="{{ $subject->pivot->final ?? '' }}"/>--}}
{{--                        </div>--}}

{{--                        <!-- Course Code -->--}}
{{--                        <div class="text-center font-bold uppercase">--}}
{{--                            {{ $subject->course_code }}--}}
{{--                        </div>--}}

{{--                        <!-- Descriptive Title -->--}}
{{--                        <div class="text-center max-w-md mx-auto break-words whitespace-normal uppercase font-bold">--}}
{{--                            {{ $subject->descriptive_title }}--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}


{{--            --}}{{--        ---------------------------------------------------------------------------------}}
{{--            <div class="text-xl  mb-2">Second Semester</div>--}}

{{--            <!-- Subject List -->--}}
{{--            <div class="space-y-3">--}}
{{--                @foreach($subjectsYear4Sem2 as $subject)--}}

{{--                    <div class="grid grid-cols-3 items-center bg-white rounded-xl shadow-sm p-4 hover:shadow-md transition">--}}

{{--                        <!-- Grades -->--}}
{{--                        <div class="flex justify-center gap-4">--}}
{{--                            <input type="text"--}}
{{--                                   name="midterm[{{ $subject->id }}]"--}}
{{--                                   class="input w-[8rem] bg-violet-100 text-center"--}}
{{--                                   placeholder="Midterm" value="{{ $subject->pivot->midterm ?? '' }}"/>--}}

{{--                            <input type="text"--}}
{{--                                   name="final[{{ $subject->id }}]"--}}
{{--                                   class="input w-[8rem] bg-violet-100 text-center"--}}
{{--                                   placeholder="Final" value="{{ $subject->pivot->final ?? '' }}"/>--}}
{{--                        </div>--}}

{{--                        <!-- Course Code -->--}}
{{--                        <div class="text-center font-bold uppercase">--}}
{{--                            {{ $subject->course_code }}--}}
{{--                        </div>--}}

{{--                        <!-- Descriptive Title -->--}}
{{--                        <div class="text-center max-w-md mx-auto break-words whitespace-normal uppercase font-bold">--}}
{{--                            {{ $subject->descriptive_title }}--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}




{{--            <!-- Submit Button -->--}}
{{--            <div class="flex items-center justify-center">--}}
{{--                <button type="submit" class="btn bg-violet-800 mt-4 w-[10rem]" onclick="this.disabled=true; this.form.submit();">Create</button>--}}
{{--            </div>--}}

{{--        @else--}}
{{--            <div> No subjects for this curriculum.</div>--}}
{{--        @endif--}}
{{--    </form>--}}


{{--    --}}{{--                ------------------------------------------------------------------------------------}}

{{--            <div class="text-center text-2xl font-bold p-5">Add Grades</div>--}}

{{--            <div class="flex justify-center items-center">--}}
{{--                <div class="grid grid-cols-4  max-w-[80rem]">--}}

{{--                    <div class="bg-white w-[19rem] h-auto py-5 rounded m-4">--}}
{{--                        <div class="text-center font-bold text-xl mb-4">1st Year 1st Semester</div>--}}
{{--                        @foreach($subjectsYear1Sem1 as $subject)--}}
{{--                                    <div class="grid place-items-center text-center">--}}
{{--                                        <label class="label font-bold max-w-[18rem] break-words whitespace-normal">{{$subject->descriptive_title}}</label>--}}
{{--                                        <div class="grid grid-cols-2 gap-4">--}}
{{--                                            <input type="text" name="midterm[{{$subject->id}}]" class="input bg-gray-200 w-[8rem]" placeholder="midterm" />--}}
{{--                                            <input type="text" name="final[{{$subject->id}}]" class="input bg-gray-200 w-[8rem]" placeholder="final" />--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}

{{--                    <div class="bg-white w-[19rem] h-auto py-5 rounded m-4">--}}
{{--                        <div class="text-center font-bold text-xl mb-4">1st Year 2nd Semester</div>--}}
{{--                        @foreach($subjectsYear1Sem2 as $subject)--}}
{{--                            <div class="grid place-items-center text-center">--}}
{{--                                <label class="label font-bold max-w-[18rem] whitespace-normal">{{$subject->descriptive_title}}</label>--}}
{{--                                <div class="grid grid-cols-2 gap-4">--}}
{{--                                    <input type="text" name="midterm[{{$subject->id}}]" class="input bg-gray-200 w-[8rem]" placeholder="midterm" />--}}
{{--                                    <input type="text" name="final[{{$subject->id}}]" class="input bg-gray-200 w-[8rem]" placeholder="final" />--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}

{{--                    <div class="bg-white w-[19rem] h-auto py-5 rounded m-4">--}}
{{--                        <div class="text-center font-bold text-xl mb-4">2rd Year 1st Semester</div>--}}
{{--                        @foreach($subjectsYear2Sem1 as $subject)--}}
{{--                            <div class="grid place-items-center text-center">--}}
{{--                                <label class="label font-bold max-w-[18rem] break-words whitespace-normal">--}}
{{--                                    {{ $subject->descriptive_title }}--}}
{{--                                </label>--}}

{{--                                <div class="grid grid-cols-2 gap-4">--}}
{{--                                    <input type="text" name="midterm[{{ $subject->id }}]" class="input bg-gray-200 w-[8rem]" placeholder="midterm" />--}}
{{--                                    <input type="text" name="final[{{ $subject->id }}]" class="input bg-gray-200 w-[8rem]" placeholder="final" />--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}

{{--                    </div>--}}


{{--                    <div class="bg-white w-[19rem] h-auto py-5 rounded m-4">--}}
{{--                        <div class="text-center font-bold text-xl mb-4">2nd Year 2nd Semester</div>--}}
{{--                        @foreach($subjectsYear2Sem2 as $subject)--}}
{{--                            <div class="grid place-items-center text-center">--}}
{{--                                <label class="label font-bold max-w-[18rem] break-words whitespace-normal">{{$subject->descriptive_title}}</label>--}}
{{--                                <div class="grid grid-cols-2 gap-4">--}}
{{--                                    <input type="text" name="midterm[{{$subject->id}}]" class="input bg-gray-200 w-[8rem]" placeholder="midterm" />--}}
{{--                                    <input type="text" name="final[{{$subject->id}}]" class="input bg-gray-200 w-[8rem]" placeholder="final" />--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}


{{--                    <div class="bg-white w-[19rem] h-auto py-5 rounded m-4">--}}
{{--                        <div class="text-center font-bold text-xl mb-4">3rd Year 1st Semester</div>--}}
{{--                        @foreach($subjectsYear3Sem1 as $subject)--}}
{{--                            <div class="grid place-items-center text-center">--}}
{{--                                <label class="label font-bold max-w-[18rem] break-words whitespace-normal">{{$subject->descriptive_title}}</label>--}}
{{--                                <div class="grid grid-cols-2 gap-4">--}}
{{--                                    <input type="text" name="midterm[{{$subject->id}}]" class="input bg-gray-200 w-[8rem]" placeholder="midterm" />--}}
{{--                                    <input type="text" name="final[{{$subject->id}}]" class="input bg-gray-200 w-[8rem]" placeholder="final" />--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}


{{--                    <div class="bg-white w-[19rem] h-auto py-5 rounded m-4">--}}
{{--                        <div class="text-center font-bold text-xl mb-4">3rd Year 2nd Semester</div>--}}
{{--                        @foreach($subjectsYear3Sem2 as $subject)--}}
{{--                            <div class="grid place-items-center text-center">--}}
{{--                                <label class="label font-bold max-w-[18rem] break-words whitespace-normal">{{$subject->descriptive_title}}</label>--}}
{{--                                <div class="grid grid-cols-2 gap-4">--}}
{{--                                    <input type="text" name="midterm[{{$subject->id}}]" class="input bg-gray-200 w-[8rem]" placeholder="midterm" />--}}
{{--                                    <input type="text" name="final[{{$subject->id}}]" class="input bg-gray-200 w-[8rem]" placeholder="final" />--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}


{{--                    <div class="bg-white w-[19rem] h-auto py-5 rounded m-4">--}}
{{--                        <div class="text-center font-bold text-xl mb-4">4th Year 1st Semester</div>--}}
{{--                        @foreach($subjectsYear4Sem1 as $subject)--}}
{{--                            <div class="grid place-items-center text-center">--}}
{{--                                <label class="label font-bold max-w-[18rem] break-words whitespace-normal">{{$subject->descriptive_title}}</label>--}}
{{--                                <div class="grid grid-cols-2 gap-4">--}}
{{--                                    <input type="text" name="midterm[{{$subject->id}}]" class="input bg-gray-200 w-[8rem]" placeholder="midterm" />--}}
{{--                                    <input type="text" name="final[{{$subject->id}}]" class="input bg-gray-200 w-[8rem]" placeholder="final" />--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}


{{--                    <div class="bg-white w-[19rem] h-auto py-5 rounded m-4">--}}
{{--                        <div class="text-center font-bold text-xl mb-4">4th Year 2nd Semester</div>--}}
{{--                        @foreach($subjectsYear4Sem2 as $subject)--}}
{{--                            <div class="grid place-items-center text-center">--}}
{{--                                <label class="label font-bold max-w-[18rem] break-words whitespace-normal">{{$subject->descriptive_title}}</label>--}}
{{--                                <div class="grid grid-cols-2 gap-4">--}}
{{--                                    <input type="text" name="midterm[{{$subject->id}}]" class="input bg-gray-200 w-[8rem]" placeholder="midterm" />--}}
{{--                                    <input type="text" name="final[{{$subject->id}}]" class="input bg-gray-200 w-[8rem]" placeholder="final" />--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}



{{--                    <div class="flex items-center justify-center">--}}
{{--                        <button type="submit" class="btn bg-violet-800 mt-4 w-[10rem]" onclick="this.disabled=true; this.form.submit();">Create</button>--}}
{{--                    </div>--}}

{{--                @else--}}
{{--                <div> No subjects for this curriculum.</div>--}}
{{--                @endif--}}

{{--        </form>--}}

{{--</x-layout>--}}
