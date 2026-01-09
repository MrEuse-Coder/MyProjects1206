<x-layout>
    <div class="min-h-screen bg-gradient-to-br from-violet-50 to-violet-100 flex items-center justify-center p-6">

        <div class="w-full max-w-lg">
            <!-- Back Button -->
            <a href="/class_batch/students/{{ $class_batch->id }}" class="inline-flex items-center gap-2 text-violet-700 hover:text-violet-900 font-semibold mb-6 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Students
            </a>

            <!-- Show all errors at top -->
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-red-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                        <div>
                            <h3 class="font-semibold text-red-800 mb-2">Please fix the following errors:</h3>
                            <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif


            <!-- Form Card -->
            <form action="/class_batch/students/{{ $class_batch->id }}" method="POST" onsubmit="handleSubmit(event)" class="bg-white shadow-2xl rounded-2xl overflow-hidden">
                @csrf

                <!-- Header -->
                <div class="bg-gradient-to-r from-violet-600 to-violet-800 px-8 py-6">
                    <h1 class="text-2xl font-bold text-white text-center">Add New Student</h1>
                    <p class="text-violet-100 text-center text-sm mt-1">
                        Adding to <span class="font-semibold">{{ $class_batch->batch_name }}</span>
                    </p>
                </div>

{{--                <!-- Form Body -->--}}
                <div class="p-8 space-y-6">

                    <!-- Student ID -->
                    <div>
                        <label for="student_number" class="block text-sm font-semibold text-gray-700 mb-2">
                            Student ID <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="student_number"
                            name="student_number"
                            required
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition placeholder-gray-400"
                            placeholder="e.g. 22-0026"
                        />
                        <p class="text-xs text-gray-500 mt-1">Enter the student's unique ID number</p>
                    </div>
                    @error('student_number')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <!-- Name Fields Grid -->
                    <div class="space-y-4">

                        <!-- First Name -->
                        <div>
                            <label for="first_name" class="block text-sm font-semibold text-gray-700 mb-2">
                                First Name <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                id="first_name"
                                name="first_name"
                                required
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition placeholder-gray-400"
                                placeholder="e.g. Juan"
                            />
                        </div>

                        <!-- Last Name -->
                        <div>
                            <label for="last_name" class="block text-sm font-semibold text-gray-700 mb-2">
                                Last Name <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                id="last_name"
                                name="last_name"
                                required
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition placeholder-gray-400"
                                placeholder="e.g. Dela Cruz"
                            />
                        </div>

                        <!-- Middle Name -->
                        <div>
                            <label for="middle_name" class="block text-sm font-semibold text-gray-700 mb-2">
                                Middle Name <span class="text-gray-400 text-xs">(Optional)</span>
                            </label>
                            <input
                                type="text"
                                id="middle_name"
                                name="middle_name"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition placeholder-gray-400"
                                placeholder="e.g. Santos"
                            />
                        </div>

                        <!-- Gender -->
                        <div>
                            <label for="gender" class="block text-sm font-semibold text-gray-700 mb-2">
                                Gender <span class="text-red-500">*</span>
                            </label>
                            <select
                                id="gender"
                                name="gender"
                                required
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition appearance-none cursor-pointer">
                                <option value="" disabled selected>Select gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>

                    </div>

                    <!-- Info Box -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 flex gap-3">
                        <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                        </svg>
                        <div class="text-sm text-blue-800">
                            <p class="font-semibold mb-1">Student Information</p>
                            <p>Please ensure all required information is accurate before submitting. You can add grades for this student after creation.</p>
                        </div>
                    </div>

                </div>

                <!-- Form Footer -->
                <div class="bg-gray-50 px-8 py-6 flex gap-3 justify-end border-t border-gray-200">
                    <a href="/class_batch/students/{{ $class_batch->id }}" class="px-6 py-3 bg-white border-2 border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition">
                        Cancel
                    </a>
                    <button
                        type="submit"
                        id="submitBtn"
                        class="px-6 py-3 bg-violet-600 hover:bg-violet-700 text-white font-semibold rounded-lg shadow-lg transition transform hover:scale-105 active:scale-95">
                        Add Student
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
                    Adding...
                </span>
            `;
            btn.classList.add('opacity-50', 'cursor-not-allowed');
        }
    </script>
</x-layout>







{{--<x-layout>--}}
{{--    <div class="h-[90vh] grid grid-cols-1 place-items-center justify-center">--}}
{{--        <form action="/class_batch/students/{{$class_batch->id}}" method="POST" class=" bg-white shadow-2xl rounded-box w-md  p-4 text-black m-auto">--}}
{{--            @csrf--}}

{{--            <div class="grid grid-cols-1 place-items-center gap-2">--}}
{{--                <div class="text-center text-2xl font-bold p-5">Add Student</div>--}}

{{--                <div>--}}
{{--                    <label class="label">Student ID</label><br>--}}
{{--                    <input type="text" name="student_number" class="input bg-gray-200 w-[20rem]" placeholder="22-0026" /><br>--}}
{{--                </div>--}}

{{--                <div>--}}
{{--                    <label class="label">First Name</label><br>--}}
{{--                    <input type="text" name="first_name" class="input bg-gray-200 w-[20rem]" placeholder="Juan De" /><br>--}}
{{--                </div>--}}

{{--                <div>--}}
{{--                    <label class="label">Last Name</label><br>--}}
{{--                    <input type="text" name="last_name" class="input bg-gray-200 w-[20rem]" placeholder="Cruz" />--}}
{{--                </div>--}}

{{--                <div>--}}
{{--                    <label class="label">Middle Name</label><br>--}}
{{--                    <input type="text" name="middle_name" class="input bg-gray-200 w-[20rem]" placeholder="La" />--}}
{{--                </div>--}}

{{--                <div class="flex items-center justify-center">--}}
{{--                    <button type="submit" class="btn bg-violet-800 mt-4 w-[10rem]" onclick="this.disabled=true; this.form.submit();">Create</button>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--        </form>--}}
{{--    </div>--}}
{{--</x-layout>--}}
