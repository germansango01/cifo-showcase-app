<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => ['required', 'string', Rule::in(['image', 'video', 'document', 'pdf'])],
            'file' => ['nullable', 'file', 'max:10240'],
            'alt_text' => ['nullable', 'array'],
            'alt_text.es' => ['nullable', 'string', 'max:255'],
            'alt_text.ca' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
