@extends ('layouts.master')
@section ('title', 'Registrations')
@section ('content')
    <div class="flex justify-between mb-4">
        <h2 class="text-2xl font-semibold">Registrations</h2>
        @can ('manage registrations')
            <a
                href="{{ route('registrations.create') }}"
                class="bg-blue-600 text-white px-3 py-1 rounded"
                >New Registration</a
            >
        @endcan
    </div>
    <table class="w-full bg-white shadow rounded text-left">
        <tr class="border-b">
            <th class="p-2">Student</th>
            <th>Course</th>
            <th>Date</th>
            <th></th>
        </tr>
        @foreach ($registrations as $r)
            <tr class="border-b">
                <td class="p-2">{{ $r->student->name }}</td>
                <td>{{ $r->course->code }} - {{ $r->course->title }}</td>
                <td>{{ $r->created_at->format('d M Y') }}</td>
                <td>
                    <form
                        method="POST"
                        action="{{ route('registrations.destroy', $r) }}"
                        onsubmit="return confirm('Remove registration?');"
                    >
                        @csrf
                        @method ('DELETE')
                        <button class="text-red-600">Remove</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <div class="mt-3">{{ $registrations->links() }}</div>
@endsection
