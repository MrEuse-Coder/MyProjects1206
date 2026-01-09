<x-layout>
    <div class="min-h-screen bg-gradient-to-br from-violet-50 to-violet-100 flex items-center justify-center p-6">

        <!-- Success Toast -->
        @if(session('success'))
            <div
                x-data="{ show: true }"
                x-init="setTimeout(() => show = false, 3000)"
                x-show="show"
                x-transition
                class="fixed top-20 left-1/2 transform -translate-x-1/2 z-50">
                <div class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-xl font-semibold">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <div class="w-full max-w-3xl">
            <!-- Back Button -->
            <a href="/subject" class="inline-flex items-center gap-2 text-violet-700 hover:text-violet-900 font-semibold mb-6 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Subjects
            </a>

            <!-- Form Card -->
            <form action="/subject/{{$subject->id}}/update" method="POST" onsubmit="handleSubmit(event)" class="bg-white shadow-2xl rounded-2xl overflow-hidden">
                @csrf
                @method('PUT')

                <!-- Header -->
                <div class="bg-gradient-to-r from-violet-600 to-violet-800 px-8 py-6">
                    <h1 class="text-2xl font-bold text-white text-center">Add New Subject</h1>
                    <p class="text-violet-100 text-center text-sm mt-1">Create a new subject in the curriculum</p>
                </div>

                <!-- Form Body -->
                <div class="p-8 space-y-6">

                    <!-- Course Code and Descriptive Title -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <!-- Course Code -->
                        <div>
                            <label for="course_code" class="block text-sm font-semibold text-gray-700 mb-2">
                                Course Code <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                id="course_code"
                                name="course_code"
                                required
                                value="{{$subject->course_code}}"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition placeholder-gray-400 uppercase"
                                placeholder="e.g. IT 101"
                            />
                        </div>

                        <!-- Descriptive Title -->
                        <div>
                            <label for="descriptive_title" class="block text-sm font-semibold text-gray-700 mb-2">
                                Descriptive Title <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                id="descriptive_title"
                                name="descriptive_title"
                                required
                                value="{{$subject->descriptive_title}}"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition placeholder-gray-400"
                                placeholder="e.g. Introduction to Programming"
                            />
                        </div>
                    </div>

                    <!-- Units Section -->
                    <div>
                        <h3 class="text-sm font-bold text-gray-700 mb-3 flex items-center gap-2">
                            <svg class="w-5 h-5 text-violet-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
                            </svg>
                            Units Breakdown
                        </h3>
                        <div class="grid grid-cols-3 gap-4">

                            <!-- Total Units -->
                            <div>
                                <label for="total_units" class="block text-xs font-semibold text-gray-600 mb-2">
                                    Total Units <span class="text-red-500">*</span>
                                </label>
                                <input
                                    type="number"
                                    id="total_units"
                                    name="total_units"
                                    required
                                    min="0"
                                    step="0.5"
                                    value="{{$subject->total_units}}"                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition text-center font-semibold"
                                    placeholder="3"
                                />
                            </div>

                            <!-- Lecture Units -->
                            <div>
                                <label for="lec_units" class="block text-xs font-semibold text-gray-600 mb-2">
                                    Lecture Units <span class="text-red-500">*</span>
                                </label>
                                <input
                                    type="number"
                                    id="lec_units"
                                    name="lec_units"
                                    required
                                    min="0"
                                    step="0.5"
                                    value="{{$subject->lec_units}}"                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition text-center font-semibold"
                                    placeholder="2"
                                />
                            </div>

                            <!-- Lab Units -->
                            <div>
                                <label for="lab_units" class="block text-xs font-semibold text-gray-600 mb-2">
                                    Lab Units <span class="text-red-500">*</span>
                                </label>
                                <input
                                    type="number"
                                    id="lab_units"
                                    name="lab_units"
                                    required
                                    min="0"
                                    step="0.5"
                                    value="{{$subject->lab_units}}"                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition text-center font-semibold"
                                    placeholder="1"
                                />
                            </div>
                        </div>
                    </div>

                    <!-- Hours and Pre-requisite -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                        <!-- Hours per Week -->
                        <div>
                            <label for="hours_week" class="block text-sm font-semibold text-gray-700 mb-2">
                                Hours/Week <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="number"
                                id="hours_week"
                                name="hours_week"
                                required
                                min="0"
                                value="{{$subject->hours_week}}"                                class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition text-center font-semibold"
                                placeholder="3"
                            />
                        </div>

                        <!-- Pre-requisite -->
                        <div class="md:col-span-2">
                            <label for="pre_requisite" class="block text-sm font-semibold text-gray-700 mb-2">
                                Pre-requisite <span class="text-gray-400 text-xs">(Optional)</span>
                            </label>
                            <input
                                type="text"
                                id="pre_requisite"
                                name="pre_requisite"
                                value="{{$subject->pre_requisite}}"                                class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition placeholder-gray-400"
                                placeholder="e.g. IT 100 or None"
                            />
                        </div>
                    </div>

                    <!-- Curriculum Details -->
                    <div>
                        <h3 class="text-sm font-bold text-gray-700 mb-3 flex items-center gap-2">
                            <svg class="w-5 h-5 text-violet-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                            </svg>
                            Curriculum Placement
                        </h3>
                        <div class="grid grid-cols-3 gap-4">

                            <!-- Year Level -->
                            <div>
                                <label for="year_level" class="block text-xs font-semibold text-gray-600 mb-2">
                                    Year Level <span class="text-red-500">*</span>
                                </label>
                                <select
                                    id="year_level"
                                    name="year_level"
                                    required
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition appearance-none cursor-pointer text-center font-semibold">
                                    @if($subject->year_level == '1')
                                        <option value="1">1st Year</option>
                                            @elseif($subject->year_level == '2')
                                        <option value="2">2nd Year</option>
                                            @elseif($subject->year_level == '3')
                                        <option value="3">3rd Year</option>
                                            @elseif($subject->year_level == '4')
                                        <option value="4">4th Year</option>
                                                @endif

                                    <option value="1">1st Year</option>
                                    <option value="2">2nd Year</option>
                                    <option value="3">3rd Year</option>
                                    <option value="4">4th Year</option>
                                </select>
                            </div>

                            <!-- Semester -->
                            <div>
                                <label for="semester" class="block text-xs font-semibold text-gray-600 mb-2">
                                    Semester <span class="text-red-500">*</span>
                                </label>
                                <select
                                    id="semester"
                                    name="semester"
                                    required
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition appearance-none cursor-pointer text-center font-semibold">

                                        @if($subject->semester == '1')
                                        <option value="1">1st Sem</option>
                                        @else
                                        <option value="2">2nd Sem</option>
                                        @endif


                                    <option value="1">1st Sem</option>
                                    <option value="2">2nd Sem</option>
                                </select>
                            </div>

                            <!-- Curriculum -->
                            <div>
                                <label for="curriculum" class="block text-xs font-semibold text-gray-600 mb-2">
                                    Curriculum <span class="text-red-500">*</span>
                                </label>
                                <select
                                    id="curriculum"
                                    name="curriculum"
                                    required
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition appearance-none cursor-pointer text-center font-semibold">
                                    @for($year = 2022; $year <= date('Y'); $year++)
                                        <option value="{{ $year }}-{{ $year + 1 }}" {{ old('curriculum') == "$year-".($year+1) ? 'selected' : '' }}>
                                            {{ $year }}-{{ $year + 1 }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Info Box -->
                    <div class="bg-violet-50 border border-violet-200 rounded-lg p-4 flex gap-3">
                        <svg class="w-5 h-5 text-violet-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                        </svg>
                        <div class="text-sm text-violet-800">
                            <p class="font-semibold mb-1">Subject Information</p>
                            <p>Ensure all units and hours are accurately entered. The total units should equal the sum of lecture and lab units.</p>
                        </div>
                    </div>

                </div>

                <!-- Form Footer -->
                <div class="bg-gray-50 px-8 py-6 flex gap-3 justify-end border-t border-gray-200">
                    <a href="/subject" class="px-6 py-3 bg-white border-2 border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition">
                        Cancel
                    </a>
                    <button
                        type="submit"
                        id="submitBtn"
                        class="px-6 py-3 bg-violet-600 hover:bg-violet-700 text-white font-semibold rounded-lg shadow-lg transition transform hover:scale-105 active:scale-95">
                        Update Subject
                    </button>
                </div>

            </form>
        </div>
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
                    Creating...
                </span>
            `;
            btn.classList.add('opacity-50', 'cursor-not-allowed');
        }
    </script>
</x-layout>












{{--<x-layout>--}}
{{--    <div class="h-screen grid grid-cols-1 place-items-center justify-center">--}}
{{--        <form action="/subject/{{$subject->id}}/update" method="POST" class=" bg-white shadow-2xl rounded-box w-lg  p-4 text-black ">--}}
{{--            @csrf--}}
{{--            @method('put')--}}

{{--            <div class="grid grid-cols-1 place-items-center gap-2 ">--}}
{{--                <div class="text-center text-2xl font-bold p-5">Edit Subject</div>--}}

{{--                <div class="grid grid-cols-2 gap-2 place-items-center">--}}
{{--                    <div>--}}
{{--                        <label class="label">Course Code</label><br>--}}
{{--                        <input type="text" name="course_code" class="input bg-gray-200 w-[10.5rem]" value="{{$subject->course_code}}" /><br>--}}
{{--                    </div>--}}

{{--                    <div>--}}
{{--                        <label class="label">Descriptive Title</label><br>--}}
{{--                        <input type="text" name="descriptive_title" class="input bg-gray-200 w-[10.5rem]" value="{{$subject->descriptive_title}}" /><br>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="grid grid-cols-3 gap-2">--}}
{{--                    <div>--}}
{{--                        <label class="label">Total Units</label><br>--}}
{{--                        <input type="number" name="total_units" class="input bg-gray-200 w-[7rem]" value="{{$subject->total_units}}"  />--}}
{{--                    </div>--}}

{{--                    <div>--}}
{{--                        <label class="label">Lecture Units</label><br>--}}
{{--                        <input type="number" name="lec_units" class="input bg-gray-200 w-[7rem]" value="{{$subject->lec_units}}"  />--}}
{{--                    </div>--}}

{{--                    <div>--}}
{{--                        <label class="label">Lab Units</label><br>--}}
{{--                        <input type="number" name="lab_units" class="input bg-gray-200 w-[7rem]" value="{{$subject->lab_units}}"  />--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="grid grid-cols-3 gap-2">--}}
{{--                    <div>--}}
{{--                        <label class="label">Hours/Week</label><br>--}}
{{--                        <input type="number" name="hours_week" class="input bg-gray-200 w-[7rem]" value="{{$subject->hours_week}}"  />--}}
{{--                    </div>--}}

{{--                    <div class="col-span-2">--}}
{{--                        <label class="label">Pre-requisite</label><br>--}}
{{--                        <input type="text" name="pre_requisite" class="input bg-gray-200 w-[14rem]" value="{{$subject->pre_requisite}}"  />--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="grid grid-cols-3 gap-1">--}}
{{--                    <div>--}}
{{--                        <label class="label">Year Level</label><br>--}}
{{--                        <select type="text" name="year_level" class="select bg-gray-200 w-[6rem]">--}}
{{--                            <option value="1">1</option>--}}
{{--                            <option value="2">2</option>--}}
{{--                            <option value="3">3</option>--}}
{{--                            <option value="4">4</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}

{{--                    <div>--}}
{{--                        <label class="label">Semester</label><br>--}}
{{--                        <select type="text" name="semester" class="select bg-gray-200 w-[6rem]">--}}
{{--                            <option value="1">1</option>--}}
{{--                            <option value="2">2</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}

{{--                    <div>--}}
{{--                        <label class="label">Curriculum</label><br>--}}
{{--                        <select type="text" name="curriculum" class="select bg-gray-200 w-[7rem]">--}}
{{--                            @for($year = 2022; $year <= date('Y'); $year++)--}}
{{--                                <option value="{{ $year }}-{{$year+1}}">{{ $year }}-{{$year+1}}</option>--}}
{{--                            @endfor--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="flex items-center justify-center">--}}
{{--                    <button type="submit" class="btn bg-violet-800 mt-4 w-[10rem]" onclick="this.disabled=true; this.form.submit();">Update</button>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--        </form>--}}
{{--    </div>--}}
{{--</x-layout>--}}
