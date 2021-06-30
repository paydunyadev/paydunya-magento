<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DomesticatedConnection extends Model
{
    use HasFactory;
    protected $fillable = [
        'numberWaterPoint',
        'numberBathroomSink',
        'numberFaucet',
        'numberSink',
        'numberBathTub',
        'numberUrinal',
        'numberBidet',
        'numberWc',
        'numberLavoir',
        'gardenSurface',
        'poolCapacity',
        'water_sde_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function waterSde(){
        return $this->belongsTo(WaterSde::class);
    }
}
