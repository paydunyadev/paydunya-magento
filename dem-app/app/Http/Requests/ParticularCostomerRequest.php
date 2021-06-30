<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParticularCostomerRequest extends FormRequest
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
            'ownerFirstName' => 'required|string',
            'ownerLastName' => 'required|string',
            'representatativeLastName'=> 'required|string',
            'representatativeFirstName'=> 'required|string',
            'dateBirthDay'=> 'required|string',
            'placeOfBirthDay'=> 'required|string',
            'nationality'=> 'required|string',
            'installationAddress'=> 'required|string',
            'billingAddress'=> 'required|string',
            'homeTel'=> 'required|string',
            'port'=> 'required|string',
            'profession'=> 'required|string',
            'email'=> 'required|string',
            'employerName'=> 'required|string',
            'professionalAddress'=> 'required|string',
            'oficeTel'=> 'required|string',
            'tel'=> 'required|string',
            'photoIdentityPiece'=> 'required|file',
            'numberIdentityPiece'=> 'required|string',
            'neighbourName'=> 'required|string',
            'neighbourTakenNumber'=> 'required|string',
            'accepteToReceiveInfoSonatel'=> 'required|boolean',
            'accepteToReceiveInfoPartnerSonatel'=> 'required|boolean',
            'tel_costomer'=> 'required|string',
            'email_costomer'=> 'required|string',
            'faxNumber'=> 'required|string',
            'receiveInvoiceInFormatElectronic'=> 'required|boolean',
            'signature'=> 'required|string',
            'dateSignature'=> 'required|string',
            'palaceSignature'=> 'required|string',
            'wifi_orange_id'=> 'required|string',
            'identity_piece_id'=> 'required|exists:identity_pieces,id',
            'type_inscription_id'=> 'required|exists:type_inscriptions,id',
            'caracteristique_technique_id'=> 'required|exists:caracteristique_techniques,id',
        ];
    }
}

