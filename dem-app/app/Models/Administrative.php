<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrative extends Model
{
    use HasFactory;
    protected $fillable = [
        'firstName',
        'lastName',
        'recipient',
        'libelleDistrick',
        'numberDistrick',
        'codePostal',
        'contry',
        'address',
        'tel',
        'email',
        'placeExpedition',
        'numberOfCopie',
        'reason',
        'reference',
        'copieOfFolder',
        'haveAlreadyGetThisDocPre',
        'haveKeepFolder',
        'region',
        'commune',
        'department',
        'marital_statuse_id',
        'type_administrative_id',
        'request_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function typeAdministrative(){
        return $this->belongsTo(TypeAdministrative::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function maritalStatus(){
        return $this->belongsTo(MaritalStatus::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function entreprise(){
        return $this->belongsTo(Entreprise::class);
    }
}
