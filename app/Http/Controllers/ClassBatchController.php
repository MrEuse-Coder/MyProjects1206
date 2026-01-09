<?php

namespace App\Http\Controllers;

use App\Models\ClassBatch;
use Illuminate\Http\Request;

class ClassBatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //for the dropdown list of class year batches
        $classSchoolYears = ClassBatch::select('school_year')->distinct()->orderBy('school_year')->pluck('school_year');

        //counting no. of students
        //getting the value of the dropdown and query it
        $classBatches = ClassBatch::withCount('students')->when($request->filled('school_year'), function ($query) use ($request) {$query->where('school_year', $request->school_year);
        });

        //get the filtered class batches
        $classBatches = $classBatches->get();

        return view('class_batch.index', compact('classBatches',  'classSchoolYears'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('class_batch.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $attrs = $request->validate([
            'batch_name' => 'required',
            'school_year' => 'required',
            'adviser' => 'required',
            'curriculum' => 'required',
        ]);

        ClassBatch::create($attrs);

        return redirect('/class_batch')->with('success', 'Batch created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClassBatch $classBatch)
    {
        //
        foreach ($classBatch->students as $student) {
            $student->grades()->delete();
        }

        $classBatch->students()->delete();
        $classBatch->delete();
        return redirect('/class_batch')->with('success', 'Batch deleted');
    }
}
