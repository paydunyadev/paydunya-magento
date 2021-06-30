<?php

namespace App\Http\Resources;

use App\Models\Entreprise;
use App\Models\MaritalOption;
use App\Models\MaritalRegime;
use App\Models\MaritalStatus;
use Illuminate\Http\Resources\Json\JsonResource;

class IndividualResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'addressEstablishment' => $this->addressEstablishment,
            'ifHaveRegisterTrade' => $this->ifHaveRegisterTrade,
            'firstNameRepresentativeLegal' => $this->firstNameRepresentativeLegal,
            'lastNameRepresentativeLegal' => $this->lastNameRepresentativeLegal,
            'nationalityRepresentativeLegal' => $this->nationalityRepresentativeLegal,
            'phoneRepresentativeLegal' => $this->phoneRepresentativeLegal,
            'domicilAddressRepresentativeLegal' => $this->domicilAddressRepresentativeLegal,
            'emailRepresentativeLegal' => $this->emailRepresentativeLegal,
            'spouseFirstName' => $this->spouseFirstName,
            'spouseLastName' => $this->spouseLastName,
            'weddingDate' => $this->weddingDate,
            'isSgn' => $this->isSgn,
            'depositDate' => $this->depositDate,
            'signature' => $this->signature,
            'entreprise' => new EntrepriseResource(Entreprise::findOrFail($this->entreprise_id)),
            'marital_option' => new MaritalOptionResource(MaritalOption::findOrFail($this->marital_option_id)),
            'marital_statuse' => new MaritalStatusResource(MaritalStatus::findOrFail($this->marital_statuse_id)),
            'marital_regime' => new MaritalRegimeResource(MaritalRegime::findOrFail($this->marital_regime_id)),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

}
