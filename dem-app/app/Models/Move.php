<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Move extends Model
{
    use HasFactory;
    protected $fillable = [
        'ownerFirstName',
        'ownerLastName',
        'representatativeLastName',
        'representatativeFirstName',
        'dateBirthDay',
        'placeOfBirthDay',
        'nationality',
        'installationAddress',
        'billingAddress',
        'homeTel',
        'port',
        'profession',
        'email',
        'employerName',
        'professionalAddress',
        'oficeTel',
        'tel',
        'photoIdentityPiece',
        'numberIdentityPiece',
        'neighbourName',
        'neighbourTakenNumber',
        'identity_piece_id',
        'type_inscription_id',
        'caracteristique_technique_id',
        'request_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function identityPiece(){
        return $this->belongsTo(IdentityPiece::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function typeInscription(){
        return $this->belongsTo(TypeInscription::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function caracteristiqueTechnique(){
        return $this->belongsTo(CaracteristiqueTechnique::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function request(){
        return $this->belongsTo(Request::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function wifiOrange(){
        return $this->hasOne(WifiOrange::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function canal(){
        return $this->hasOne(Canal::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function counterElectricity(){
        return $this->hasOne(CounterElectricity::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function waterSde(){
        return $this->hasOne(WaterSde::class);
    }
}
