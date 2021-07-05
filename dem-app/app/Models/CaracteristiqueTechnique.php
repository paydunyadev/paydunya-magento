<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaracteristiqueTechnique extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];
}
