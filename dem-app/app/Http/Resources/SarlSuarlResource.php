<?php

namespace App\Http\Resources;

use App\Models\Entreprise;
use Illuminate\Http\Resources\Json\JsonResource;

class SarlSuarlResource extends JsonResource
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
            'entreprise' => new EntrepriseResource(Entreprise::findOrFail($this->entreprise_id)),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
