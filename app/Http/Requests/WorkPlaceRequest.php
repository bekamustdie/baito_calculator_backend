<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkPlaceRequest extends FormRequest
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
            "name"=>"required|string|min:1",
            "color"=> "required|string|min:1",
            "hour_pay"=> "sometimes|decimal:8,2|min:1",
            'note'=> "sometimes|string|min:1",
            'is_active'=>'sometime|boolean'     
        ];
    }
}
