<x-layout>
    <div class="min-h-screen bg-gray-50 p-6">
        <div class="max-w-7xl mx-auto bg-white shadow-lg rounded-lg p-8">

            <!-- Header with Logo -->
            <div class="text-center mb-6">
                <img
                    src="https://i.postimg.cc/vm3zNzrV/essu-new-logo-header-2-removebg-preview.png"
                    alt="ESSU Logo"
                    class="mx-auto h-24 mb-4"
                >

                <h1 class="text-2xl font-bold text-gray-800 mb-2">
                    BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY (BSIT)
                </h1>
                <p class="text-gray-600 text-sm">Effective SY 2022-2023</p>
                <p class="text-gray-500 text-xs">
                    (Revised per CMO 25 S 2015, CHED CMO 20 S of 2013 and CHED CMO 04 s 2018)
                </p>
            </div>

            <!-- Student Information Card -->
            <div class="bg-gradient-to-r from-violet-50 to-violet-100 rounded-lg p-6 mb-6 border border-violet-200">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <span class="text-gray-600 font-medium">Name:</span>
                        <span class="font-bold text-gray-900 ml-2 uppercase">
                            {{ $student->last_name }}, {{ $student->first_name }} {{ substr($student->middle_name, 0, 1) }}.
                        </span>
                    </div>
                    <div>
                        <span class="text-gray-600 font-medium">Sex:</span>
                        <span class="font-bold text-gray-900 ml-2 uppercase">{{ $student->gender }}</span>
                    </div>
                    <div class="md:col-span-2">
                        <span class="text-gray-600 font-medium">Student No:</span>
                        <span class="font-bold text-gray-900 ml-2 uppercase">{{ $student->student_number }}</span>
                    </div>
                </div>
            </div>

            @php
                // Define all year/semester data structure to eliminate repetition
                $academicStructure = [
                    ['year' => 'FIRST YEAR', 'semesters' => [
                        ['title' => 'First Semester', 'subjects' => $year1Sem1Subjects],
                        ['title' => 'Second Semester', 'subjects' => $year1Sem2Subjects]
                    ]],
                    ['year' => 'SECOND YEAR', 'semesters' => [
                        ['title' => 'First Semester', 'subjects' => $year2Sem1Subjects],
                        ['title' => 'Second Semester', 'subjects' => $year2Sem2Subjects]
                    ]],
                    ['year' => 'THIRD YEAR', 'semesters' => [
                        ['title' => 'First Semester', 'subjects' => $year3Sem1Subjects],
                        ['title' => 'Second Semester', 'subjects' => $year3Sem2Subjects]
                    ]],
                    ['year' => 'FOURTH YEAR', 'semesters' => [
                        ['title' => 'First Semester', 'subjects' => $year4Sem1Subjects],
                        ['title' => 'Second Semester', 'subjects' => $year4Sem2Subjects]
                    ]]
                ];
            @endphp

                <!-- Academic Records -->
            @foreach($academicStructure as $yearData)
                <!-- Year Header -->
                <div class="bg-violet-600 text-white font-bold text-lg px-6 py-3 rounded-t-lg mt-8">
                    {{ $yearData['year'] }}
                </div>

                @foreach($yearData['semesters'] as $semesterData)
                    @if($semesterData['subjects']->count() > 0)
                        <!-- Semester Subheader -->
                        <div class="bg-violet-100 text-violet-800 font-semibold px-6 py-2 border-l-4 border-violet-600">
                            {{ $semesterData['title'] }}
                        </div>

                        <!-- Subjects Table -->
                        <div class="overflow-x-auto mb-6">
                            <table class="min-w-full border border-gray-200 rounded-b-lg">
                                <thead class="bg-gray-100">
                                <tr class="text-center text-sm">
                                    <th class="px-4 py-3 font-semibold text-gray-700 border-r">Final Grade</th>
                                    <th class="px-4 py-3 font-semibold text-gray-700 border-r">Course Code</th>
                                    <th class="px-4 py-3 font-semibold text-gray-700 border-r">Descriptive Title</th>
                                    <th class="px-4 py-3 font-semibold text-gray-700 border-r">Total Units</th>
                                    <th class="px-4 py-3 font-semibold text-gray-700 border-r">Lec Units</th>
                                    <th class="px-4 py-3 font-semibold text-gray-700 border-r">Lab Units</th>
                                    <th class="px-4 py-3 font-semibold text-gray-700 border-r">Hours/Week</th>
                                    <th class="px-4 py-3 font-semibold text-gray-700">Pre-Requisite</th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($semesterData['subjects'] as $subject)
                                    <tr class="text-center hover:bg-gray-50 transition text-sm">
                                        <td class="px-4 py-3 text-gray-800 border-r font-semibold">
                                            @php
                                                $midterm = $subject->pivot->midterm ?? 0;
                                                $final = $subject->pivot->final ?? 0;
                                                $average = ($midterm + $final) / 2;
                                            @endphp
                                            {{ number_format($average, 1) }}
                                        </td>
                                        <td class="px-4 py-3 text-gray-800 border-r font-medium uppercase">
                                            {{ $subject->course_code }}
                                        </td>
                                        <td class="px-4 py-3 text-gray-800 border-r text-left">
                                            {{ $subject->descriptive_title }}
                                        </td>
                                        <td class="px-4 py-3 text-gray-800 border-r">{{ $subject->total_units }}</td>
                                        <td class="px-4 py-3 text-gray-800 border-r">{{ $subject->lec_units }}</td>
                                        <td class="px-4 py-3 text-gray-800 border-r">{{ $subject->lab_units }}</td>
                                        <td class="px-4 py-3 text-gray-800 border-r">{{ $subject->hours_week }}</td>
                                        <td class="px-4 py-3 text-gray-800 text-sm">
                                            {{ $subject->pre_requisite ?? 'None' }}
                                        </td>
                                    </tr>
                                @endforeach

                                <!-- Total Row -->
                                <tr class="bg-violet-50 font-bold text-center text-sm border-t-2 border-violet-300">
                                    <td class="px-4 py-3 border-r"></td>
                                    <td class="px-4 py-3 border-r"></td>
                                    <td class="px-4 py-3 text-right border-r text-violet-800">TOTAL</td>
                                    <td class="px-4 py-3 border-r text-violet-800">
                                        {{ $semesterData['subjects']->sum('total_units') }}
                                    </td>
                                    <td class="px-4 py-3 border-r text-violet-800">
                                        {{ $semesterData['subjects']->sum('lec_units') }}
                                    </td>
                                    <td class="px-4 py-3 border-r text-violet-800">
                                        {{ $semesterData['subjects']->sum('lab_units') }}
                                    </td>
                                    <td class="px-4 py-3 border-r text-violet-800">
                                        {{ $semesterData['subjects']->sum('hours_week') }}
                                    </td>
                                    <td class="px-4 py-3"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    @endif
                @endforeach
            @endforeach

            <!-- Print Button (optional) -->
            <div class="flex justify-center mt-8 gap-2">
                <button
                    class="bg-violet-600 hover:bg-violet-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg transition transform hover:scale-105">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline-block w-5 h-5 mr-2" >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>

                    Download PDF
                </button>
            </div>
        </div>
    </div>


