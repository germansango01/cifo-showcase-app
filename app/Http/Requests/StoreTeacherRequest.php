<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreTeacherRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('teachers.create');
    }

    public function rules(): array
    {
        return [
            'name'  => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150', 'unique:teachers,email'],
        ];
    }
}