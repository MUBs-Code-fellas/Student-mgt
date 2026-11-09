<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $query = Course::with('lecturer')->withCount('students')->orderBy('code');

        if ($user->hasRole('Lecturer')) {
            $query->where('lecturer_id', $user->id); // lecturers see only assigned courses
        }

        $registeredIds = collect();
        if ($user->hasRole('Student') && $user->student) {
            $registeredIds = $user->student->courses()->pluck('courses.id');
        }

        return view('courses.index', [
            'courses' => $query->paginate(10),
            'registeredIds' => $registeredIds,
        ]);
    }

    public function create()
    {
        return view('courses.create', ['lecturers' => User::role('Lecturer')->get()]);
    }

    public function store(Request $request)
    {
        Course::create($this->validated($request));
        return redirect()->route('courses.index')->with('success', 'Course created.');
    }

    public function edit(Course $course)
    {
        return view('courses.edit', [
            'course' => $course,
            'lecturers' => User::role('Lecturer')->get(),
        ]);
    }

    public function update(Request $request, Course $course)
    {
        $course->update($this->validated($request, $course->id));
        return redirect()->route('courses.index')->with('success', 'Course updated.');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Course deleted.');
    }

    public function students(Course $course)
    {
        $user = auth()->user();
        abort_unless($user->hasRole('Administrator') || $course->lecturer_id === $user->id, 403);
        return view('courses.students', ['course' => $course->load('students')]);
    }

    private function validated(Request $r, $id = null): array
    {
        return $r->validate([
            'code' => [
                'required',
                'string',
                'max:20',
                Rule::unique('courses', 'code')->ignore($id),
            ],
            'title' => 'required|string|max:150',
            'description' => 'nullable|string',
            'credits' => 'required|integer|min:1|max:10',
            'lecturer_id' => 'nullable|exists:users,id',
        ]);
    }
}