</x-layout>























{{--<x-layout>--}}
{{--    <div class="m-4">--}}
{{--        <div class="w-100">--}}
{{--            <img src="https://i.postimg.cc/vm3zNzrV/essu-new-logo-header-2-removebg-preview.png">--}}
{{--        </div>--}}

{{--        <div class="flex flex-col text-center mb-3">--}}
{{--            <h1 class="font-bold text-xl">BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY (BSIT)</h1>--}}
{{--            <span class="text-lg">Effective SY 2022-2023</span>--}}
{{--            <span class="text-lg">(Revised per CMO 25 S 2015, CHED CMO 20 S of 2013 and CHED CMO 04 s 2018)</span>--}}
{{--        </div>--}}

{{--        <div class="grid grid-cols-2 mb-5 text-lg">--}}
{{--            <div class="">--}}
{{--                <span>Name: <span class="font-bold">{{$student->last_name}}, {{$student->first_name}} {{substr($student->middle_name,0,1)}}.  </span></span>--}}
{{--            </div>--}}
{{--            <div class="">--}}
{{--                <span>Sex: <span class="font-bold">{{$student->gender}}</span></span>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="mb-3 text-lg">--}}
{{--            <div class="flex justify-start">--}}
{{--                <span>Student No: <span class="font-bold">{{$student->student_number}}</span></span>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="overflow-x-auto m-4">--}}
{{--        <div class="font-bold text-lg">--}}
{{--            FIRST YEAR--}}
{{--        </div>--}}
{{--        <div class="text-lg">--}}
{{--            First Semester--}}
{{--        </div>--}}

