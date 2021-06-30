<?php

namespace App\Http\Resources;

use App\Models\Move;
use App\Models\TypeCanal;
use App\Models\TypeConter;
use Illuminate\Http\Resources\Json\JsonResource;

class CounterElectricityResource extends JsonResource
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
            'oldAddress' => $this->oldAddress,
            'oldPolice' => $this->oldPolice,
            'haveCompteBanque' => $this->haveCompteBanque,
            'banqueName' => $this->banqueName,
            'banqueCompteNumber' => $this->banqueCompteNumber,
            'invoice' => $this->invoice,
            'brighFirePlaceNumber' => $this->brighFirePlaceNumber,
            'fridgeNumber' => $this->fridgeNumber,
            'tvNumber' => $this->tvNumber,
            'freezerNumber' => $this->freezerNumber,
            'waterHeaterNumber' => $this->waterHeaterNumber,
            'fanNumber' => $this->fanNumber,
            'airConditionerNumber' => $this->airConditionerNumber,
            'washingMachineNumber' => $this->washingMachineNumber,
            'compteNumber' => $this->compteNumber,
            'moterAndVariousNumber' => $this->moterAndVariousNumber,
            'computerNumber' => $this->computerNumber,
            'moterAndVariousNumber' => $this->moterAndVariousNumber,
            'costomerSignature' => $this->costomerSignature,
            'move_id' => new MoveResource(Move::findOrFail($this->move_id)),
            'type_local_id' => new TypeLocalResource(TypeCanal::findOrFail($this->type_local_id)),
            'type_conter_id' => new TypeConterResource(TypeConter::findOrFail($this->type_conter_id)),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

