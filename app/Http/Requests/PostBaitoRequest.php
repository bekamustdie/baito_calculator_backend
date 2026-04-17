<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostBaitoRequest extends FormRequest
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
            'title'=>'string|required|min:4',
            'date'=>'required|date',
            'start_time'=>'required|date_format:H:i',
            'end_time'=>'required|date_format:H:i',
            'note'=>'sometimes|string|min:2',
            'actual_work_hours'=>'sometimes|integer|min:1',
            'hour_pay'=>'sometimes|integer|min:1'
        ];
    }
}
