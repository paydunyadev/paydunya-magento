<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SarlSuarlRequest extends FormRequest
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
            'duration' => 'required|string',
            'capitalSocial' => 'required|string',
            'apport' => 'required|string',
            'numerical' => 'required|string',
            'nature' => 'required|string',
            'part' => 'required|string',
            'action' => 'required|string',
            'capitalAllocation' => 'required|string',
            'sigle' => 'required|string',
            'denomination' => 'required|string',
            'activities' => 'required|string',
            'socialSiege' => 'required|string',
            'generalAdministrator' => 'required|string',
            'deputyGeneralAdminitrator' => 'required|string',
            'tel' => 'required|string',
            'holder' => 'required|string',
            'substitude' => 'required|string',
        ];
    }
}

