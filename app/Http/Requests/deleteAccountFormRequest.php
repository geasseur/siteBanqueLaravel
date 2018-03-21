<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class deleteAccountFormRequest extends FormRequest
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
    //  dd(request('validationDelete'));
        return [
            'validationDelete'=>'accepted'
        ];
    }

    public function messages()
    {
        return[
            'validationDelete.accepted'=>'vous devez cocher la case oui pour effacer ce compte'
      ];
    }
}
