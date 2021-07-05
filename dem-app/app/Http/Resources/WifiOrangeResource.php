<?php

namespace App\Http\Resources;

use App\Models\CostomerEntreprise;
use App\Models\OfferType;
use Illuminate\Http\Resources\Json\JsonResource;

class WifiOrangeResource extends JsonResource
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
            'offer_type_id' => new OfferTypeResource(OfferType::findOrFail($this->offer_type_id)),
            'costomer_entreprise_id' => new CostomerEntrepriseResource(CostomerEntreprise::findOrFail($this->offer_type_id)),
            'move' => new MoveResource(Move::findOrFail($this->move_id)),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

