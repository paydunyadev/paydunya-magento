<?php

namespace App\Http\Resources;

use App\Models\Move;
use Illuminate\Http\Resources\Json\JsonResource;

class CanalResource extends JsonResource
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
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
            'move' => new MoveResource(Move::findOrFail($this->move_id)),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}


