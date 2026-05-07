<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProjectFileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'project_id' => ['required', 'integer', 'exists:projects,id'],
            'type' => ['required', 'string', Rule::in([
                'link', 'pdf', 'document', 'spreadsheet', 'presentation',
                'markdown', 'image', 'video', 'archive', 'code', 'other',
            ])],
            'url' => ['required', 'url:http,https', 'max:1024'],
            'label' => ['nullable', 'array'],
            'label.es' => ['nullable', 'string', 'max:255'],
            'label.ca' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
