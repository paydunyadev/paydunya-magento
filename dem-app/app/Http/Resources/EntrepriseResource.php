<?php

namespace App\Http\Resources;

use App\Models\InfoGroupeEntreprise;
use Illuminate\Http\Resources\Json\JsonResource;

class EntrepriseResource extends JsonResource
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
            'denomination' => $this->denomination,
            'socialSiege' => $this->socialSiege,
            'sigle' => $this->sigle,
            'activities' => $this->activities,
            'civil_statuse_id' => new CivilStatusResource($this->whenLoaded('civil_statuse_id')),
            'infoGroupeEntreprise' => $this->infGroupeEntreprise,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

