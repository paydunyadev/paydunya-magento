<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParticularCostomer extends Model
{
    use HasFactory;
    protected $fillable = [
        'accepteToReceiveInfoSonatel',
        'accepteToReceiveInfoPartnerSonatel',
        'email_costomer',
        'tel_costomer',
        'faxNumber',
        'receiveInvoiceInFormatElectronic',
        'signature',
        'dateSignature',
        'palaceSignature',
        'wifi_orange_id',
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function wifiOrange(){
        return $this->belongsTo(WifiOrange::class);
    }
}
