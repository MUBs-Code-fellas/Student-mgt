@extends('layouts.master')
@section('title', 'Edit Student')
@section('content')
  <h2 class="text-2xl mb-3">Edit Student</h2>
  <form method="POST" action="{{ route('students.update', $student) }}">@method('PUT') @include('students._form')</form>
@endsection
