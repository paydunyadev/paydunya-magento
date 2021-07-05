<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administration extends Model
{
    use HasFactory;

    protected $fillable = [
        'generalAdministrator',
        'deputyGeneralAdminitrator',
        'tel',
        'sas_or_sasu_id',
        'sarl_suarl_id',
        'sa_id',
        'sci_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sa(){
        return $this->belongsTo(Sa::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sarlSuarl(){
        return $this->belongsTo(SarlSuarl::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sasOrSasu(){
        return $this->belongsTo(SasOrSasu::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sci(){
        return $this->belongsTo(Sci::class);
    }
}
