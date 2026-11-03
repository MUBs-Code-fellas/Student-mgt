<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        return view('students.index', ['students' => Student::withCount('courses')->orderBy('student_number')->paginate(10)]);
    }

    public function create() { return view('students.create'); }

    public function store(StoreStudentRequest $request)
    {
        DB::transaction(function () use ($request) {
            $user = User::create(['name' => $request->name, 'email' => $request->email, 'password' => Hash::make('password')]);
            $user->assignRole('Student');
            Student::create($request->validated() + ['user_id' => $user->id]);
        });
        return redirect()->route('students.index')->with('success', 'Student created (default password: password).');
    }

    public function show(Student $student)
    {
        return view('students.show', ['student' => $student->load('courses')]);
    }

    public function edit(Student $student) { return view('students.edit', compact('student')); }

    public function update(StoreStudentRequest $request, Student $student)
    {
        $student->update($request->validated());
        $student->user?->update(['name' => $request->name, 'email' => $request->email]);
        return redirect()->route('students.index')->with('success', 'Student updated.');
    }

    public function destroy(Student $student)
    {
        $user = $student->user;
        $student->delete();
        $user?->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted.');
    }
}
