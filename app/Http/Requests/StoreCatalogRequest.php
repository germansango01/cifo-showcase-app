<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCatalogRequest extends FormRequest
{

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
            'catalog_code' => ['required', 'string', 'max:50', 'unique:catalogs,catalog_code'],
            'isActive' => ['required', 'boolean'],
        ];
    }
}
