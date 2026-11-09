@extends ('layouts.master')
@section ('title', 'Dashboard')
@section ('content')
    <h2 class="text-2xl font-semibold">Welcome, {{ auth()->user()->name }}</h2>
    <p class="text-gray-600 mb-4">Role: {{ auth()->user()->getRoleNames()->first() }}</p>
    @role ('Administrator')
        <p>Manage students, courses and registrations from the menu.</p>
    @endrole
    @role ('Lecturer')
        <p>Open <b>Courses</b> to see your assigned courses and their registered students.</p>
    @endrole
    @role ('Student')
        <p>Open <b>Courses</b> to register, or <b>Registrations</b> to see your courses.</p>
    @endrole
@endsection
