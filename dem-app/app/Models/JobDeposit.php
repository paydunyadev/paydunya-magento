<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobDeposit extends Model
{
    use HasFactory;

    protected $fillable = ['dateDeposit','duration','numberpath','isRecepted','isValideFolder','nesDuration','request_id','user_id'];

    protected $dates = ['dateDeposit'];
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
}
