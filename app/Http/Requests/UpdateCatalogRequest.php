<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCatalogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'course_id' => ['required', 'integer', 'exists:courses,id'],
            'year' => ['required', 'integer', 'max:' . date('Y'),],
            'cycle' => ['required', 'string', Rule::in(['morning', 'afternoon']),],
            'catalog_code' => ['required', 'string', 'max:50', Rule::unique('catalogs', 'catalog_code')->ignore($this->catalog)],
            'isActive' => ['required', 'boolean'],
        ];
    }
}
