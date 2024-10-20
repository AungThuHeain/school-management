<?php

namespace App\Http\Requests;

use App\Rules\CheckTime;
use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
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
        return [
           'name' => ['required','string','max:255'],
           'check_in' => ['required',new CheckTime],
           'check_out' =>  ['required','after:check_in',new CheckTime],
           'classes' => ['required'],
        ];
    }
}
