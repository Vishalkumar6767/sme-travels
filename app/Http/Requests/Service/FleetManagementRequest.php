<?php

namespace App\Http\Requests\Service;

use Illuminate\Foundation\Http\FormRequest;

class FleetManagementRequest extends FormRequest
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
            'name'=>'required|string',
            'image'=>'required|mimes:png,jpg,gif',
            'description1'=>'required|string',
            'description2'=>'required|string',
            'description3'=>'required|string',
        ];
    }
}
