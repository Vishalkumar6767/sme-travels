<?php

namespace App\Http\Requests\Home;

use Illuminate\Foundation\Http\FormRequest;

class WhyRequest extends FormRequest
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
           'image'=>'required|mimes:png,jpg,gif',
           'description'=>'required',
           'title1'=>'required|string',
           'description1'=>'required',
           'title2'=>'required',
           'description2'=>'required',
           'title3'=>'required|string',
           'description3'=>'required',
           'title4'=>'required',
           'description4'=>'required',
           'title5'=>'required|string',
           'description5'=>'required'
        ];
    }
}
