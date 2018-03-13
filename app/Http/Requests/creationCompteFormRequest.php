<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class creationCompteFormRequest extends FormRequest
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
          'newAccount'=>Rule::exists('Comptes')->where('type_account', request('typeCompte'))->where('idUser',request('idUser'))->first();
        }),
      }),
        ];
    }
}
