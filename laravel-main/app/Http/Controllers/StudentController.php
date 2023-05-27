<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index(): View
    {
        $students = Student::all();
        return view('student.index', ['students' => $students]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $this->authorize('create', Student::class);

        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): View
    {
        $this->authorize('create', Student::class);

        $validated = $request->validate([
            'name' => 'required|max:255',
            'course' => 'required|numeric|min:0',
            'speciality' => 'required|numeric|min:0',
        ]);

        if ($validated) {
            $student = Student::create(
                $request->all(['name', 'course', 'speciaity'])
            );
        }
        return view(
            'student.store',
            ['student' => $student]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $student = Student::find($id);
        if (!isset($student))
        {
            return abort(404);
        }
        return view('student.show', ['student' => $student]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $student = Student::find($id);
        if (!isset($student))
        {
            return abort(404);
        }

        $this->authorize('update', $student);

        return view(
            'student.edit',
            ['student' => $student]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): View
    {
        $student = Student::find($id);
        if (!isset($student))
        {
            return abort(404);
        }

        $this->authorize('update', $student);

        $validated = $request->validate([
            'name' => 'required|max:255',
            'course' => 'required|numeric|min:0',
            'speciality' => 'required|numeric|min:0',
        ]);
        if ($validated) {
            $student->name = $request->input('name');
            $student->course = $request->input('course');
            $student->speciality = $request->input('speciality');
            $student->save();
        }
        return view('student.update', ['student' => $student]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): View
    {
        $student = Student::find($id);
        if (!isset($student))
        {
            return abort(404);
        }

        $this->authorize('delete', $student);

        $student->delete();
        return view('student.destroy', ['student' => $student]);
    }
}