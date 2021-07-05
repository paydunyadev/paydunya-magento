<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InfoGroupeEntrepriseResource extends JsonResource
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
            'duration' => $this->duration,
            'capitalSocial' => $this->capitalSocial,
            'apport' => $this->apport,
            'numerical' => $this->numerical,
            'nature' => $this->nature,
            'part' => $this->part,
            'action' => $this->action,
            'capitalAllocation' => $this->capitalAllocation,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

