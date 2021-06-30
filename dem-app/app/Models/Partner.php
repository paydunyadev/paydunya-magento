<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstName',
        'lastName',
        'profession',
        'tel',
        'email',
        'sas_or_sasu_id',
        'marital_regime_id',
        'sa_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function maritalRegime(){
        return $this->belongsTo(MaritalRegime::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sa(){
        return $this->belongsTo(Sa::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sasOrSasu(){
        return $this->belongsTo(SasOrSasu::class);
    }
}
