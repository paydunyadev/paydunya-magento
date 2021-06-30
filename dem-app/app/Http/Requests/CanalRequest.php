<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CanalRequest extends FormRequest
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
            'placeOfBirthDay'=> 'required|string',
            'nationality'=> 'required|string',
            'installationAddress'=> 'required|string',
            'billingAddress'=> 'required|string',
            'homeTel'=> 'required|string',
            'port'=> 'required|string',
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
            'type_canal_id' => 'required|exists:type_canals,id',
        ];
    }
}
