<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function dashboardStudents(Request $request, Student $student){
        $students = $student->when($request->student_search, function ($query, $student) {
            $query->where('last_name', 'like' , "{$student}%")
            ->orWhere('first_name', 'like' , "{$student}%");
        }) ->paginate(10);

        return view('dashboard.students-profile.index', compact('students'));
    }

    public function studentProfile(Student $student){
        return view('dashboard.students-profile.show', compact('student'));
    }

    public function update(Request $request, Student $student){
        $attrs = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'gender' => 'nullable|string',
            'birth_date' => 'nullable|date',
            'address' => 'nullable|string',
            'guardian_name' => 'nullable|string',
            'guardian_phone' => 'nullable|string',
        ]);

        $student->update($attrs);

        return redirect('/dashboard/students-profile')->with('success', 'Profile updated!');
    }
}
