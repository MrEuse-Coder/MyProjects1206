<x-sidebar>
    <div class="min-h-screen bg-gray-50 p-6">
        <div class="max-w-7xl mx-auto">

            <!-- Success Toast -->
            @if(session('success'))
                <div
                    x-data="{ show: true }"
                    x-init="setTimeout(() => show = false, 3000)"
                    x-show="show"
                    x-transition
                    class="fixed top-20 left-1/2 transform -translate-x-1/2 z-50">
                    <div class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-xl font-semibold flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <!-- Header Section -->
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Students Directory</h1>
                <p class="text-gray-600">Search and manage student profiles</p>
            </div>

            <!-- Search Bar -->
            <div class="mb-6">
                <form action="/dashboard/students-profile" method="GET" class="relative">
                    <div class="relative max-w-md">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input
                            type="text"
                            name="student_search"
                            value="{{ request('student_search') }}"
                            class="w-full pl-10 pr-4 py-3 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition"
                            placeholder="Search by name, student ID, or batch..."
                        />
                        @if(request('student_search'))
                            <a
                                href="/dashboard/students-profile"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            @if($students->isEmpty())
                <!-- Empty State -->
                <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                    <svg class="mx-auto h-20 w-20 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">No Students Found</h3>
                    <p class="text-gray-500 mb-6">
                        @if(request('student_search'))
                            No students match your search "{{ request('student_search') }}"
                        @else
                            No students available in the system
                        @endif
                    </p>
                    @if(request('student_search'))
                        <a
                            href="/dashboard/students-profile"
                            class="inline-flex items-center gap-2 bg-violet-600 hover:bg-violet-700 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Clear Search
                        </a>
                    @endif
                </div>
            @else
                <!-- Students Table -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">

                    <!-- Table Header -->
                    <div class="bg-gradient-to-r from-violet-600 to-violet-700 px-6 py-4">
                        <div class="grid grid-cols-5 gap-4 text-white font-semibold text-sm">
                            <div class="text-center">STUDENT ID</div>
                            <div class="text-center">LAST NAME</div>
                            <div class="text-center">FIRST NAME</div>
                            <div class="text-center">BATCH</div>
                            <div class="text-center">ACTIONS</div>
                        </div>
                    </div>

                    <!-- Table Body -->
                    <div class="divide-y divide-gray-200">
                        @foreach($students as $student)
                            <div class="px-6 py-4 hover:bg-gray-50 transition">
                                <div class="grid grid-cols-5 gap-4 items-center">

                                    <!-- Student ID -->
                                    <div class="text-center font-semibold text-gray-900 uppercase">
                                        {{ $student->student_number }}
                                    </div>

                                    <!-- Last Name -->
                                    <div class="text-center text-gray-800 uppercase">
                                        {{ $student->last_name }}
                                    </div>

                                    <!-- First Name -->
                                    <div class="text-center text-gray-800 uppercase">
                                        {{ $student->first_name }}
                                    </div>

                                    <!-- Batch Name -->
                                    <div class="text-center">
                                        <span class=" inline-flex items-center px-3 py-1 bg-violet-100 text-violet-800 rounded-full text-xs font-semibold">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"></path>
                                            </svg>
                                            {{ $student->class_batch->batch_name }}
                                        </span>
                                    </div>

                                    <!-- Actions -->
                                    <div class="flex items-center justify-center gap-2">
                                        <!-- View Profile -->
                                        <a
                                            href="/dashboard/student/profile/{{ $student->id }}"
                                            class="inline-flex items-center gap-1 px-4 py-2 bg-violet-100 text-violet-700 hover:bg-violet-200 rounded-lg font-medium transition text-sm"
                                            title="View profile"
                                        >
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                            Profile
                                        </a>

                                        <!-- View Grades -->
                                        <a
                                            href="/evaluation/{{$student->id}}"
                                            class="inline-flex items-center gap-1 px-4 py-2 bg-blue-100 text-blue-700 hover:bg-blue-200 rounded-lg font-medium transition text-sm"
                                            title="View grades"
                                        >
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            Grades
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Results Count -->
                <div class="mt-4 text-sm text-gray-600">
                    Showing {{ $students->firstItem() }} to {{ $students->lastItem() }} of {{ $students->total() }} students
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $students->links() }}
                </div>
            @endif

        </div>
    </div>
</x-sidebar>

















{{--<x-sidebar>--}}
{{--    <div class="m-2 w-[10rem]">--}}
{{--        <form action="/dashboard/students-profile" method="get">--}}
{{--            <input type="text" name="student_search" class="input bg-violet-300 p-4 text-lg" placeholder="Search..." {{request('student_search')}} value="{{request('student_search')}}" />--}}
{{--            <button type="submit" class="hidden"></button>--}}
{{--        </form>--}}
{{--    </div>--}}

{{--    <div class="grid grid-cols-5 p-2 m-4 place-items-center rounded text-white bg-violet-800">--}}
{{--        <div class="font-bold text-md">STUDENT ID</div>--}}
{{--        <div class="font-bold text-md">LAST NAME</div>--}}
{{--        <div class="font-bold text-md">FIRST NAME</div>--}}
{{--        <div class="font-bold text-md">BATCH NAME</div>--}}
{{--        <div class="font-bold text-md">ACTION</div>--}}
{{--    </div>--}}


{{--    @foreach($students as $student)--}}
{{--        <div class="block bg-violet-400 rounded m-4 p-2 text-black">--}}
{{--            <div class="grid grid-cols-5 place-items-center ">--}}

{{--                <div class="col-span-4 grid grid-cols-4 w-full place-items-center  font-bold">--}}
{{--                    <div class=" text-md uppercase">--}}
{{--                        {{ $student->student_number }}--}}
{{--                    </div>--}}

{{--                    <div class=" text-md uppercase">--}}
{{--                        {{ $student->last_name }}--}}
{{--                    </div>--}}

{{--                    <div class=" text-md uppercase">--}}
{{--                        {{ $student->first_name }}--}}
{{--                    </div>--}}

{{--                    <div class=" text-md uppercase">--}}
{{--                        {{ $student->class_batch->batch_name }}--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div>--}}
{{--                    <a href="/dashboard/student/profile/{{$student->id}}" class="text-blue-700 bg-blue-200 px-2 py-1 rounded text-center hover:bg-blue-300">--}}
{{--                        Profile--}}
{{--                    </a>--}}
{{--                </div>--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    @endforeach--}}


{{--    {{$students->links()}}--}}
{{--</x-sidebar>--}}
