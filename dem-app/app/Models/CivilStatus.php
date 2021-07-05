<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CivilStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstName',
        'lastName',
        'passportNumber',
        'dateOfBirth',
        'dateOfDeleverancePassport',
        'placeOfBirth',
        'numberCni',
        'profession',
        'nationality',
        'physicalAddress',
        'tel',
        'email',
        'marital_regime_id',
        'marital_statuse_id',
        'entreprise_id',
        'scanIdentityPiece',
        'scanCertificatWendding',
    ];


    protected $dates = ['dateOfBirth','dateOfDeleverancePassport'];

    /**
     * @var string
     */
    protected $table = 'civil_statuses';

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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function maritalRegime(){
        return $this->belongsTo(MaritalRegime::class);
    }



}
