<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sci extends Model
{
    use HasFactory;
    protected $fillable = [
        'entreprise_id',
        'proofSiegeSocial',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function entreprise(){
        return $this->belongsTo(Entreprise::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function administration(){
        return $this->hasOne(Administration::class);
    }


}
