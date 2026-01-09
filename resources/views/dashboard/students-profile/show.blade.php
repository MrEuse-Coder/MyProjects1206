<x-sidebar>
    <div class="min-h-screen bg-gradient-to-br from-violet-50 to-violet-100 py-8 px-4">

        <div class="max-w-4xl mx-auto">



            <form action="/dashboard/student/profile/{{$student->id}}" method="POST" enctype="multipart/form-data" onsubmit="handleSubmit(event)">
                @csrf
                @method('PATCH')

                <div class="bg-white shadow-2xl rounded-2xl overflow-hidden">

                    <!-- Header with Profile Picture -->
                    <div class="bg-gradient-to-r from-violet-600 to-violet-800 px-8 py-12 text-center relative">
                        <h1 class="text-3xl font-bold text-white mb-8">Student Profile</h1>

                        <!-- Profile Picture -->

                    </div>

                    <!-- Form Body -->
                    <div class="p-8 space-y-6">

                        <!-- Personal Information Section -->
                        <div>
                            <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-violet-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                </svg>
                                Personal Information
                            </h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

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
                                        value="{{ old('first_name', $student->first_name) }}"
                                        class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition"
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
                                        value="{{ old('last_name', $student->last_name) }}"
                                        class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition"
                                    />
                                </div>

                                <!-- Middle Name -->
                                <div class="md:col-span-2">
                                    <label for="middle_name" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Middle Name <span class="text-gray-400 text-xs">(Optional)</span>
                                    </label>
                                    <input
                                        type="text"
                                        id="middle_name"
                                        name="middle_name"
                                        required
                                        value="{{ old('middle_name', $student->middle_name) }}"
                                        class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition"
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
                                        class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition appearance-none cursor-pointer">
                                        <option value="Male" {{ old('gender', $student->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ old('gender', $student->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                    </select>
                                </div>

                                <!-- Birth Date -->
                                <div>
                                    <label for="birth_date" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Birth Date <span class="text-red-500">*</span>
                                    </label>
                                    <input
                                        type="date"
                                        id="birth_date"
                                        name="birth_date"
                                        value="{{ old('birth_date', $student->birth_date) }}"
                                        class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition"
                                    />
                                </div>

                                <!-- Address -->
                                <div class="md:col-span-2">
                                    <label for="address" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Address <span class="text-red-500">*</span>
                                    </label>
                                    <input
                                        type="text"
                                        id="address"
                                        name="address"
                                        value="{{ old('address', $student->address) }}"
                                        class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition"
                                        placeholder="Complete address"
                                    />
                                </div>

                            </div>
                        </div>

                        <!-- Guardian Information Section -->
                        <div>
                            <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-violet-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                                </svg>
                                Guardian Information
                            </h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                <!-- Guardian Name -->
                                <div>
                                    <label for="guardian_name" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Guardian Name <span class="text-red-500">*</span>
                                    </label>
                                    <input
                                        type="text"
                                        id="guardian_name"
                                        name="guardian_name"
                                        required
                                        value="{{ old('guardian_name', $student->guardian_name) }}"
                                        class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition"
                                        placeholder="Full name"
                                    />
                                </div>

                                <!-- Guardian Phone -->
                                <div>
                                    <label for="guardian_phone" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Guardian Phone <span class="text-red-500">*</span>
                                    </label>
                                    <input
                                        type="tel"
                                        id="guardian_phone"
                                        name="guardian_phone"
                                        required
                                        value="{{ old('guardian_phone', $student->guardian_phone) }}"
                                        class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent transition"
                                        placeholder="09XX XXX XXXX"
                                    />
                                </div>

                            </div>
                        </div>

                    </div>

                    <!-- Form Footer -->
                    <div class="bg-gray-50 px-8 py-6 flex gap-3 justify-end border-t border-gray-200">
                        <a href="/students" class="px-6 py-3 bg-white border-2 border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition">
                            Cancel
                        </a>
                        <button
                            type="submit"
                            id="submitBtn"
                            class="px-6 py-3 bg-violet-600 hover:bg-violet-700 text-white font-semibold rounded-lg shadow-lg transition transform hover:scale-105 active:scale-95 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Update Profile
                        </button>
                    </div>

                </div>
            </form>

        </div>
    </div>

    <script>
        // Preview uploaded image
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profilePreview').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }

        // Handle form submission
        function handleSubmit(event) {
            const btn = document.getElementById('submitBtn');
            btn.disabled = true;
            btn.innerHTML = `
                <span class="flex items-center gap-2">
                    <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Updating...
                </span>
            `;
            btn.classList.add('opacity-50', 'cursor-not-allowed');
        }
    </script>

</x-sidebar>








{{--<x-sidebar>--}}

{{--    <div class="h-screen grid grid-cols-1 justify-items-center">--}}
{{--        <form method="POST">--}}
{{--            @csrf--}}
{{--            @method('PATCH')--}}
{{--            <div class="bg-white shadow-xl w-[40rem] h-[70rem] grid grid-cols-1 justify-items-center items-center  rounded-xl  m-10">--}}

{{--                <div class="text-3xl font-bold text-violet-900">--}}
{{--                    STUDENT PROFILE--}}
{{--                </div>--}}
{{--                <div class="avatar mt-[-3rem] mb-[-3rem] ">--}}
{{--                    <div class="ring-primary ring-offset-base-100 w-[13rem] h-[13rem] rounded-full ring-2 ring-offset-2">--}}
{{--                        <img src="https://img.daisyui.com/images/profile/demo/spiderperson@192.webp" />--}}
{{--                    </div><br>--}}

{{--                </div>--}}

{{--                <div class="grid grid-cols-1 justify-items-center gap-2">--}}
{{--                    <div>--}}
{{--                        <label>Profile Picture</label><br>--}}
{{--                        <input type="file" class="bg-gray-300 px-4 py-2 rounded">--}}
{{--                    </div>--}}
{{--                    <div >--}}
{{--                        <label class="">First Name</label><br>--}}
{{--                        <input type="text" class="input bg-violet-300 w-[20rem]" value="{{$student->first_name}}" />--}}
{{--                    </div>--}}

{{--                    <div>--}}
{{--                        <label class="">Last Name</label><br>--}}
{{--                        <input type="text" class="input bg-violet-300 w-[20rem]" value="{{$student->last_name}}" />--}}
{{--                    </div>--}}

{{--                    <div>--}}
{{--                        <label class="">Middle Name</label><br>--}}
{{--                        <input type="text" class="input bg-violet-300 w-[20rem]" value="{{$student->middle_name}}" />--}}
{{--                    </div>--}}

{{--                    <div class="flex">--}}
{{--                        <div>--}}
{{--                            <label>Sex</label><br>--}}
{{--                            <select type="text" class="select bg-violet-300 w-[10rem]">--}}
{{--                                <option>{{$student->gender}}</option>--}}
{{--                                <option value="M">M</option>--}}
{{--                                <option value="F">F</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}

{{--                        <div>--}}
{{--                            <label>Birth Date</label><br>--}}
{{--                            <input type="date" class="input bg-violet-300 w-[10rem]" value="{{$student->birth_date}}" />--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div>--}}
{{--                        <label>Address</label><br>--}}
{{--                        <input type="text" class="input bg-violet-300 w-[20rem]" value="{{$student->address}}" />--}}
{{--                    </div>--}}

{{--                    <div>--}}
{{--                        <label>Guardian</label><br>--}}
{{--                        <input type="text" class="input bg-violet-300 w-[20rem]" value="{{$student->guardian_name}}" />--}}
{{--                    </div>--}}

{{--                    <div>--}}
{{--                        <label>Guardian no.</label><br>--}}
{{--                        <input type="text" class="input bg-violet-300 w-[20rem]" value="{{$student->guardian_phone}}" />--}}
{{--                    </div>--}}

{{--                </div>--}}

{{--                <button class="btn bg-violet-500 font-bold mt-[-8rem]">UPDATE</button>--}}
{{--            </div>--}}

{{--        </form>--}}
{{--    </div>--}}

{{--</x-sidebar>--}}
