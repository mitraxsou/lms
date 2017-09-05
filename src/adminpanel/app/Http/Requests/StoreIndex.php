<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreIndex extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
             $course = $request->courseid;
            $rules=[
                'index' => [
                    'required',
                    Rule::exists('course_details','index_id')->where(function ($query) use ($course){
                        $query -> where('course_id', $course); 
                    }),
                ],
                'modulename' => 'required',
                'description' => 'required',
                'url' => 'required'
            ];
        ];
    }
}
