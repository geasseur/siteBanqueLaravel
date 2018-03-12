<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransfertMoneyForMeFormRequest extends FormRequest
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
            'moneyForMe'=>'bail|required|numeric',
            'idDestinataire'=>'required'
        ];
    }

    public function messages(){
        return[
            'moneyForMe.required'=>'vous devez rentrer une somme',
            'moneyForMe.numeric'=>'vous devez rentrer une somme en chiffre',
            'idDestinataire.required'=>'vous n\'avez pas de destinataire'
        ];
    }
}