{{--        <table class="min-w-full border border-gray-200 divide-y divide-gray-200 rounded-lg shadow-md ">--}}
{{--            <thead class="bg-gray-100">--}}
{{--            <tr class="text-center">--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Final Grade</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Course Code</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Descriptive Title</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Total Units</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Lec Units</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Lab Units</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Hours/Week</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Pre-Requisite</th>--}}
{{--            </tr>--}}
{{--            </thead>--}}
{{--            <tbody class="bg-white divide-y divide-gray-200">--}}
{{--            @foreach($year1Sem1Subjects as $subject)--}}

{{--                    <tr class="text-center hover:bg-gray-50 transition">--}}
{{--                        <td class="px-4 py-2 text-sm text-gray-800">--}}
{{--                            @php--}}
{{--                            $midterm = $subject->pivot->midterm;--}}
{{--                            $final = $subject->pivot->final;--}}
{{--                            $average = round(($midterm + $final) / 2, 1);--}}
{{--                            @endphp--}}
{{--                            {{$average}}--}}
{{--                        </td>--}}
{{--                        <td class="px-4 py-2 text-sm text-gray-800">{{$subject->course_code}}</td>--}}
{{--                        <td class="px-4 py-2 text-sm text-gray-800">{{$subject->descriptive_title}}</td>--}}
{{--                        <td class="px-4 py-2 text-sm text-gray-800">{{$subject->total_units}}</td>--}}
{{--                        <td class="px-4 py-2 text-sm text-gray-800">{{$subject->lec_units}}</td>--}}
{{--                        <td class="px-4 py-2 text-sm text-gray-800">{{$subject->lab_units}}</td>--}}
{{--                        <td class="px-4 py-2 text-sm text-gray-800">{{$subject->hours_week}}</td>--}}
{{--                        <td class="px-4 py-2 text-sm text-gray-800">{{$subject->pre_requisite}}</td>--}}
{{--                    </tr>--}}

{{--            @endforeach--}}

