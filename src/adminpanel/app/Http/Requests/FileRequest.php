<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|unique:courses',
            'name'=> 'required|unique:courses',
            'description'=>'required|min:10',
            'cfile'=>'image|mimes:jpeg,bmp,png|max:2000'
        ];
    }
}
