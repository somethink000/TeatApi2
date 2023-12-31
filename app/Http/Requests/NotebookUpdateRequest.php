<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotebookUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {

        return [
            'name' => 'string',
            'company' => 'string',
            //'phone' => ,
            'email' => 'email',
            'birthday' => 'date',
            'image' => 'nullable|max:5000|image:jpg, jpeg, png',
        ];
    }
}
