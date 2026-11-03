@csrf
@foreach(['code' => 'Course Code', 'title' => 'Title', 'credits' => 'Credits'] as $field => $label)
  <label class="block mt-3">{{ $label }}
    <input name="{{ $field }}" value="{{ old($field, $course->$field ?? ($field === 'credits' ? 3 : '')) }}" class="border rounded w-full p-2">
  </label>
@endforeach
<label class="block mt-3">Description
  <textarea name="description" class="border rounded w-full p-2">{{ old('description', $course->description ?? '') }}</textarea>
</label>
<label class="block mt-3">Lecturer
  <select name="lecturer_id" class="border rounded w-full p-2">
    <option value="">-- none --</option>
    @foreach($lecturers as $l)
      <option value="{{ $l->id }}" @selected(old('lecturer_id', $course->lecturer_id ?? null) == $l->id)>{{ $l->name }}</option>
    @endforeach
  </select>
</label>
<button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded">Save</button>
