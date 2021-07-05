<?php

namespace App\Http\Resources;

use App\Models\WaterSde;
use Illuminate\Http\Resources\Json\JsonResource;

class OtherConnectionResource extends JsonResource
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
            'annualComsuption' => $this->annualComsuption,
            'debitDaily' => $this->debitDaily,
            'debitSchedule' => $this->debitSchedule,
            'water_sde_id' => new WaterSdeResource(WaterSde::findOrFail($this->water_sde_id)),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
