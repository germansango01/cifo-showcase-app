<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeacherRequest extends FormRequest
{
    public function authorize(): bool
    {
        // return Gate::allows('teachers.create');
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100','min:3'],
            'email' => ['required',  'regex:/^[A-Za-z0-9._%+-]{3,}@[A-Za-z0-9]{2,}(\.[A-Za-z]{2,})+$/', 'max:150', 'unique:teachers,email'],
        ];
    }
}
