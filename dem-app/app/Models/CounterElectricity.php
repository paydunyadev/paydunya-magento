<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CounterElectricity extends Model
{
    use HasFactory;

    protected $fillable = [
        'oldAddress',
        'oldPolice',
        'haveCompteBanque',
        'banqueName',
        'banqueCompteNumber',
        'invoice',
        'brighFirePlaceNumber',
        'fridgeNumber',
        'tvNumber',
        'freezerNumber',
        'waterHeaterNumber',
        'fanNumber',
        'airConditionerNumber',
        'washingMachineNumber',
        'compteNumber',
        'moterAndVariousNumber',
        'costomerSignature',
        'move_id',
        'type_local_id',
        'type_conter_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function move(){
        return $this->belongsTo(Move::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function typeConter(){
        return $this->belongsTo(TypeConter::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function typeLocal(){
        return $this->belongsTo(TypeLocal::class);
    }
}
