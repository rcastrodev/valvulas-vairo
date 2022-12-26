<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
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
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $array = [];

        if ($this->isMethod('post')) 
            $array['name'] = ['required', 'unique:categories'];

        if ($this->id){
            $array['name'] = ['required', Rule::unique('categories')->ignore($this->id)];
        }
            

        return $array;
    }

    public function messages()
    {
        return [
            'name.required'  => 'El nombre es requerido',
            'name.unique'    => 'El nombre ya se encuentra registrado',
        ];
    }
}
