<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartnerRequest extends FormRequest
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
        return[
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'profession' => 'required|boolean',
            'tel' => 'required|boolean',
            'email' => 'required|boolean',
            'sas_or_sasu_id' => 'required|exists:sas_or_sasus,id',
        ];
    }
}
