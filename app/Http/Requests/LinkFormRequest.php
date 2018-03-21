<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LinkFormRequest extends FormRequest
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
      //$owner = $this->route('owner');
      return [
          'nameUser'=>'bail|required'
      ];
    }

    public function messages(){
        return[
            'nameUser.required'=>'vous devez rentrer un nom utilisateur'
        ];
    }
}
