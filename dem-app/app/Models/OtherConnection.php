<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherConnection extends Model
{
    use HasFactory;

    protected $fillable = [
        'annualComsuption',
        'debitDaily',
        'debitSchedule',
        'water_sde_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function waterSde(){
        return $this->belongsTo(WaterSde::class);
    }
}
