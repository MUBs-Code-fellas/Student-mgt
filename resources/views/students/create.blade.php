@extends ('layouts.master')
@section ('title', 'Add Student')
@section ('content')
    <h2 class="text-2xl mb-3">Add Student</h2>
    <form method="POST" action="{{ route('students.store') }}">@include ('students._form')</form>
@endsection
