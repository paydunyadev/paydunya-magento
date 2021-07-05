<?php

namespace App\Http\Resources;

use App\Models\CaracteristiqueTechnique;
use App\Models\IdentityPiece;
use App\Models\TypeInscription;
use Illuminate\Http\Resources\Json\JsonResource;

class MoveResource extends JsonResource
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
            'ownerFirstName' => $this->ownerFirstName,
            'ownerLastName' => $this->ownerLastName,
            'representatativeLastName' => $this->representatativeLastName,
            'dateBirthDay' => $this->dateBirthDay,
            'placeOfBirthDay' => $this->placeOfBirthDay,
            'nationality' => $this->nationality,
            'installationAddress' => $this->installationAddress,
            'billingAddress' => $this->billingAddress,
            'homeTel' => $this->homeTel,
            'port' => $this->port,
            'profession' => $this->profession,
            'email' => $this->email,
            'employerName' => $this->employerName,
            'professionalAddress' => $this->professionalAddress,
            'oficeTel' => $this->oficeTel,
            'tel' => $this->tel,
            'photoIdentityPiece' => $this->photoIdentityPiece,
            'numberIdentityPiece' => $this->numberIdentityPiece,
            'neighbourName' => $this->neighbourName,
            'neighbourTakenNumber' => $this->neighbourTakenNumber,
            'identity_piece_id' => new IdentityPieceResource(IdentityPiece::findOrFail($this->identity_piece_id)),
            'type_inscription_id' => new TypeInscriptionResource(TypeInscription::findOrFail($this->type_inscription_id)),
            'caracteristique_technique_id' => new CaracteristiqueTechniqueResource(CaracteristiqueTechnique::findOrFail($this->caracteristique_technique_id)),
            'request_id' => $this->request_id,
            'move' => new MoveResource(Move::findOrFail($this->move_id)),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

}
