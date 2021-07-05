<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Canal extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'description',
        'move_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function move(){
        return $this->belongsTo(Move::class);
    }
}
