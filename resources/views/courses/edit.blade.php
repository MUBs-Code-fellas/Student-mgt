@extends('layouts.master')
@section('title', 'Edit Course')
@section('content')
  <h2 class="text-2xl mb-3">Edit Course</h2>
  <form method="POST" action="{{ route('courses.update', $course) }}">@method('PUT') @include('courses._form')</form>
@endsection
