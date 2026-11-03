@extends('layouts.master')
@section('title', 'Students')
@section('content')
  <div class="flex justify-between mb-4">
    <h2 class="text-2xl font-semibold">Students</h2>
    @can('manage students') <a href="{{ route('students.create') }}" class="bg-blue-600 text-white px-3 py-1 rounded">Add Student</a> @endcan
  </div>
  <table class="w-full bg-white shadow rounded text-left">
    <tr class="border-b"><th class="p-2">No.</th><th>Name</th><th>Email</th><th>Courses</th><th>Actions</th></tr>
    @foreach($students as $s)
    <tr class="border-b">
      <td class="p-2">{{ $s->student_number }}</td><td>{{ $s->name }}</td><td>{{ $s->email }}</td><td>{{ $s->courses_count }}</td>
      <td class="flex gap-2 p-2">
        <a href="{{ route('students.show', $s) }}" class="text-blue-600">View</a>
        @can('manage students')
          <a href="{{ route('students.edit', $s) }}" class="text-yellow-600">Edit</a>
          <form method="POST" action="{{ route('students.destroy', $s) }}" onsubmit="return confirm('Delete this student?')">@csrf @method('DELETE')
            <button class="text-red-600">Delete</button></form>
        @endcan
      </td>
    </tr>
    @endforeach
  </table>
  <div class="mt-3">{{ $students->links() }}</div>
@endsection
