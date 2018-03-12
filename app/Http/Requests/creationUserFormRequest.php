<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class creationUserFormRequest extends FormRequest
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
            'pseudoCreation'=>'required',
            'passwordCreation'=>'required',
            'mailCreation'=>'required|email'
        ];
    }

    public function messages()
    {
      return[
        'pseudoCreation.required'=>'vous devez rentrer votre nom',
        'passwordCreation.required'=>'vous devez rentrer votre mot de passe',
        'mailCreation.required'=>'vous devez fournir un mail',
        'mailCreation.email'=>'vous devez fournir une adresse mail valide'
      ];
    }
}
