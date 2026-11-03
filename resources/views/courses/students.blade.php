@extends('layouts.master')
@section('title', 'Course Students')
@section('content')
  <h2 class="text-2xl">{{ $course->code }}: Registered Students</h2>
  <ul class="list-disc ml-5 mt-3">
    @forelse($course->students as $s) <li>{{ $s->student_number }} - {{ $s->name }}</li> @empty <li>No students yet.</li> @endforelse
  </ul>
@endsection
