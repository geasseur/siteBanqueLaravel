<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewMoneyFormRequest extends FormRequest
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
            'newMoney'=>'required|numeric'
        ];
    }

    public function messages(){
        return[
            'newMoney.required'=>'vous devez rentrer une somme',
            'newMoney.numeric'=>'vous devez rentrer une somme en chiffre'
      ];
    }
}
