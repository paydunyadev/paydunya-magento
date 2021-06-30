<?php

namespace App\Http\Resources;

use App\Models\WifiOrange;
use Illuminate\Http\Resources\Json\JsonResource;

class ParticularCostomerResource extends JsonResource
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
            'accepteToReceiveInfoSonatel' => $this->accepteToReceiveInfoSonatel,
            'accepteToReceiveInfoPartnerSonatel' => $this->accepteToReceiveInfoPartnerSonatel,
            'email_costomer' => $this->email_costomer,
            'tel_costomer' => $this->tel_costomer,
            'faxNumber' => $this->faxNumber,
            'receiveInvoiceInFormatElectronic' => $this->receiveInvoiceInFormatElectronic,
            'signature' => $this->signature,
            'dateSignature' => $this->dateSignature,
            'palaceSignature' => $this->palaceSignature,
            'numberInscriptionRccm' => $this->numberInscriptionRccm,
            'wifi_orange' => new WifiOrangeResource(WifiOrange::findOrFail($this->wifi_orange_id)),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

