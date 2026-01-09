<x-layout>
    <div
        class="min-h-screen bg-gray-50"
        x-data="{
            deleteOpen: false,
            moveOpen: false,
            studentId: null,
            studentName: '',
            targetBatchId: ''
        }"
    >
        <!-- Header -->
        <div class="bg-white shadow-sm border-b sticky top-0 z-20">
            <div class="max-w-7xl mx-auto px-6 py-4">
                <div class="flex items-center gap-6">
                    <!-- Back Button -->
                    <a href="/class_batch" class="flex items-center justify-center w-10 h-10 bg-violet-600 hover:bg-violet-700 text-white rounded-lg transition shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </a>

                    <!-- Title -->
                    <div class="flex-1">
                        <h1 class="text-2xl font-bold text-gray-800">{{ $class_batch->batch_name }}</h1>
                        <p class="text-sm text-gray-500">Student Management</p>
                    </div>

                    <!-- Add Student Button -->
                    <a href="/class_batch/students/{{ $class_batch->id }}/create"
                       class="flex items-center gap-2 bg-violet-600 hover:bg-violet-700 text-white font-semibold px-4 py-2 rounded-lg shadow-md transition transform hover:scale-105">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Student
                    </a>
                </div>
            </div>
        </div>

        <!-- Success Toast -->
        @if(session('success'))
            <div
                x-data="{ show: true }"
                x-init="setTimeout(() => show = false, 3000)"
                x-show="show"
                x-transition
                class="fixed top-20 left-1/2 transform -translate-x-1/2 z-50"
            >
                <div class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-xl font-semibold flex items-center gap-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto px-6 py-6">

            <!-- Search Bar -->
            <div class="mb-6">
                <form method="GET" class="relative">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input
                            type="text"
                            name="search_student"
                            class="w-full md:w-96 pl-10 pr-4 py-3 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition"
                            placeholder="Search by name or student ID..."
                            value="{{ request('search_student') }}"
                        >
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
                        @if(request('search_student'))
                            No students match your search "{{ request('search_student') }}"
                        @else
                            Start by adding students to this batch
                        @endif
                    </p>
                    <a href="/class_batch/students/{{ $class_batch->id }}/create"
                       class="inline-flex items-center gap-2 bg-violet-600 hover:bg-violet-700 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Add First Student
                    </a>
                </div>
            @else

                <!-- Students Table -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <!-- Table Header -->
                    <div class="bg-gradient-to-r from-violet-600 to-violet-700 px-6 py-4">
                        <div class="grid grid-cols-6 gap-4 text-white font-semibold text-sm">
                            <div>STUDENT ID</div>
                            <div>LAST NAME</div>
                            <div>FIRST NAME</div>
                            <div>MIDDLE NAME</div>
                            <div>GENDER</div>
                            <div class="text-center">ACTIONS</div>
                        </div>
                    </div>

                    <!-- Table Body -->
                    <div class="divide-y divide-gray-200">
                        @foreach($students as $student)
                            <div class="px-6 py-4 hover:bg-gray-50 transition">
                                <div class="grid grid-cols-6 gap-4 items-center">

                                    <!-- Student ID -->
                                   <a href="/evaluation/{{$student->id}}" class="block cursor-pointer">
                                       <div class="font-semibold text-gray-900 uppercase">
                                           {{ $student->student_number }}
                                       </div>
                                   </a>

                                    <!-- Last Name -->
                                    <a href="/evaluation/{{$student->id}}" class="block cursor-pointer">
                                    <div class="text-gray-800 uppercase">
                                        {{ $student->last_name }}
                                    </div>
                                    </a>

                                    <!-- First Name -->
                                    <a href="/evaluation/{{$student->id}}" class="block cursor-pointer">
                                    <div class="text-gray-800 uppercase">
                                        {{ $student->first_name }}
                                    </div>
                                    </a>

                                    <!-- Middle Name -->
                                    <a href="/evaluation/{{$student->id}}" class="block cursor-pointer">
                                    <div class="text-gray-600 uppercase">
                                        {{ $student->middle_name ?? 'N/A' }}
                                    </div>
                                    </a>

                                    <!-- Gender -->
                                    <div class="text-gray-700">
                                        @if($student->gender == 'Male')
                                            <span class="inline-flex items-center gap-1 px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-semibold">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                                </svg>
                                                Male
                                            </span>
                                        @elseif($student->gender == '')
                                            <div></div>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-2 py-1 bg-pink-100 text-pink-800 rounded-full text-xs font-semibold">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                                </svg>
                                                Female
                                            </span>
                                        @endif

                                    </div>

                                    <!-- Actions -->
                                    <div class="flex items-center justify-center gap-2">
                                        <!-- View Grades -->
                                        <a
                                            href="/class_batch/students/{{ $student->id }}/add"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-100 text-blue-700 hover:bg-blue-200 rounded-md font-medium transition text-sm"
                                            title="Manage grades"
                                        >
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                        </a>

                                        <!-- Move to Different Batch -->
                                        <button
                                            type="button"
                                            @click="
                                                moveOpen = true;
                                                studentId = {{ $student->id }};
                                                studentName = '{{ addslashes($student->first_name) }} {{ addslashes($student->last_name) }}';
                                                targetBatchId = '';
                                            "
                                            class="inline-flex items-center gap-1 px-3 py-1.5 bg-green-100 text-green-700 hover:bg-green-200 rounded-md font-medium transition text-sm"
                                            title="Move student"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 3.75H6.912a2.25 2.25 0 0 0-2.15 1.588L2.35 13.177a2.25 2.25 0 0 0-.1.661V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 0 0-2.15-1.588H15M2.25 13.5h3.86a2.25 2.25 0 0 1 2.012 1.244l.256.512a2.25 2.25 0 0 0 2.013 1.244h3.218a2.25 2.25 0 0 0 2.013-1.244l.256-.512a2.25 2.25 0 0 1 2.013-1.244h3.859M12 3v8.25m0 0-3-3m3 3 3-3" />
                                            </svg>
                                        </button>

                                        <!-- Delete -->
                                        <button
                                            type="button"
                                            @click="
                                                deleteOpen = true;
                                                studentId = {{ $student->id }};
                                                studentName = '{{ addslashes($student->first_name) }} {{ addslashes($student->last_name) }}';
                                            "
                                            class="inline-flex items-center gap-1 px-3 py-1.5 bg-red-100 text-red-700 hover:bg-red-200 rounded-md font-medium transition text-sm"
                                            title="Delete student"
                                        >
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    </div>
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $students->links() }}
                </div>
            @endif

        </main>

        <!-- DELETE MODAL -->
        <div
            x-show="deleteOpen"
            x-transition.opacity
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
            style="display: none;"
        >
            <div
                @click.outside="deleteOpen = false"
                x-transition
                class="bg-white rounded-xl p-6 w-full max-w-md shadow-2xl"
            >
                <!-- Modal Header -->
                <div class="flex items-start gap-4 mb-4">
                    <div class="flex-shrink-0 w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h2 class="text-xl font-bold text-gray-900 mb-1">
                            Delete Student
                        </h2>
                        <p class="text-sm text-gray-600">
                            This action cannot be undone.
                        </p>
                    </div>
                </div>

                <!-- Modal Body -->
                <div class="bg-gray-50 rounded-lg p-4 mb-6">
                    <p class="text-gray-700">
                        Are you sure you want to delete
                        <span class="font-bold text-gray-900 uppercase" x-text="studentName"></span>?
                        All associated grades and records will be permanently removed.
                    </p>
                </div>

                <!-- Modal Actions -->
                <form
                    :action="`/class_batch/students/${studentId}`"
                    method="POST"
                >
                    @csrf
                    @method('DELETE')

                    <div class="flex gap-3 justify-end">
                        <button
                            type="button"
                            @click="deleteOpen = false"
                            class="px-4 py-2 rounded-lg bg-white border-2 border-gray-300 text-gray-700 font-semibold hover:bg-gray-50 transition"
                        >
                            Cancel
                        </button>

                        <button
                            type="submit"
                            class="px-4 py-2 rounded-lg bg-red-600 text-white font-semibold hover:bg-red-700 transition flex items-center gap-2"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Delete Student
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- MOVE STUDENT MODAL -->
        <div
            x-show="moveOpen"
            x-transition.opacity
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
            style="display: none;"
        >
            <div
                @click.outside="moveOpen = false"
                x-transition
                class="bg-white rounded-xl p-6 w-full max-w-md shadow-2xl"
            >
                <!-- Modal Header -->
                <div class="flex items-start gap-4 mb-4">
                    <div class="flex-shrink-0 w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-green-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 3.75H6.912a2.25 2.25 0 0 0-2.15 1.588L2.35 13.177a2.25 2.25 0 0 0-.1.661V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 0 0-2.15-1.588H15M2.25 13.5h3.86a2.25 2.25 0 0 1 2.012 1.244l.256.512a2.25 2.25 0 0 0 2.013 1.244h3.218a2.25 2.25 0 0 0 2.013-1.244l.256-.512a2.25 2.25 0 0 1 2.013-1.244h3.859M12 3v8.25m0 0-3-3m3 3 3-3" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h2 class="text-xl font-bold text-gray-900 mb-1">
                            Move Student
                        </h2>
                        <p class="text-sm text-gray-600">
                            Transfer student to a different class batch
                        </p>
                    </div>
                </div>

                <!-- Modal Body -->
                <div class="mb-6">
                    <div class="bg-blue-50 rounded-lg p-4 mb-4">
                        <p class="text-sm text-blue-800">
                            Moving <span class="font-bold uppercase" x-text="studentName"></span>
                        </p>
                    </div>

                    <form
                        :action="`/class_batch/students/${studentId}/move`"
                        method="POST"
                        id="moveStudentForm"
                    >
                        @csrf
                        @method('PATCH')

                        <div>
                            <label for="target_batch" class="block text-sm font-semibold text-gray-700 mb-2">
                                Select Target Class Batch
                            </label>
                            <select
                                id="target_batch"
                                name="target_batch_id"
                                x-model="targetBatchId"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition"
                            >
                                <option value="">-- Choose a class batch --</option>
                                {{-- Replace with your actual class batches loop --}}
                                @foreach($class_batches  as $batch)

                                        <option value="{{$batch->id}}">{{ $batch->batch_name }}</option>

                                @endforeach
                            </select>
                            <p class="mt-2 text-xs text-gray-500">
                                The student's grades and records will be transferred to the selected batch.
                            </p>
                        </div>
                    </form>
                </div>

                <!-- Modal Actions -->
                <div class="flex gap-3 justify-end">
                    <button
                        type="button"
                        @click="moveOpen = false"
                        class="px-4 py-2 rounded-lg bg-white border-2 border-gray-300 text-gray-700 font-semibold hover:bg-gray-50 transition"
                    >
                        Cancel
                    </button>

                    <button
                        type="submit"
                        form="moveStudentForm"
                        :disabled="!targetBatchId"
                        :class="!targetBatchId ? 'opacity-50 cursor-not-allowed' : 'hover:bg-green-700'"
                        class="px-4 py-2 rounded-lg bg-green-600 text-white font-semibold transition flex items-center gap-2"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        Move Student
                    </button>
                </div>
            </div>
        </div>

    </div>