{{--            <tr class="text-center hover:bg-gray-50 transition">--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold"></td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold"></td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold">TOTAL</td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold">--}}
{{--                @php--}}
{{--                $total_units = $year1Sem1Subjects->sum('total_units');--}}
{{--                @endphp--}}
{{--                    {{$total_units}}--}}
{{--                </td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold">--}}
{{--                    @php--}}
{{--                        $lec_units = $year1Sem1Subjects->sum('lec_units');--}}
{{--                    @endphp--}}
{{--                    {{$lec_units}}--}}
{{--                </td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold">--}}
{{--                    @php--}}
{{--                        $lab_units = $year1Sem1Subjects->sum('lab_units');--}}
{{--                    @endphp--}}
{{--                    {{$lab_units}}--}}
{{--                </td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold">--}}
{{--                    @php--}}
{{--                        $hours_week = $year1Sem1Subjects->sum('hours_week');--}}
{{--                    @endphp--}}
{{--                    {{$hours_week}}--}}
{{--                </td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold"></td>--}}
{{--            </tr>--}}

{{--            </tbody>--}}
{{--        </table>--}}

{{----------------------------------------------------------------------------------------------------------------------}}
{{--        <div class="text-lg mt-4">--}}
{{--            Second Semester--}}
{{--        </div>--}}

{{--        <table class="min-w-full border border-gray-200 divide-y divide-gray-200 rounded-lg shadow-md ">--}}
{{--            <thead class="bg-gray-100">--}}
{{--            <tr class="text-center">--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Final Grade</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Course Code</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Descriptive Title</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Total Units</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Lec Units</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Lab Units</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Hours/Week</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Pre-Requisite</th>--}}
{{--            </tr>--}}
{{--            </thead>--}}
{{--            <tbody class="bg-white divide-y divide-gray-200">--}}
{{--            @foreach($year1Sem2Subjects as $subject)--}}

{{--                <tr class="text-center hover:bg-gray-50 transition">--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">--}}
{{--                        @php--}}
{{--                            $midterm = $subject->pivot->midterm;--}}
{{--                            $final = $subject->pivot->final;--}}
{{--                            $average = round(($midterm + $final) / 2, 1);--}}
{{--                        @endphp--}}
{{--                        {{$average}}--}}
{{--                    </td>--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">{{$subject->course_code}}</td>--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">{{$subject->descriptive_title}}</td>--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">{{$subject->total_units}}</td>--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">{{$subject->lec_units}}</td>--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">{{$subject->lab_units}}</td>--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">{{$subject->hours_week}}</td>--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">{{$subject->pre_requisite}}</td>--}}
{{--                </tr>--}}

{{--            @endforeach--}}

{{--            <tr class="text-center hover:bg-gray-50 transition">--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold"></td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold"></td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold">TOTAL</td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold">--}}
{{--                    @php--}}
{{--                        $total_units = $year1Sem2Subjects->sum('total_units');--}}
{{--                    @endphp--}}
{{--                    {{$total_units}}--}}
{{--                </td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold">--}}
{{--                    @php--}}
{{--                        $lec_units = $year1Sem2Subjects->sum('lec_units');--}}
{{--                    @endphp--}}
{{--                    {{$lec_units}}--}}
{{--                </td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold">--}}
{{--                    @php--}}
{{--                        $lab_units = $year1Sem2Subjects->sum('lab_units');--}}
{{--                    @endphp--}}
{{--                    {{$lab_units}}--}}
{{--                </td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold">--}}
{{--                    @php--}}
{{--                        $hours_week = $year1Sem2Subjects->sum('hours_week');--}}
{{--                    @endphp--}}
{{--                    {{$hours_week}}--}}
{{--                </td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold"></td>--}}
{{--            </tr>--}}

{{--            </tbody>--}}
{{--        </table>--}}

{{------------------------------------------------------------------------------------------------------------------------}}
{{--        <div class="font-bold text-lg  mt-4">--}}
{{--            SECOND YEAR--}}
{{--        </div>--}}
{{--        <div class="text-lg">--}}
{{--            First Semester--}}
{{--        </div>--}}

{{--        <table class="min-w-full border border-gray-200 divide-y divide-gray-200 rounded-lg shadow-md ">--}}
{{--            <thead class="bg-gray-100">--}}
{{--            <tr class="text-center">--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Final Grade</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Course Code</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Descriptive Title</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Total Units</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Lec Units</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Lab Units</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Hours/Week</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Pre-Requisite</th>--}}
{{--            </tr>--}}
{{--            </thead>--}}
{{--            <tbody class="bg-white divide-y divide-gray-200">--}}
{{--            @foreach($year2Sem1Subjects as $subject)--}}

{{--                <tr class="text-center hover:bg-gray-50 transition">--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">--}}
{{--                        @php--}}
{{--                            $midterm = $subject->pivot->midterm;--}}
{{--                            $final = $subject->pivot->final;--}}
{{--                            $average = round(($midterm + $final) / 2, 1);--}}
{{--                        @endphp--}}
{{--                        {{$average}}--}}
{{--                    </td>--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">{{$subject->course_code}}</td>--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">{{$subject->descriptive_title}}</td>--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">{{$subject->total_units}}</td>--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">{{$subject->lec_units}}</td>--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">{{$subject->lab_units}}</td>--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">{{$subject->hours_week}}</td>--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">{{$subject->pre_requisite}}</td>--}}
{{--                </tr>--}}

{{--            @endforeach--}}

{{--            <tr class="text-center hover:bg-gray-50 transition">--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold"></td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold"></td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold">TOTAL</td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold">--}}
{{--                    @php--}}
{{--                        $total_units = $year2Sem1Subjects->sum('total_units');--}}
{{--                    @endphp--}}
{{--                    {{$total_units}}--}}
{{--                </td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold">--}}
{{--                    @php--}}
{{--                        $lec_units = $year2Sem1Subjects->sum('lec_units');--}}
{{--                    @endphp--}}
{{--                    {{$lec_units}}--}}
{{--                </td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold">--}}
{{--                    @php--}}
{{--                        $lab_units = $year2Sem1Subjects->sum('lab_units');--}}
{{--                    @endphp--}}
{{--                    {{$lab_units}}--}}
{{--                </td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold">--}}
{{--                    @php--}}
{{--                        $hours_week = $year2Sem1Subjects->sum('hours_week');--}}
{{--                    @endphp--}}
{{--                    {{$hours_week}}--}}
{{--                </td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold"></td>--}}
{{--            </tr>--}}

{{--            </tbody>--}}
{{--        </table>--}}

{{--        --}}{{------------------------------------------------------------------------------------------------------------------------}}
{{--        <div class="text-lg mt-4">--}}
{{--            Second Semester--}}
{{--        </div>--}}

{{--        <table class="min-w-full border border-gray-200 divide-y divide-gray-200 rounded-lg shadow-md ">--}}
{{--            <thead class="bg-gray-100">--}}
{{--            <tr class="text-center">--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Final Grade</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Course Code</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Descriptive Title</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Total Units</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Lec Units</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Lab Units</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Hours/Week</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Pre-Requisite</th>--}}
{{--            </tr>--}}
{{--            </thead>--}}
{{--            <tbody class="bg-white divide-y divide-gray-200">--}}
{{--            @foreach($year2Sem2Subjects as $subject)--}}

{{--                <tr class="text-center hover:bg-gray-50 transition">--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">--}}
{{--                        @php--}}
{{--                            $midterm = $subject->pivot->midterm;--}}
{{--                            $final = $subject->pivot->final;--}}
{{--                            $average = round(($midterm + $final) / 2, 1);--}}
{{--                        @endphp--}}
{{--                        {{$average}}--}}
{{--                    </td>--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">{{$subject->course_code}}</td>--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">{{$subject->descriptive_title}}</td>--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">{{$subject->total_units}}</td>--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">{{$subject->lec_units}}</td>--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">{{$subject->lab_units}}</td>--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">{{$subject->hours_week}}</td>--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">{{$subject->pre_requisite}}</td>--}}
{{--                </tr>--}}

{{--            @endforeach--}}

{{--            <tr class="text-center hover:bg-gray-50 transition">--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold"></td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold"></td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold">TOTAL</td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold">--}}
{{--                    @php--}}
{{--                        $total_units = $year2Sem2Subjects->sum('total_units');--}}
{{--                    @endphp--}}
{{--                    {{$total_units}}--}}
{{--                </td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold">--}}
{{--                    @php--}}
{{--                        $lec_units = $year2Sem2Subjects->sum('lec_units');--}}
{{--                    @endphp--}}
{{--                    {{$lec_units}}--}}
{{--                </td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold">--}}
{{--                    @php--}}
{{--                        $lab_units = $year2Sem2Subjects->sum('lab_units');--}}
{{--                    @endphp--}}
{{--                    {{$lab_units}}--}}
{{--                </td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold">--}}
{{--                    @php--}}
{{--                        $hours_week = $year2Sem2Subjects->sum('hours_week');--}}
{{--                    @endphp--}}
{{--                    {{$hours_week}}--}}
{{--                </td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold"></td>--}}
{{--            </tr>--}}

{{--            </tbody>--}}
{{--        </table>--}}

{{--        --}}{{------------------------------------------------------------------------------------------------------------------------}}
{{--        <div class="font-bold text-lg  mt-4">--}}
{{--            THIRD YEAR--}}
{{--        </div>--}}
{{--        <div class="text-lg">--}}
{{--            First Semester--}}
{{--        </div>--}}

{{--        <table class="min-w-full border border-gray-200 divide-y divide-gray-200 rounded-lg shadow-md ">--}}
{{--            <thead class="bg-gray-100">--}}
{{--            <tr class="text-center">--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Final Grade</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Course Code</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Descriptive Title</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Total Units</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Lec Units</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Lab Units</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Hours/Week</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Pre-Requisite</th>--}}
{{--            </tr>--}}
{{--            </thead>--}}
{{--            <tbody class="bg-white divide-y divide-gray-200">--}}
{{--            @foreach($year3Sem1Subjects as $subject)--}}

{{--                <tr class="text-center hover:bg-gray-50 transition">--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">--}}
{{--                        @php--}}
{{--                            $midterm = $subject->pivot->midterm;--}}
{{--                            $final = $subject->pivot->final;--}}
{{--                            $average = round(($midterm + $final) / 2, 1);--}}
{{--                        @endphp--}}
{{--                        {{$average}}--}}
{{--                    </td>--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">{{$subject->course_code}}</td>--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">{{$subject->descriptive_title}}</td>--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">{{$subject->total_units}}</td>--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">{{$subject->lec_units}}</td>--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">{{$subject->lab_units}}</td>--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">{{$subject->hours_week}}</td>--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">{{$subject->pre_requisite}}</td>--}}
{{--                </tr>--}}

{{--            @endforeach--}}

{{--            <tr class="text-center hover:bg-gray-50 transition">--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold"></td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold"></td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold">TOTAL</td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold">--}}
{{--                    @php--}}
{{--                        $total_units = $year3Sem1Subjects->sum('total_units');--}}
{{--                    @endphp--}}
{{--                    {{$total_units}}--}}
{{--                </td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold">--}}
{{--                    @php--}}
{{--                        $lec_units = $year3Sem1Subjects->sum('lec_units');--}}
{{--                    @endphp--}}
{{--                    {{$lec_units}}--}}
{{--                </td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold">--}}
{{--                    @php--}}
{{--                        $lab_units = $year3Sem1Subjects->sum('lab_units');--}}
{{--                    @endphp--}}
{{--                    {{$lab_units}}--}}
{{--                </td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold">--}}
{{--                    @php--}}
{{--                        $hours_week = $year3Sem1Subjects->sum('hours_week');--}}
{{--                    @endphp--}}
{{--                    {{$hours_week}}--}}
{{--                </td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold"></td>--}}
{{--            </tr>--}}

{{--            </tbody>--}}
{{--        </table>--}}

{{--        --}}{{------------------------------------------------------------------------------------------------------------------------}}

{{--        <div class="text-lg mt-4">--}}
{{--            Second Semester--}}
{{--        </div>--}}

{{--        <table class="min-w-full border border-gray-200 divide-y divide-gray-200 rounded-lg shadow-md ">--}}
{{--            <thead class="bg-gray-100">--}}
{{--            <tr class="text-center">--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Final Grade</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Course Code</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Descriptive Title</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Total Units</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Lec Units</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Lab Units</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Hours/Week</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Pre-Requisite</th>--}}
{{--            </tr>--}}
{{--            </thead>--}}
{{--            <tbody class="bg-white divide-y divide-gray-200">--}}
{{--            @foreach($year3Sem2Subjects as $subject)--}}

{{--                <tr class="text-center hover:bg-gray-50 transition">--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">--}}
{{--                        @php--}}
{{--                            $midterm = $subject->pivot->midterm;--}}
{{--                            $final = $subject->pivot->final;--}}
{{--                            $average = ($midterm + $final) / 2;--}}
{{--                        @endphp--}}
{{--                        {{ number_format($average,1) }}--}}
{{--                    </td>--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">{{$subject->course_code}}</td>--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">{{$subject->descriptive_title}}</td>--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">{{$subject->total_units}}</td>--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">{{$subject->lec_units}}</td>--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">{{$subject->lab_units}}</td>--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">{{$subject->hours_week}}</td>--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">{{$subject->pre_requisite}}</td>--}}
{{--                </tr>--}}

{{--            @endforeach--}}

{{--            <tr class="text-center hover:bg-gray-50 transition">--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold"></td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold"></td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold">TOTAL</td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold">--}}
{{--                    @php--}}
{{--                        $total_units = $year3Sem2Subjects->sum('total_units');--}}
{{--                    @endphp--}}
{{--                    {{$total_units}}--}}
{{--                </td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold">--}}
{{--                    @php--}}
{{--                        $lec_units = $year3Sem2Subjects->sum('lec_units');--}}
{{--                    @endphp--}}
{{--                    {{$lec_units}}--}}
{{--                </td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold">--}}
{{--                    @php--}}
{{--                        $lab_units = $year3Sem2Subjects->sum('lab_units');--}}
{{--                    @endphp--}}
{{--                    {{$lab_units}}--}}
{{--                </td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold">--}}
{{--                    @php--}}
{{--                        $hours_week = $year3Sem2Subjects->sum('hours_week');--}}
{{--                    @endphp--}}
{{--                    {{$hours_week}}--}}
{{--                </td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold"></td>--}}
{{--            </tr>--}}

{{--            </tbody>--}}
{{--        </table>--}}

{{--        --}}{{------------------------------------------------------------------------------------------------------------------------}}
{{--        <div class="font-bold text-lg  mt-4">--}}
{{--            FOURTH YEAR--}}
{{--        </div>--}}
{{--        <div class="text-lg">--}}
{{--            First Semester--}}
{{--        </div>--}}

{{--        <table class="min-w-full border border-gray-200 divide-y divide-gray-200 rounded-lg shadow-md ">--}}
{{--            <thead class="bg-gray-100">--}}
{{--            <tr class="text-center">--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Final Grade</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Course Code</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Descriptive Title</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Total Units</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Lec Units</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Lab Units</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Hours/Week</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Pre-Requisite</th>--}}
{{--            </tr>--}}
{{--            </thead>--}}
{{--            <tbody class="bg-white divide-y divide-gray-200">--}}
{{--            @foreach($year4Sem1Subjects as $subject)--}}

{{--                <tr class="text-center hover:bg-gray-50 transition">--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">--}}
{{--                        @php--}}
{{--                            $midterm = $subject->pivot->midterm;--}}
{{--                            $final = $subject->pivot->final;--}}
{{--                            $average = round(($midterm + $final) / 2, 1);--}}
{{--                        @endphp--}}
{{--                        {{$average}}--}}
{{--                    </td>--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">{{$subject->course_code}}</td>--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">{{$subject->descriptive_title}}</td>--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">{{$subject->total_units}}</td>--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">{{$subject->lec_units}}</td>--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">{{$subject->lab_units}}</td>--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">{{$subject->hours_week}}</td>--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">{{$subject->pre_requisite}}</td>--}}
{{--                </tr>--}}

{{--            @endforeach--}}

{{--            <tr class="text-center hover:bg-gray-50 transition">--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold"></td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold"></td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold">TOTAL</td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold">--}}
{{--                    @php--}}
{{--                        $total_units = $year4Sem1Subjects->sum('total_units');--}}
{{--                    @endphp--}}
{{--                    {{$total_units}}--}}
{{--                </td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold">--}}
{{--                    @php--}}
{{--                        $lec_units = $year4Sem1Subjects->sum('lec_units');--}}
{{--                    @endphp--}}
{{--                    {{$lec_units}}--}}
{{--                </td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold">--}}
{{--                    @php--}}
{{--                        $lab_units = $year4Sem1Subjects->sum('lab_units');--}}
{{--                    @endphp--}}
{{--                    {{$lab_units}}--}}
{{--                </td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold">--}}
{{--                    @php--}}
{{--                        $hours_week = $year4Sem1Subjects->sum('hours_week');--}}
{{--                    @endphp--}}
{{--                    {{$hours_week}}--}}
{{--                </td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold"></td>--}}
{{--            </tr>--}}

{{--            </tbody>--}}
{{--        </table>--}}


{{--        --}}{{------------------------------------------------------------------------------------------------------------------------}}

{{--        <div class="text-lg mt-4">--}}
{{--            Second Semester--}}
{{--        </div>--}}

{{--        <table class="min-w-full border border-gray-200 divide-y divide-gray-200 rounded-lg shadow-md ">--}}
{{--            <thead class="bg-gray-100">--}}
{{--            <tr class="text-center">--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Final Grade</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Course Code</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Descriptive Title</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Total Units</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Lec Units</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Lab Units</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Hours/Week</th>--}}
{{--                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Pre-Requisite</th>--}}
{{--            </tr>--}}
{{--            </thead>--}}
{{--            <tbody class="bg-white divide-y divide-gray-200">--}}
{{--            @foreach($year4Sem2Subjects as $subject)--}}

{{--                <tr class="text-center hover:bg-gray-50 transition">--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">--}}
{{--                        @php--}}
{{--                            $midterm = $subject->pivot->midterm;--}}
{{--                            $final = $subject->pivot->final;--}}
{{--                            $average = round(($midterm + $final) / 2, 1);--}}
{{--                        @endphp--}}
{{--                        {{$average}}--}}
{{--                    </td>--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">{{$subject->course_code}}</td>--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">{{$subject->descriptive_title}}</td>--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">{{$subject->total_units}}</td>--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">{{$subject->lec_units}}</td>--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">{{$subject->lab_units}}</td>--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">{{$subject->hours_week}}</td>--}}
{{--                    <td class="px-4 py-2 text-sm text-gray-800">{{$subject->pre_requisite}}</td>--}}
{{--                </tr>--}}

{{--            @endforeach--}}

{{--            <tr class="text-center hover:bg-gray-50 transition">--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold"></td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold"></td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold">TOTAL</td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold">--}}
{{--                    @php--}}
{{--                        $total_units = $year4Sem2Subjects->sum('total_units');--}}
{{--                    @endphp--}}
{{--                    {{$total_units}}--}}
{{--                </td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold">--}}
{{--                    @php--}}
{{--                        $lec_units = $year4Sem2Subjects->sum('lec_units');--}}
{{--                    @endphp--}}
{{--                    {{$lec_units}}--}}
{{--                </td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold">--}}
{{--                    @php--}}
{{--                        $lab_units = $year4Sem2Subjects->sum('lab_units');--}}
{{--                    @endphp--}}
{{--                    {{$lab_units}}--}}
{{--                </td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold">--}}
{{--                    @php--}}
{{--                        $hours_week = $year4Sem2Subjects->sum('hours_week');--}}
{{--                    @endphp--}}
{{--                    {{$hours_week}}--}}
{{--                </td>--}}
{{--                <td class="px-4 py-2 text-sm text-gray-800 font-bold"></td>--}}
{{--            </tr>--}}

{{--            </tbody>--}}
{{--        </table>--}}

{{--    </div>--}}





{{--</x-layout>--}}
