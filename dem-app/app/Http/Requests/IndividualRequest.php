<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndividualRequest extends FormRequest
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
            'addressEstablishment' => 'required|string',
            'signature' => 'required|string',
            'ifHaveRegisterTrade' => 'required|boolean',
            'firstNameRepresentativeLegal' => 'required|string',
            'lastNameRepresentativeLegal' => 'required|string',
            'nationalityRepresentativeLegal' => 'required|string',
            'phoneRepresentativeLegal' => 'required|string',
            'domicilAddressRepresentativeLegal' => 'required|string',
            'emailRepresentativeLegal' => 'required|string',
            'spouseFirstName' => 'required|string',
            'spouseLastName' => 'required|string',
            'weddingDate' => 'required|date',
            'sigle' => 'required|string',
            'denomination' => 'required|string',
            'activities' => 'required|string',
            'marital_option_id' => 'required|exists:marital_options,id',
            'marital_statuse_id' => 'required|exists:marital_statuses,id',
            'marital_regime_id' => 'required|exists:marital_regimes,id',
        ];
    }
}