</x-layout>


















{{--<x-layout>--}}
{{--    <div--}}
{{--        class="min-h-screen"--}}
{{--        x-data="{--}}
{{--            open: false,--}}
{{--            studentId: null,--}}
{{--            studentName: ''--}}
{{--        }"--}}
{{--    >--}}
{{--        <!-- Header -->--}}
{{--        <div class="grid grid-cols-3 items-center m-4">--}}
{{--            <div class="bg-violet-800 w-20 text-center rounded">--}}
{{--                <a href="/class_batch" class="block font-bold text-2xl text-white py-2">&lt;</a>--}}
{{--            </div>--}}

{{--            <div class="text-gray-700 text-center text-3xl font-bold">--}}
{{--                {{ $class_batch->batch_name }} STUDENTS--}}
{{--            </div>--}}

{{--            <div></div>--}}
{{--        </div>--}}

{{--        <!-- Success Toast -->--}}
{{--        @if(session('success'))--}}
{{--            <div--}}
{{--                x-data="{ show: true }"--}}
{{--                x-init="setTimeout(() => show = false, 3000)"--}}
{{--                x-show="show"--}}
{{--                x-transition--}}
{{--                class="fixed top-20 left-1/2 transform -translate-x-1/2 z-50"--}}
{{--            >--}}
{{--                <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-2 rounded font-bold shadow">--}}
{{--                    {{ session('success') }}--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endif--}}

{{--        <!-- Search & Add -->--}}
{{--        <div class="flex justify-between items-center m-4 gap-4">--}}
{{--            <form method="GET" class="flex-shrink-0">--}}
{{--                <input--}}
{{--                    type="text"--}}
{{--                    name="search_student"--}}
{{--                    class="input bg-violet-300 px-4 py-2 rounded text-xl w-64 h-10"--}}
{{--                    placeholder="Search..."--}}
{{--                    value="{{ request('search_student') }}"--}}
{{--                >--}}
{{--            </form>--}}

{{--            <a href="/class_batch/students/{{ $class_batch->id }}/create">--}}
{{--                <div class="flex justify-center items-center w-32 h-10 bg-violet-800 text-white text-xl px-6 font-bold rounded hover:shadow-xl transition">--}}
{{--                    +Student--}}
{{--                </div>--}}
{{--            </a>--}}
{{--        </div>--}}

{{--        <!-- Table Header -->--}}
{{--        <div class="grid grid-cols-5 m-4 mb-2 place-items-center text-gray-700 bg-gray-100 p-4 rounded-xl font-bold">--}}
{{--            <div>STUDENT ID</div>--}}
{{--            <div>LAST NAME</div>--}}
{{--            <div>FIRST NAME</div>--}}
{{--            <div>MIDDLE NAME</div>--}}
{{--            <div>ACTION</div>--}}
{{--        </div>--}}

{{--        <!-- Students List -->--}}
{{--        @forelse($students as $student)--}}
{{--            <div class="bg-white rounded-xl m-2 mx-4 p-4 shadow-sm hover:shadow-md transition">--}}
{{--                <div class="grid grid-cols-5 place-items-center gap-4">--}}

{{--                    <!-- Student Info -->--}}
{{--                    <div class="col-span-4 grid grid-cols-4 w-full place-items-center text-black font-bold">--}}
{{--                        <div class="text-lg uppercase">{{ $student->student_number }}</div>--}}
{{--                        <div class="text-lg uppercase">{{ $student->last_name }}</div>--}}
{{--                        <div class="text-lg uppercase">{{ $student->first_name }}</div>--}}
{{--                        <div class="text-lg uppercase">{{ $student->middle_name ?? 'N/A' }}</div>--}}
{{--                    </div>--}}

{{--                    <!-- Actions -->--}}
{{--                    <div class="flex gap-2">--}}
{{--                        <!-- Add Grade -->--}}
{{--                        <a--}}
{{--                            href="/class_batch/students/{{ $student->id }}/add"--}}
{{--                            class="text-blue-700 bg-blue-200 px-3 py-1 rounded hover:bg-blue-300 text-center font-semibold transition"--}}
{{--                        >--}}
{{--                            +Grade--}}
{{--                        </a>--}}

{{--                        <!-- Delete -->--}}
{{--                        <button--}}
{{--                            type="button"--}}
{{--                            @click="--}}
{{--                                open = true;--}}
{{--                                studentId = {{ $student->id }};--}}
{{--                                studentName = '{{ addslashes($student->first_name) }} {{ addslashes($student->last_name) }}';--}}
{{--                            "--}}
{{--                            class="text-red-700 bg-red-200 px-3 py-1 rounded hover:bg-red-300 font-semibold transition"--}}
{{--                        >--}}
{{--                            Delete--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @empty--}}
{{--            <div class="text-center text-gray-500 text-xl py-8">--}}
{{--                No students found.--}}
{{--            </div>--}}
{{--        @endforelse--}}

{{--        <!-- Pagination -->--}}
{{--        <div class="m-4">--}}
{{--            {{ $students->links() }}--}}
{{--        </div>--}}

{{--        <!-- DELETE MODAL -->--}}
{{--        <div--}}
{{--            x-show="open"--}}
{{--            x-transition.opacity--}}
{{--            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"--}}
{{--            style="display: none;"--}}
{{--        >--}}
{{--            <div--}}
{{--                @click.outside="open = false"--}}
{{--                x-transition--}}
{{--                class="bg-white rounded-xl p-6 w-96 shadow-xl"--}}
{{--            >--}}
{{--                <h2 class="text-xl font-bold text-red-600 mb-3">--}}
{{--                    Delete Student--}}
{{--                </h2>--}}

{{--                <p class="text-gray-700 mb-5">--}}
{{--                    Are you sure you want to delete--}}
{{--                    <span class="font-bold uppercase" x-text="studentName"></span>?--}}
{{--                </p>--}}

{{--                <form--}}
{{--                    :action="`/class_batch/students/${studentId}`"--}}
{{--                    method="POST"--}}
{{--                >--}}
{{--                    @csrf--}}
{{--                    @method('DELETE')--}}

{{--                    <div class="flex justify-end gap-3">--}}
{{--                        <button--}}
{{--                            type="button"--}}
{{--                            @click="open = false"--}}
{{--                            class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300 transition font-semibold"--}}
{{--                        >--}}
{{--                            Cancel--}}
{{--                        </button>--}}

{{--                        <button--}}
{{--                            type="submit"--}}
{{--                            class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700 transition font-semibold"--}}
{{--                        >--}}
{{--                            Delete--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--    </div>--}}
{{--</x-layout>--}}
