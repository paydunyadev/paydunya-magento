<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DomesticatedConnectionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
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
            'profession'=> 'required|string',
            'email'=> 'required|string',
            'port'=> 'required|string',
            'employerName'=> 'required|string',
            'professionalAddress'=> 'required|string',
            'oficeTel'=> 'required|string',
            'tel'=> 'required|string',
            'photoIdentityPiece'=> 'required|file',
            'numberIdentityPiece'=> 'required|string',
            'neighbourName'=> 'required|string',
            'numberWaterPoint'=> 'required|string',
            'numberBathroomSink'=> 'required|string',
            'numberFaucet'=> 'required|string',
            'numberSink'=> 'required|string',
            'numberBathTub'=> 'required|string',
            'numberUrinal'=> 'required|string',
            'numberBidet'=> 'required|string',
            'numberWc'=> 'required|string',
            'numberLavoir'=> 'required|string',
            'gardenSurface'=> 'required|string',
            'attachement'=> 'required|string',
            'neighbourTakenNumber'=> 'required|string',
            'identity_piece_id'=> 'required|string',
            'type_inscription_id'=> 'required|string',
            'caracteristique_technique_id'=> 'required|string',
        ];
    }
}


