<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BoardOfDirectorResource extends JsonResource
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
            'pdg' => $this->pdg,
            'pca' => $this->pca,
            'dg' => $this->dg,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
