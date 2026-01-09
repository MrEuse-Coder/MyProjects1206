<?php

namespace App\Http\Controllers;

use App\Models\ClassBatch;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function add( Student $student){

        $curriculum = $student->class_batch->curriculum;

        $subjectsYear1Sem1 = Subject::where('curriculum', $curriculum)
            ->where('year_level', 1)
            ->where('semester', 1)
            ->with([
                'students' => function ($query) use ($student) {
                    $query->where('students.id', $student->id);
                }
            ])
            ->get();

        $subjectsYear1Sem2 = Subject::where('curriculum', $curriculum)
            ->where('year_level', 1)
            ->where('semester', 2)
            ->with([
                'students' => function ($query) use ($student) {
                    $query->where('students.id', $student->id);
                }
            ])
            ->get();

        $subjectsYear2Sem1 = Subject::where('curriculum', $curriculum)
            ->where('year_level', 2)
            ->where('semester', 1)
            ->with([
                'students' => function ($query) use ($student) {
                    $query->where('students.id', $student->id);
                }
            ])
            ->get();

        $subjectsYear2Sem2 = Subject::where('curriculum', $curriculum)
            ->where('year_level', 2)
            ->where('semester', 2)
            ->with([
                'students' => function ($query) use ($student) {
                    $query->where('students.id', $student->id);
                }
            ])
            ->get();

        $subjectsYear3Sem1 = Subject::where('curriculum', $curriculum)
            ->where('year_level', 3)
            ->where('semester', 1)
            ->with([
                'students' => function ($query) use ($student) {
                    $query->where('students.id', $student->id);
                }
            ])
            ->get();

        $subjectsYear3Sem2 = Subject::where('curriculum', $curriculum)
            ->where('year_level', 3)
            ->where('semester', 2)
            ->with([
                'students' => function ($query) use ($student) {
                    $query->where('students.id', $student->id);
                }
            ])
            ->get();

        $subjectsYear4Sem1 = Subject::where('curriculum', $curriculum)
            ->where('year_level', 4)
            ->where('semester', 1)
            ->with([
                'students' => function ($query) use ($student) {
                    $query->where('students.id', $student->id);
                }
            ])
            ->get();
        $subjectsYear4Sem2 = Subject::where('curriculum', $curriculum)
            ->where('year_level', 4)
            ->where('semester', 2)
            ->with([
                'students' => function ($query) use ($student) {
                    $query->where('students.id', $student->id);
                }
            ])
            ->get();

        $subjectExist = $subjectsYear1Sem1->isNotEmpty() || $subjectsYear1Sem2->isNotEmpty() ||
                        $subjectsYear2Sem1->isNotEmpty() || $subjectsYear2Sem2->isNotEmpty() ||
                        $subjectsYear3Sem1->isNotEmpty() || $subjectsYear3Sem2->isNotEmpty() ||
                        $subjectsYear4Sem1->isNotEmpty() || $subjectsYear4Sem2->isNotEmpty();




        return view('grade.add', compact(
            'subjectExist',
            'student',
            'subjectsYear1Sem1',
            'subjectsYear1Sem2',
            'subjectsYear2Sem1',
            'subjectsYear2Sem2',
            'subjectsYear3Sem1',
            'subjectsYear3Sem2',
            'subjectsYear4Sem1',
            'subjectsYear4Sem2',

        ));
    }

        public function store(Request $request, Student $student)
        {
            $request->validate([
                'midterm.*' => 'nullable|numeric|min:0|max:100',
                'final.*'   => 'nullable|numeric|min:0|max:100',
            ]);

            foreach ($request->midterm as $subjectId => $midtermGrade) {

                $finalGrade = $request->final[$subjectId] ?? null;

                Grade::updateOrCreate(
                    [
                        'student_id' => $student->id,
                        'subject_id' => $subjectId,
                    ],
                    [
                        'midterm' => $midtermGrade,
                        'final'   => $finalGrade,
                    ]
                );
            }

            return redirect('/evaluation/'.$student->id)->with('success', 'Grades saved successfully!');
        }


    public function destroy(Grade $grade)
    {
        //
    }

    public function evaluation(Student $student){
        $student = $student->load('subjects');

        $year1Sem1Subjects = $student->subjects->where('year_level', 1)
        ->where('semester', 1)
        ->where('curriculum', $student->class_batch->curriculum);

        $year1Sem2Subjects = $student->subjects->where('year_level', 1)
            ->where('semester', 2)
            ->where('curriculum', $student->class_batch->curriculum);

        $year2Sem1Subjects = $student->subjects->where('year_level', 2)
            ->where('semester', 1)
            ->where('curriculum', $student->class_batch->curriculum);

        $year2Sem2Subjects = $student->subjects->where('year_level', 2)
            ->where('semester', 2)
            ->where('curriculum', $student->class_batch->curriculum);

        $year3Sem1Subjects = $student->subjects->where('year_level', 3)
            ->where('semester', 1)
            ->where('curriculum', $student->class_batch->curriculum);

        $year3Sem2Subjects = $student->subjects->where('year_level', 3)
            ->where('semester', 2)
            ->where('curriculum', $student->class_batch->curriculum);

        $year4Sem1Subjects = $student->subjects->where('year_level', 4)
            ->where('semester', 1)
            ->where('curriculum', $student->class_batch->curriculum);

        $year4Sem2Subjects = $student->subjects->where('year_level', 4)
            ->where('semester', 2)
            ->where('curriculum', $student->class_batch->curriculum);


        return view('grade.evaluation',compact(
            'student',
            'year1Sem1Subjects',
            'year1Sem2Subjects',
            'year2Sem1Subjects',
            'year2Sem2Subjects',
            'year3Sem1Subjects',
            'year3Sem2Subjects',
            'year4Sem1Subjects',
            'year4Sem2Subjects',

        ));
    }
}
