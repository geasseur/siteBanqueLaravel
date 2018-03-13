<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class indexConnexionFormRequest extends FormRequest
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
            'pseudoConnexion'=>'required',
            'passwordConnexion'=>'required'
        ];
    }

    public function messages(){
      return[
        'pseudoConnexion.required'=>'vous devez rentrer votre nom',
        'passwordConnexion.required'=>'vous devez rentrer votre mot de passe'
      ];
    }
}
