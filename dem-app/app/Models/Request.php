<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;
    protected $fillable = [
        'isDisponible',
        'isReceptedByCollectAgent',
        'isCorrect',
        'isDone',
        'user_id',
        'isValidByDepositAgent',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function canalCommunication(){
        return $this->belongsTo(CanalCommunication::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function jobLivraison(){
        return $this->hasOne(JobLivraison::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function jobDeposit(){
        return $this->hasOne(JobDeposit::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function notValidFolder(){
        return $this->hasOne(NotValidFolder::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function notValideMessage(){
        return $this->hasOne(NotValideMessage::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function move(){
        return $this->hasOne(Move::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function entreprise(){
        return $this->hasOne(Entreprise::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function administrative(){
        return $this->hasOne(Administrative::class);
    }
}
