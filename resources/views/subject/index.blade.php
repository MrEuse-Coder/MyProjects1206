<x-sidebar>
    <div class="min-h-screen bg-gray-50 p-6">
        <div class="max-w-7xl mx-auto">

            <!-- Header Section -->
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Subjects Management</h1>
                <p class="text-gray-600">Manage curriculum subjects and courses</p>
            </div>

            <!-- Search and Add Section -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">

                <!-- Search Bar -->
                <form method="GET" action="/subjects" class="relative flex-1 max-w-md">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input
                            type="text"
                            name="search_subject"
                            value="{{ request('search_subject') }}"
                            class="w-full pl-10 pr-4 py-3 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition"
                            placeholder="Search by title..."
                        />
                        @if(request('search_subject'))
                            <a
                                href="/subjects"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </a>
                        @endif
                    </div>
                </form>

                <!-- Add Subject Button -->
                <a href="/subject/create"
                   class="flex items-center gap-2 bg-violet-600 hover:bg-violet-700 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition transform hover:scale-105">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add Subject
                </a>
            </div>

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

            @if($subjects->isEmpty())
                <!-- Empty State -->
                <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                    <svg class="mx-auto h-20 w-20 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">No Subjects Found</h3>
                    <p class="text-gray-500 mb-6">
                        @if(request('search_subject'))
                            No subjects match your search "{{ request('search_subject') }}"
                        @else
                            Start by adding subjects to the curriculum
                        @endif
                    </p>
                    @if(request('search_subject'))
                        <a
                            href="/subjects"
                            class="inline-flex items-center gap-2 bg-violet-600 hover:bg-violet-700 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Clear Search
                        </a>
                    @else
                        <a
                            href="/subject/create"
                            class="inline-flex items-center gap-2 bg-violet-600 hover:bg-violet-700 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Add First Subject
                        </a>
                    @endif
                </div>
            @else
                <!-- Subjects Table -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">

                    <!-- Table Header -->
                    <div class="bg-gradient-to-r from-violet-600 to-violet-700 px-6 py-4 overflow-x-auto">
                        <div class="grid grid-cols-7 gap-3 text-white font-semibold text-xs min-w-max">
                            <div>COURSE CODE</div>
                            <div class="">DESCRIPTIVE TITLE</div>
                            <div>PRE-REQUISITE</div>
                            <div>YEAR</div>
                            <div>SEMESTER</div>
                            <div>CURRICULUM</div>
                            <div class="text-center">ACTIONS</div>
                        </div>
                    </div>

                    <!-- Table Body -->
                    <div class="divide-y divide-gray-200 overflow-x-auto">
                        @foreach($subjects as $subject)
                            <div class="px-6 py-4 hover:bg-gray-50 transition">
                                <div class="grid grid-cols-7 gap-3 items-center min-w-max text-sm">

                                    <!-- Course Code -->
                                    <div class="font-bold text-violet-700 uppercase">
                                        {{ $subject->course_code }}
                                    </div>

                                    <!-- Descriptive Title -->
                                    <div class="text-gray-800 font-medium w-[8rem] break-all">
                                        {{ $subject->descriptive_title }}
                                    </div>

                                    <!-- Pre-requisite -->
                                    <div class="text-gray-600 text-xs">
                                        {{ $subject->pre_requisite ?? 'None' }}
                                    </div>

                                    <!-- Year Level -->
                                    <div>
                                        <span class="inline-flex items-center px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-semibold">
                                            {{ $subject->year_level }}{{ $subject->year_level == 1 ? 'st' : ($subject->year_level == 2 ? 'nd' : ($subject->year_level == 3 ? 'rd' : 'th')) }} Year
                                        </span>
                                    </div>

                                    <!-- Semester -->
                                    <div>
                                        <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">
                                            {{ $subject->semester }}{{ $subject->semester == 1 ? 'st' : 'nd' }} Sem
                                        </span>
                                    </div>

                                    <!-- Curriculum -->
                                    <div class="text-gray-700 font-medium text-xs">
                                        {{ $subject->curriculum }}
                                    </div>

                                    <!-- Actions -->
                                    <div class="flex justify-center gap-2">
                                        <!-- Edit Button -->
                                        <a
                                            href="/subject/{{ $subject->id }}/edit"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-100 text-blue-700 hover:bg-blue-200 rounded-md font-medium transition text-xs"
                                            title="Edit subject"
                                        >
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>

                                        </a>

                                        <!-- Delete Button (commented out but improved) -->
                                        <button
                                            onclick="confirmDelete({{ $subject->id }}, '{{ addslashes($subject->course_code) }}')"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 bg-red-100 text-red-700 hover:bg-red-200 rounded-md font-medium transition text-xs"
                                            title="Delete subject"
                                        >
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>

                                        </button>

                                        <!-- Hidden delete form -->
                                        <form id="delete-form-{{ $subject->id }}" action="/subject/{{ $subject->id }}" method="POST" class="hidden">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>



                <!-- Pagination -->
                <div class="mt-6">
                    {{ $subjects->links() }}
                </div>
            @endif

        </div>
    </div>

    <!-- Delete Confirmation Script -->
    <script>
        function confirmDelete(id, courseCode) {
            if (confirm(`Are you sure you want to delete ${courseCode}? This action cannot be undone.`)) {
                document.getElementById(`delete-form-${id}`).submit();
            }
        }
    </script>
