<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'course_code' => ['required', 'string', 'max:50', Rule::unique('courses', 'course_code')->ignore($this->course)],
            'name' => ['required', 'array'],
            'name.es' => ['required', 'string', 'max:150'],
            'name.ca' => ['required', 'string', 'max:150'],
        ];
    }
}
