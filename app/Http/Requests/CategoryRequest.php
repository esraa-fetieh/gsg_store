<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>['required',
            'string',
            'max:255',
            'min:5',
            function($attribute,$value,$fail){
                if(stripos($value,'god')!==false){
                    $fail('you can not use "god" word in your input');
                }

            }

               ],
            'parent_id'=>'nullable|int|exists:categories,id',
            'description'=>'nullable|min:5',
            'status'=>'required|in:active,draft',
            'image'=>'image|max:512000|dimensions:min_width=300,min_height=300'

        ];
    }
    public function messages(){
        return [
            'required'=>'حقل :attribute مطلوب',
        ];
    }
}
