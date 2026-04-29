<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'course_code' => ['required', 'string', 'max:50', 'unique:courses,course_code'],
            'name' => ['required', 'array'],
            'name.es' => ['required', 'string', 'max:150'],
            'name.ca' => ['required', 'string', 'max:150'],
        ];
    }
}
