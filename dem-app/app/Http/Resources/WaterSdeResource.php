<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WaterSdeResource extends JsonResource
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
            'attachement' => $this->attachement,
            'move' => new MoveResource(Move::findOrFail($this->move_id)),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
