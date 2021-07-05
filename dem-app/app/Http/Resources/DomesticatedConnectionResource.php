<?php

namespace App\Http\Resources;

use App\Models\WaterSde;
use Illuminate\Http\Resources\Json\JsonResource;

class DomesticatedConnectionResource extends JsonResource
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
            'numberWaterPoint' => $this->numberWaterPoint,
            'numberBathroomSink' => $this->numberBathroomSink,
            'numberFaucet' => $this->numberFaucet,
            'numberSink' => $this->numberSink,
            'numberBathTub' => $this->numberBathTub,
            'numberUrinal' => $this->numberUrinal,
            'numberBidet' => $this->numberBidet,
            'numberWc' => $this->numberWc,
            'numberLavoir' => $this->numberLavoir,
            'gardenSurface' => $this->gardenSurface,
            'poolCapacity' => $this->poolCapacity,
            'numberInscriptionRccm' => $this->numberInscriptionRccm,
            'water_sde_id' => new WaterSdeResource(WaterSde::findOrFail($this->water_sde_id)),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

