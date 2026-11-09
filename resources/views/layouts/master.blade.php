<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>
        @yield ('title', 'Student Management')
        | SMS
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <header class="bg-blue-800 text-white p-4 flex justify-between items-center">
        <h1 class="text-xl font-bold">Student Management System</h1>
        @auth
            <form method="POST" action="{{ route('logout') }}" class="text-sm">
                @csrf
                <span class="mr-3"
                    >{{ auth()->user()->name }} ({{ auth()->user()->getRoleNames()->first() }})</span
                >
                <button class="underline">Logout</button>
            </form>
        @endauth
    </header>

    @auth
        <nav class="bg-blue-600 text-white px-4 py-2 flex flex-wrap gap-4">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            @can ('manage students')
                <a href="{{ route('students.index') }}">Students</a>
            @endcan
            @canany (['view courses', 'view assigned courses', 'manage courses'])
                <a href="{{ route('courses.index') }}">Courses</a>
            @endcanany
            @canany (['manage registrations', 'view own registrations'])
                <a href="{{ route('registrations.index') }}">Registrations</a>
            @endcanany
        </nav>
    @endauth

    <main class="flex-1 max-w-5xl w-full mx-auto p-6">
        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-3 mb-4 rounded">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 text-red-800 p-3 mb-4 rounded">{{ session('error') }}</div>
        @endif
        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-3 mb-4 rounded">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield ('content')
    </main>

    <footer class="bg-gray-800 text-gray-300 text-center p-3 text-sm">
        &copy; {{ date('Y') }} MUBS Student Management System
    </footer>
</body>
</html>
