<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoGroupeEntreprise extends Model
{
    use HasFactory;

    protected $fillable = [
        'duration',
        'capitalSocial',
        'apport',
        'numerical',
        'nature',
        'part',
        'action',
        'capitalAllocation',
        'entreprise_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function entreprise(){
        return $this->belongsTo(Entreprise::class);
    }
}
