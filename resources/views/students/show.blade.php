@extends ('layouts.master')
@section ('title', $student->name)
@section ('content')
    <h2 class="text-2xl">{{ $student->name }} ({{ $student->student_number }})</h2>
    <p class="text-gray-600">{{ $student->email }}</p>
    <h3 class="mt-4 font-semibold">Registered Courses</h3>
    <ul class="list-disc ml-5">
        @forelse ($student->courses as $c)
            <li>{{ $c->code }} - {{ $c->title }}</li>
        @empty
            <li>None</li>
        @endforelse
    </ul>
@endsection
