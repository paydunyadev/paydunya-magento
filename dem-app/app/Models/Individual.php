<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Individual extends Model
{
    use HasFactory;

    protected $fillable = [
        'addressEstablishment',
        'ifHaveRegisterTrade',
        'firstNameRepresentativeLegal',
        'lastNameRepresentativeLegal',
        'nationalityRepresentativeLegal',
        'phoneRepresentativeLegal',
        'domicilAddressRepresentativeLegal',
        'emailRepresentativeLegal',
        'spouseFirstName',
        'spouseLastName',
        'weddingDate',
        'isSgn',
        'marital_option_id',
        'marital_statuse_id',
        'marital_regime_id',
        'entreprise_id',
        'depositDate',
        'signature',
    ];

    protected $dates =['weddingDate','depositDate'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function entreprise(){
        return $this->belongsTo(Entreprise::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function maritalOption(){
        return $this->belongsTo(MaritalOption::class);
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
    public function maritalRegime(){
        return $this->belongsTo(MaritalRegime::class);
    }
}
