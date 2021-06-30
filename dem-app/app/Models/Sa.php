<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sa extends Model
{
    use HasFactory;

    protected $fillable = [
        'entreprise_id',
        'board_of_director_id',
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function boardOfDirector(){
        return $this->hasOne(BoardOfDirector::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function statutoryAuditor(){
        return $this->hasOne(StatutoryAuditor::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function partners(){
        return $this->hasMany(Partner::class);
    }
}
