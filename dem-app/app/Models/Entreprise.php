<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    use HasFactory;

    protected $fillable = [
        'denomination',
        'socialSiege',
        'sigle',
        'activities',
        'request_id',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function civilStatus(){
        return $this->hasMany(CivilStatus::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function individual(){
        return $this->hasOne(Individual::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sasOrSasu(){
        return $this->hasOne(SasOrSasu::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sarlSuarl(){
        return $this->hasOne(SarlSuarl::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sa(){
        return $this->hasOne(Sa::class);
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
    public function sci(){
        return $this->hasOne(Sci::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function infoGroupeEntreprise(){
        return $this->hasOne(InfoGroupeEntreprise::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getInfGroupeEntrepriseAttribute(){
       return $this->infoGroupeEntreprise;
    }
}
