@extends('layouts.master')
@section('title', 'New Registration')
@section('content')
  <h2 class="text-2xl mb-3">New Registration</h2>
  <form method="POST" action="{{ route('registrations.store') }}">@csrf
    <label class="block mb-3">Student
      <select name="student_id" class="border rounded w-full p-2">
        @foreach($students as $s) <option value="{{ $s->id }}">{{ $s->student_number }} - {{ $s->name }}</option> @endforeach
      </select></label>
    <label class="block mb-3">Course
      <select name="course_id" class="border rounded w-full p-2">
        @foreach($courses as $c) <option value="{{ $c->id }}">{{ $c->code }} - {{ $c->title }}</option> @endforeach
      </select></label>
    <button class="bg-blue-600 text-white px-4 py-2 rounded">Register</button>
  </form>
@endsection
