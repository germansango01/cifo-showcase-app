<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $projectId = $this->route('project')?->id;

        return [
            'course_id' => ['required', 'integer', 'exists:courses,id'],
            'project_date' => ['required', 'date'],
            'title' => ['required', 'array'],
            'title.es' => ['required', 'string', 'max:255'],
            'title.ca' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'array'],
            'description.es' => ['nullable', 'string'],
            'description.ca' => ['nullable', 'string'],
            'thumbnail' => ['nullable', 'file', 'image', 'max:5120'],
            'repo_url' => ['nullable', 'url', 'max:512'],
            'live_url' => ['nullable', 'url', 'max:512'],
            'status' => ['required', 'string', Rule::in(['draft', 'pending', 'published', 'rejected'])],
            'featured' => ['boolean'],
            'published_at' => ['nullable', 'date'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['integer', 'exists:tags,id'],
        ];
    }
}
