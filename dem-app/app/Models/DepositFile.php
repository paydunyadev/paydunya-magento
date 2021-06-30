<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepositFile extends Model
{
    use HasFactory;

    protected $fillable = ['name','isReceptedByDepositAgent','isConforme','region_id'];

}