</x-sidebar>






{{--<x-sidebar>--}}
{{--    <div class="flex justify-between m-2">--}}
{{--        <form method="GET" action="/subjects">--}}
{{--            <input type="text" name="search_subject" class="input bg-violet-300 w-[10rem]" placeholder="Search..." {{request('search_subject')}} value="{{request('search_subject')}}">--}}
{{--            <button type="submit" class="hidden"></button>--}}
{{--        </form>--}}



{{--        <div class="flex justify-center w-[6rem] h-[40px] bg-violet-800 items-center text-xl text-white p-6 font-bold rounded hover:shadow-xl">--}}
{{--            <a href="/subject/create" class="">--}}
{{--                +Subject--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="grid grid-cols-7 p-2 m-4 place-items-center text-white bg-violet-800 rounded">--}}
{{--        <div class="font-bold text-md">COURSE CODE</div>--}}
{{--        <div class="font-bold text-md">DESCRIPTIVE TITLE</div>--}}
{{--        <div class="font-bold text-md">PRE-REQUISITE</div>--}}
{{--        <div class="font-bold text-md">YEAR LEVEL</div>--}}
{{--        <div class="font-bold text-md">SEMESTER</div>--}}
{{--        <div class="font-bold text-md">CURRICULUM</div>--}}
{{--        <div class="font-bold text-md">ACTION</div>--}}
{{--    </div>--}}


{{--    @foreach($subjects as $subject)--}}
{{--        <div class="block bg-violet-400 rounded m-4 p-2 text-black">--}}
{{--            <div class="grid grid-cols-7 place-items-center ">--}}

{{--                <a href="#" class="col-span-6 grid grid-cols-6 w-full place-items-center  font-bold">--}}
{{--                    <div class=" text-sm uppercase">--}}
{{--                        {{ $subject->course_code }}--}}
{{--                    </div>--}}

{{--                    <div class=" text-sm uppercase">--}}
{{--                        {{ $subject->descriptive_title }}--}}
{{--                    </div>--}}

{{--                    <div class=" text-sm uppercase">--}}
{{--                        {{ $subject->pre_requisite }}--}}
{{--                    </div>--}}

{{--                    <div class=" text-sm uppercase">--}}
{{--                        {{ $subject->year_level }}--}}
{{--                    </div>--}}

{{--                    <div class=" text-sm uppercase">--}}
{{--                        {{ $subject->semester }}--}}
{{--                    </div>--}}
{{--                    <div class=" text-sm uppercase">--}}
{{--                        {{ $subject->curriculum }}--}}
{{--                    </div>--}}
{{--                </a>--}}


{{--                <div class="grid grid-cols-1 gap-2">--}}

{{--                    <!-- add grade -->--}}
{{--                    <a--}}
{{--                        href="/subject/{{$subject->id}}/edit"--}}
{{--                        class="text-blue-700 bg-blue-200 px-4 py-1  rounded text-center hover:bg-blue-300"--}}
{{--                    >--}}
{{--                        Edit--}}
{{--                    </a>--}}

{{--                    <!-- Delete -->--}}
{{--                    <form--}}
{{--                        action="/subject/{{$subject->id}}"--}}
{{--                        method="POST"--}}
{{--                        onsubmit="return confirm('Are you sure you want to delete this subject?');"--}}
{{--                    >--}}
{{--                        @csrf--}}
{{--                        @method('DELETE')--}}

{{--                        <button--}}
{{--                            type="submit"--}}
{{--                            class="text-red-700 bg-red-200 px-2 py-1 rounded hover:bg-red-300"--}}
{{--                        >--}}
{{--                            Delete--}}
{{--                        </button>--}}
{{--                    </form>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @endforeach--}}

{{--    {{$subjects->links()}}--}}
{{--</x-sidebar>--}}
