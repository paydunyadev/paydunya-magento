<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CounterElectricityRequest extends FormRequest
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
            'neighbourTakenNumber'=> 'required|string',
            'identity_piece_id'=> 'required|string',
            'type_inscription_id'=> 'required|string',
            'caracteristique_technique_id'=> 'required|string',
            'oldAddress' => 'required|string',
            'oldPolice' => 'required|string',
            'haveCompteBanque' => 'required|boolean',
            'banqueName' => 'required|string',
            'banqueCompteNumber' => 'required|string',
            'invoice' => 'required|string',
            'brighFirePlaceNumber' => 'required|string',
            'fridgeNumber' => 'required|string',
            'tvNumber' => 'required|string',
            'freezerNumber' => 'required|string',
            'waterHeaterNumber' => 'required|string',
            'fanNumber' => 'required|string',
            'airConditionerNumber' => 'required|string',
            'ironNumber' => 'required|string',
            'washingMachineNumber' => 'required|string',
            'compteNumber' => 'required|string',
            'moterAndVariousNumber' => 'required|string',
            'computerNumber' => 'required|string',
            'costomerSignature' => 'required|string',
            'type_local_id' => 'required|exists:type_locals,id',
            'type_conter_id' => 'required|exists:type_conters,id',
        ];
    }
}


