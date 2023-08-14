<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotebookStoreRequest extends FormRequest
{
  
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'company' => ['required', 'string'],
            'phone' => ['required'],
            'email' => ['required', 'email'],
            'birthday' => ['required'],
            'image' => ['required','image:jpg, jpeg, png'],
        ];
    }
}
