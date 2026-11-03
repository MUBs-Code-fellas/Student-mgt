@csrf
@foreach(['student_number' => 'Student Number', 'name' => 'Name', 'email' => 'Email', 'phone' => 'Phone'] as $field => $label)
  <label class="block mt-3">{{ $label }}
    <input name="{{ $field }}" value="{{ old($field, $student->$field ?? '') }}" class="border rounded w-full p-2">
  </label>
@endforeach
<button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded">Save</button>
