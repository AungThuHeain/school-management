<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $isUpdate = $this->route()->getName() == 'students.update' ? 'nullable' : 'required';
        return [
            'name'=>['required','string','max:255'],
            'phone'=>['required','string','max:255','unique:users,phone,'.$this->id],
            'email'=>['required','email','unique:users,email,'.$this->id],
            'password'=>[$isUpdate,'min:8'],
            'class_id'=>['required','exists:class_rooms,id'],
        ];
    }
}
