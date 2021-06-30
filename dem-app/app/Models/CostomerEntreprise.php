<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostomerEntreprise extends Model
{
    use HasFactory;
    protected $fillable = [
        'denominationSocial',
        'socialSiege',
        'invoiceAddress',
        'nameAndQaulityRepresentative',
        'activityDomaine',
        'email_entreprise',
        'phone',
        'fixePhone',
        'numberOfPieceIdentity',
        'dateDeleveranceIdentityPiece',
        'ninea',
        'numberInscriptionRccm',
        'identity_piece_id',
        'wifi_orange_id',
    ];

    protected $dates = ['dateDeleveranceIdentityPiece'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function identityPiece(){
        return $this->belongsTo(IdentityPiece::class);
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function wifiOrange(){
        return $this->belongsTo(WifiOrange::class);
    }
}
