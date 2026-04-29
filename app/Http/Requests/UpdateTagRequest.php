<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTagRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $tagId = $this->route('tag')?->id;

        return [
            'name' => ['required', 'array'],
            'name.es' => ['required', 'string', 'max:150', Rule::unique('tags', 'name->es')->ignore($tagId)],
            'name.ca' => ['required', 'string', 'max:150', Rule::unique('tags', 'name->ca')->ignore($tagId)],
        ];
    }
}
