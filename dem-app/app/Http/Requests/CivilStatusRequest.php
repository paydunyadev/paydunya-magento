<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CivilStatusRequest extends FormRequest
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
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'passportNumber' => 'required|string',
            'dateOfBirth' => 'required|date',
            'dateOfDeleverancePassport' => 'required|date',
            'placeOfBirth' => 'required|string',
            'numberCni' => 'required|string',
            'profession' => 'required|string',
            'nationality' => 'required|string',
            'physicalAddress' => 'required|string',
            'tel' => 'required|string',
            'email' => 'required|string',
            'marital_regime_id' => 'required|exists:marital_regimes,id',
            'marital_statuse_id' => 'required|exists:marital_statuses,id',
            'request_id' => 'required|exists:requests,id',
            'scanIdentityPiece' => 'required|file',
            'scanCertificatWendding' => 'file',
        ];
    }
}
