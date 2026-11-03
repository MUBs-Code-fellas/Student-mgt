<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Registration;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegistrationController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->hasRole('Administrator')) {
            $registrations = Registration::with(['student', 'course'])->latest()->paginate(10);
        } elseif ($user->hasRole('Student')) {
            abort_unless($user->student, 403);
            $registrations = Registration::with(['student', 'course'])->where('student_id', $user->student->id)->latest()->paginate(10);
        } else {
            abort(403);
        }
        return view('registrations.index', compact('registrations'));
    }

    public function create()
    {
        return view('registrations.create', ['students' => Student::orderBy('name')->get(), 'courses' => Course::orderBy('code')->get()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => ['required', 'exists:courses,id',
                Rule::unique('registrations')->where(fn ($q) => $q->where('student_id', $request->student_id))],
        ], ['course_id.unique' => 'This student is already registered for that course.']);

        Registration::create($data);
        return redirect()->route('registrations.index')->with('success', 'Registration added.');
    }

    public function register(Course $course)
    {
        $student = auth()->user()->student;
        if (!$student) return back()->with('error', 'No student profile is linked to your account.');

        if ($student->courses()->where('courses.id', $course->id)->exists()) {
            return back()->with('error', 'You are already registered for this course.');
        }
        $student->courses()->attach($course->id);
        return back()->with('success', 'Registered for '.$course->title.'.');
    }

    public function destroy(Registration $registration)
    {
        $user = auth()->user();
        $own = $user->student && $registration->student_id === $user->student->id;
        abort_unless($user->hasRole('Administrator') || $own, 403);
        $registration->delete();
        return back()->with('success', 'Registration removed.');
    }
}
