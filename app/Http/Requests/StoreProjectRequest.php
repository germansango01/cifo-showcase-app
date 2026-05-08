<?php

namespace App\Http\Requests;

use App\Enums\ProjectFileType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'course_id' => ['required', 'integer', 'exists:courses,id'],
            'project_date' => ['required', 'string', 'regex:/^\d{4}-(0[1-9]|1[0-2])$/'],
            'title' => ['required', 'array'],
            'title.es' => ['required', 'string', 'max:255'],
            'title.ca' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'array'],
            'description.es' => ['nullable', 'string'],
            'description.ca' => ['nullable', 'string'],
            'images' => ['required', 'array', 'min:1', 'max:8'],
            'images.*' => ['file', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'featured_media' => ['nullable', 'string'],
            'repo_url' => ['nullable', 'url', 'max:512'],
            'live_url' => ['nullable', 'url', 'max:512'],
            'status' => ['required', 'string', Rule::in(['draft', 'pending', 'published', 'rejected'])],
            'featured' => ['boolean'],
            'students' => ['nullable', 'array'],
            'students.*' => ['integer', 'exists:students,id'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['integer', 'exists:tags,id'],
            'files' => ['nullable', 'array'],
            'files.*.type' => ['required', Rule::enum(ProjectFileType::class)],
            'files.*.url' => ['required', 'url:http,https', 'max:1024'],
            'files.*.label' => ['nullable', 'array'],
            'files.*.label.es' => ['nullable', 'string', 'max:255'],
            'files.*.label.ca' => ['nullable', 'string', 'max:255'],
            'files.*.sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
