<x-layout>
    <div class="min-h-screen bg-gray-50">
        <div
            class="min-h-screen bg-gray-50"
            x-data="{
            deleteOpen: false,
            moveOpen: false,
            batchId: null,
            batchName: '',

        }"
        >

        <!-- Header Section -->
        <div class="bg-white shadow-sm border-b sticky top-0 z-20">
            <div class="max-w-7xl mx-auto px-6 py-4">
                <div class="flex justify-between items-center">

                    <!-- Filter Dropdown -->
                    <div>
                        <form method="GET" action="/class_batch">
                            <select
                                onchange="this.form.submit()"
                                name="school_year"
                                class="select bg-violet-600 hover:bg-violet-700 text-white font-semibold rounded-lg px-4 py-2 shadow-md transition-colors cursor-pointer focus:outline-none focus:ring-2 focus:ring-violet-500">
                                <option value="">ALL BATCHES</option>
                                @foreach($classSchoolYears as $classSchoolYear)
                                    <option value="{{ $classSchoolYear }}" {{ request('school_year') == $classSchoolYear ? 'selected' : '' }}>
                                        {{ $classSchoolYear }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>

                    <!-- Add Batch Button -->
                    <a href="/class_batch/create"
                       class="flex items-center gap-2 bg-violet-800 hover:bg-violet-900 text-white font-bold px-6 py-2 rounded-lg shadow-lg transition-all transform hover:scale-105 active:scale-95">
                       Create Batch
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
                class="fixed top-20 left-1/2 transform -translate-x-1/2 z-50">
                <div class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-xl font-semibold">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto px-6 py-8">

            @if($classBatches->isEmpty())
                <!-- Empty State -->
                <div class="flex flex-col items-center justify-center py-20">
                    <svg class="w-24 h-24 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">No Batches Found</h3>
                    <p class="text-gray-500 mb-6">Create your first batch to get started</p>
                    <a href="/class_batch/create" class="bg-violet-800 hover:bg-violet-900 text-white font-bold px-6 py-3 rounded-lg shadow-lg transition">
                        Create Batch
                    </a>
                </div>
            @else
                <!-- Batch Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($classBatches as $classBatch)
                        <div class="relative group">
                            <!-- Delete Button -->

                            <button
                                type="submit"
                                @click="deleteOpen = true;
                                        batchId = '{{$classBatch->id}}';
                                        batchName = '{{ addslashes($classBatch->batch_name) }} ';"
                                class="absolute -top-2 -right-2 z-10 bg-red-500 hover:bg-red-600 text-white rounded-full w-9 h-9 flex items-center justify-center shadow-lg transition-all opacity-0 group-hover:opacity-100 transform scale-90 group-hover:scale-100"
                                title="Delete batch">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </button>
{{--                            <form action="/class_batch/{{ $classBatch->id }}" method="POST" class="absolute -top-2 -right-2 z-10">--}}
{{--                                @csrf--}}
{{--                                @method('DELETE')--}}
{{--                                <button--}}
{{--                                    type="submit"--}}
{{--                                    onclick="return confirm('Are you sure you want to delete {{ $classBatch->batch_name }}? This action cannot be undone.')"--}}
{{--                                    class="bg-red-500 hover:bg-red-600 text-white rounded-full w-9 h-9 flex items-center justify-center shadow-lg transition-all opacity-0 group-hover:opacity-100 transform scale-90 group-hover:scale-100"--}}
{{--                                    title="Delete batch">--}}
{{--                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">--}}
{{--                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />--}}
{{--                                    </svg>--}}
{{--                                </button>--}}
{{--                            </form>--}}

                            <!-- Card -->
                            <a href="/class_batch/students/{{ $classBatch->id }}"
                               class="block bg-gradient-to-br from-violet-600 to-violet-800 rounded-xl shadow-lg hover:shadow-2xl transition-all transform hover:-translate-y-2 duration-300">

                                <div class="p-6 text-white">

                                    <!-- Batch Number Badge -->
                                    <div class="flex justify-between items-start mb-4">
                                        <span class="bg-white/20 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1 rounded-full">
                                            Batch #{{ $classBatch->id }}
                                        </span>
                                        <svg class="w-6 h-6 text-white/30" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path>
                                        </svg>
                                    </div>

                                    <!-- Batch Name -->
                                    <h2 class="text-2xl font-bold mb-6 truncate">
                                        {{ $classBatch->batch_name }}
                                    </h2>

                                    <!-- Details Grid -->
                                    <div class="grid grid-cols-2 gap-4 text-sm">

                                        <!-- Left Column -->
                                        <div class="space-y-3">
                                            <div>
                                                <div class="text-white/70 text-xs font-medium mb-1">Freshmen Year</div>
                                                <div class="font-semibold">{{ $classBatch->school_year }}</div>
                                            </div>
                                            <div>
                                                <div class="text-white/70 text-xs font-medium mb-1">Curriculum</div>
                                                <div class="font-semibold truncate" title="{{ $classBatch->curriculum }}">
                                                    {{ $classBatch->curriculum }}
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Right Column -->
                                        <div class="space-y-3">
                                            <div>
                                                <div class="text-white/70 text-xs font-medium mb-1">Students</div>
                                                <div class="font-semibold flex items-center gap-1">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                                                    </svg>
                                                    {{ $classBatch->students_count }}
                                                </div>
                                            </div>
                                            <div>
                                                <div class="text-white/70 text-xs font-medium mb-1">Adviser</div>
                                                <div class="font-semibold truncate" title="{{ $classBatch->adviser }}">
                                                    {{ $classBatch->adviser }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- View Arrow -->
                                    <div class="mt-6 flex justify-end">
                                        <div class="bg-white/20 backdrop-blur-sm rounded-full p-2 group-hover:bg-white/30 transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </div>
                                    </div>

                                </div>

                                <!-- Decorative Pattern -->
                                <div class="absolute inset-0 bg-[radial-gradient(circle_at_bottom_left,rgba(255,255,255,0.1)_0%,transparent_50%)] pointer-events-none rounded-xl"></div>
                            </a>
                        </div>
                    @endforeach
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
                            Delete Batch
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
                        <span class="font-bold text-gray-900 uppercase" x-text="batchName"></span>?
                        All associated students and grades will be permanently removed.
                    </p>
                </div>

                <!-- Modal Actions -->
                <form
                    :action="`/class_batch/${batchId}`"
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
                            Delete Batch
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</x-layout>















{{--<x-layout>--}}
{{--    <div class="flex justify-between m-4 items-center">--}}
{{--        @if(session('success'))--}}
{{--            <div--}}
{{--                x-data="{ show: true }"--}}
{{--                x-init="setTimeout(() => show = false, 3000)"--}}
{{--                x-show="show"--}}
{{--                x-transition--}}
{{--                class="toast top-30 toast-center z-50"--}}
{{--            >--}}
{{--                <div class="alert alert-success font-bold uppercase">--}}
{{--                    <span>{{ session('success') }}</span>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endif--}}
{{--        <div>--}}
{{--            <form method="GET" action="/class_batch">--}}
{{--                <select onchange="this.form.submit()" name="school_year" class="select bg-violet-400 text-white font-bold rounded w-[9rem] h-[40px] uppercase text-center shadow-lg">--}}
{{--                    <option value="">ALL BATCH</option>--}}
{{--                    @foreach($classSchoolYears as $classSchoolYear)--}}
{{--                        <option value="{{$classSchoolYear}}" {{request('school_year') == $classSchoolYear ? 'selected':'' }}>{{$classSchoolYear}}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </form>--}}

{{--        </div>--}}

{{--        <div class="flex justify-center w-[6rem] h-[40px] bg-violet-800 items-center text-xl text-white p-6 font-bold rounded-xl hover:shadow-xl">--}}
{{--            <a href="/class_batch/create" class="">--}}
{{--                   +Batch--}}
{{--            </a>--}}
{{--        </div>--}}

{{--    </div>--}}

{{--    <main class="h-[85vh] flex justify-center ">--}}

{{--        <div class="grid grid-cols-3 gap-10  overflow-auto">--}}
{{--            @foreach($classBatches as $classBatch)--}}

{{--                <div class="relative">--}}
{{--                    <!-- Delete Button -->--}}
{{--                    <form action="/class_batch/{{$classBatch->id}}" method="POST" class="absolute top-15 right-5 z-10">--}}
{{--                        @csrf--}}
{{--                        @method('DELETE')--}}
{{--                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white rounded-full w-8 h-8 flex items-center justify-center shadow-lg transition-colors" onclick="return confirm('Are you sure you want to delete this batch?')">--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">--}}
{{--                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />--}}
{{--                            </svg>--}}
{{--                        </button>--}}
{{--                    </form>--}}

{{--                    <a href="/class_batch/students/{{$classBatch->id}}" class="hover-3d my-12 mx-2 cursor-pointer">--}}

{{--                        <!-- content -->--}}
{{--                        <div class="card w-[25rem] h-[15rem] bg-violet-800 text-center grid  text-white bg-[radial-gradient(circle_at_bottom_left,#ffffff04_35%,transparent_36%),radial-gradient(circle_at_top_right,#ffffff04_35%,transparent_36%)] bg-size-[4.95em_4.95em]">--}}
{{--                            <div class="card-body">--}}

{{--                                <div class="text-xs"><span class="font-bold">Batch no:</span> {{$classBatch->id}}</div>--}}



{{--                                <div class="text-3xl font-bold">{{$classBatch->batch_name}}</div>--}}

{{--                                <div class="grid grid-cols-2 mt-9 place-items-center">--}}
{{--                                    <div class="text-left">--}}
{{--                                        <div><span class="font-bold">Freshmen Year:</span><br>--}}
{{--                                            <span class="pl-4">{{$classBatch->school_year}}</span>--}}
{{--                                        </div>--}}

{{--                                        <div><span class="font-bold">Curriculum:</span><br>--}}
{{--                                            <span class="pl-4"></span>{{$classBatch->curriculum}}--}}
{{--                                        </div>--}}

{{--                                    </div>--}}

{{--                                    <div class="text-left">--}}
{{--                                        <div><span class="font-bold">No. of Student(s):</span><br>--}}
{{--                                            <span class="pl-4"></span>{{$classBatch->students_count}}</div>--}}
{{--                                        <div><span class="font-bold">Adviser:</span><br>--}}
{{--                                            <span class="pl-4"></span>{{$classBatch->adviser}}</div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}



{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <!-- 8 empty divs needed for the 3D effect -->--}}
{{--                        <div></div>--}}
{{--                        <div></div>--}}
{{--                        <div></div>--}}
{{--                        <div></div>--}}
{{--                        <div></div>--}}
{{--                        <div></div>--}}
{{--                        <div></div>--}}
{{--                        <div></div>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            @endforeach--}}
{{--        </div>--}}

{{--    </main>--}}



{{--</x-layout>--}}
