<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobLivraison extends Model
{
    use HasFactory;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function request(){
        return $this->belongsTo(Request::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function livraisonNotDone(){
        return $this->hasOne(LivraisonNotDone::class);
    }
}
