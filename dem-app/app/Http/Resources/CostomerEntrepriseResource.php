<?php

namespace App\Http\Resources;

use App\Models\IdentityPiece;
use App\Models\WifiOrange;
use Illuminate\Http\Resources\Json\JsonResource;

class CostomerEntrepriseResource extends JsonResource
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
            'denominationSocial' => $this->denominationSocial,
            'socialSiege' => $this->socialSiege,
            'invoiceAddress' => $this->invoiceAddress,
            'nameAndQaulityRepresentative' => $this->nameAndQaulityRepresentative,
            'activityDomaine' => $this->activityDomaine,
            'email_entreprise' => $this->email_entreprise,
            'phone' => $this->phone,
            'fixePhone' => $this->fixePhone,
            'numberOfPieceIdentity' => $this->numberOfPieceIdentity,
            'dateDeleveranceIdentityPiece' => $this->dateDeleveranceIdentityPiece,
            'ninea' => $this->ninea,
            'numberInscriptionRccm' => $this->numberInscriptionRccm,
            'identity_piece' => new IdentityPieceResource(IdentityPiece::findOrFail($this->identity_piece_id)),
            'wifi_orange' => new WifiOrangeResource(WifiOrange::findOrFail($this->wifi_orange_id)),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

