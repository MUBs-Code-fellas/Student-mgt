@extends ('layouts.master')
@section ('title', 'Courses')
@section ('content')
    <div class="flex justify-between mb-4">
        <h2 class="text-2xl font-semibold">Courses</h2>
        @can ('manage courses')
            <a href="{{ route('courses.create') }}" class="bg-blue-600 text-white px-3 py-1 rounded"
                >Add Course</a
            >
        @endcan
    </div>
    <table class="w-full bg-white shadow rounded text-left">
        <tr class="border-b">
            <th class="p-2">Code</th>
            <th>Title</th>
            <th>Lecturer</th>
            <th>Students</th>
            <th>Actions</th>
        </tr>
        @foreach ($courses as $c)
            <tr class="border-b">
                <td class="p-2">{{ $c->code }}</td>
                <td>{{ $c->title }}</td>
                <td>{{ $c->lecturer->name ?? '-' }}</td>
                <td>{{ $c->students_count }}</td>
                <td class="flex gap-2 p-2">
                    @canany (['view assigned courses', 'manage courses'])
                        <a href="{{ route('courses.students', $c) }}" class="text-blue-600"
                            >Students</a
                        >
                    @endcanany
                    @can ('manage courses')
                        <a href="{{ route('courses.edit', $c) }}" class="text-yellow-600">Edit</a>
                        <form
                            method="POST"
                            action="{{ route('courses.destroy', $c) }}"
                            onsubmit="return confirm('Delete this course?');"
                        >
                            @csrf
                            @method ('DELETE')
                            <button class="text-red-600">Delete</button>
                        </form>
                    @endcan
                    @can ('register course')
                        @if ($registeredIds->contains($c->id))
                            <span class="text-green-700">Registered</span>
                        @else
                            <form method="POST" action="{{ route('courses.register', $c) }}">
                                @csrf
                                <button class="text-blue-600">Register</button>
                            </form>
                        @endif
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>
    <div class="mt-3">{{ $courses->links() }}</div>
@endsection
