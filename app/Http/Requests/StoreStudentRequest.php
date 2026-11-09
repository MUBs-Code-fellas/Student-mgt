<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    } // route is protected by role middleware

    public function rules(): array
    {
        $id = $this->route('student')?->id;
        return [
            'name' => 'required|string|max:100',
            'email' => ['required', 'email', Rule::unique('students', 'email')->ignore($id)],
            'student_number' => [
                'required',
                'string',
                Rule::unique('students', 'student_number')->ignore($id),
            ],
            'phone' => 'nullable|string|max:20',
        ];
    }
}
