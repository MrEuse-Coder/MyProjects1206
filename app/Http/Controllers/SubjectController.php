<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $subjects = Subject::orderBy('curriculum')
            ->when($request->search_subject, function ($query, $requestValue) {
                $query->where('descriptive_title', 'like', "{$requestValue}%");
            })
            ->paginate(10);


        return view('subject.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('subject.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $attrs = $request->validate([
            'course_code' => 'required',
            'descriptive_title' => 'required',
            'total_units' => 'required',
            'lec_units' => 'required',
            'lab_units' => 'required',
            'hours_week' => 'required',
            'pre_requisite' => 'required',
            'year_level' => 'required',
            'semester' => 'required',
            'curriculum' => 'required',
        ]);

        Subject::create($attrs);

        return redirect('/subject/create')->withInput()->with('success', 'Subject created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        //
        return view('subject.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        //
        $attrs = $request->validate([
            'course_code' => 'required',
            'descriptive_title' => 'required',
            'total_units' => 'required',
            'lec_units' => 'required',
            'lab_units' => 'required',
            'hours_week' => 'required',
            'pre_requisite' => 'required',
            'year_level' => 'required',
            'semester' => 'required',
            'curriculum' => 'required',
        ]);

        $subject->update($attrs);
        return redirect('/subjects')->with('success', 'Subject updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        //
        $subject->delete();
        return redirect('/subjects');
    }
}
