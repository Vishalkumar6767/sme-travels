<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'image'=>'mimes:png,jpg,gif',
            'address'=>'required',
            'mobile_1'=>'required',
            'mobile_2'=>'required',
            'mobile_3'=>'required',
            'office_no'=>'required',
            'email'=>'required',
            'facebook'=>'required',
            'instagram'=>'required',
            'youtube'=>'required',
            'linkdin'=>'required',
        ];
    }
}
