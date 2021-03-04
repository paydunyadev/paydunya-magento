<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaterSde extends Model
{
    use HasFactory;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function move(){
        return $this->belongsTo(Move::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function socialConnection(){
        return $this->hasOne(SocialConnection::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function physiquePersonConnection(){
        return $this->hasOne(PhysiquePersonConnection::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function legalPersonConnection(){
        return $this->hasOne(LegalPersonConnection::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function domesticatedConnection(){
        return $this->hasOne(DomesticatedConnection::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function otherConnection(){
        return $this->hasOne(OtherConnection::class);
    }

}
