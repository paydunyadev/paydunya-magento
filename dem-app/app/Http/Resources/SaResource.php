<?php

namespace App\Http\Resources;

use App\Models\Entreprise;
use App\Models\BoardOfDirector;
use Illuminate\Http\Resources\Json\JsonResource;

class SaResource extends JsonResource
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
            'board_of_director' => new BoardOfDirectorResource(BoardOfDirector::findOrFail($this->board_of_director_id)),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
