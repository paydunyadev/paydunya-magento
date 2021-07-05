<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LivraisonNotDone extends Model
{
    use HasFactory;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jobLivraison(){
        return $this->belongsTo(JobLivraison::class);
    }
}
