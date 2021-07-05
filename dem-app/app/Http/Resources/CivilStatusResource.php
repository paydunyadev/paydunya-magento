<?php

namespace App\Http\Resources;

use App\Models\MaritalRegime;
use App\Models\MaritalStatus;
use Illuminate\Http\Resources\Json\JsonResource;

class CivilStatusResource extends JsonResource
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
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'passportNumber' => $this->passportNumber,
            'dateOfBirth' => $this->dateOfBirth,
            'dateOfDeleverancePassport' => $this->dateOfDeleverancePassport,
            'placeOfBirth' => $this->placeOfBirth,
            'numberCni' => $this->numberCni,
            'profession' => $this->profession,
            'nationality' => $this->nationality,
            'physicalAddress' => $this->physicalAddress,
            'scanIdentityPiece' => $this->scanIdentityPiece,
            'scanCertificatWendding' => $this->scanCertificatWendding,
            'tel' => $this->tel,
            'email' => $this->email,
            'marital_regime_id' => new MaritalRegimeResource(MaritalRegime::findOrFail($this->marital_regime_id)),
            'marital_statuse_id' => new MaritalStatusResource(MaritalStatus::findOrFail($this->marital_statuse_id)),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
