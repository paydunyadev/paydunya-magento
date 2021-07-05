<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WifiOrange extends Model
{
    use HasFactory;
    protected $fillable = [
        'move_id',
        'offer_type_id',
        'costomer_entreprise_id',
    ];

    protected $dates = ['dateSignature'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function move(){
        return $this->belongsTo(Move::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function offerType(){
        return $this->belongsTo(OfferType::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function costomerEntreprise(){
        return $this->belongsTo(CostomerEntreprise::class);
    }

}
