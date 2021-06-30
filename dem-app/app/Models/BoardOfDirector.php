<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardOfDirector extends Model
{
    use HasFactory;

    protected $fillable = [
        'pdg',
        'pca',
        'dg',
        'sa_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sa(){
        return $this->belongsTo(Sa::class);
    }
}
