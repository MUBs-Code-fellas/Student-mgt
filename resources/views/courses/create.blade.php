@extends ('layouts.master')
@section ('title', 'Add Course')
@section ('content')
    <h2 class="text-2xl mb-3">Add Course</h2>
    <form method="POST" action="{{ route('courses.store') }}">@include ('courses._form')</form>
@endsection
