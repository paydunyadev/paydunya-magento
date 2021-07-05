<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Region;
use App\Models\TypeCanal;
use App\Models\OfferType;
use App\Models\TypeConter;
use App\Models\IdentityPiece;
use App\Models\MaritalStatus;
use App\Models\MaritalOption;
use App\Models\MaritalRegime;
use App\Models\TypeInscription;
use App\Models\TypeAdministrative;
use App\Models\CanalCommunication;
use App\Http\Controllers\Controller;
use App\Models\CaracteristiqueTechnique;
use App\Models\User;

class BaseInfoController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMaritalOption(){
        $maritalOptions = MaritalOption::all();
        return response()->json($maritalOptions,200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMaritalStatus(){
        $maritalStatus = MaritalStatus::all();
        return response()->json($maritalStatus,200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMaritalRegime(){
        $maritalRegimes = MaritalRegime::all();
        return response()->json($maritalRegimes,200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function typeAdministrative(){
        $typeAdministrative = TypeAdministrative::all();
        return response()->json($typeAdministrative,200);
    }
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function typeInscription(){
        $typeInscription = TypeInscription::all();
        return response()->json($typeInscription,200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function identityPiece(){
        $identityPiece = IdentityPiece::all();
        return response()->json($identityPiece,200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function typeCanal(){
        $typeCanals = TypeCanal::all();
        return response()->json($typeCanals,200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function caracteristiqueTechnique(){
        $caracteristiqueTechniques = CaracteristiqueTechnique::all();
        return response()->json($caracteristiqueTechniques,200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function typeConter(){
        $ypeConters = TypeConter::all();
        return response()->json($ypeConters,200);
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function offerType(){
        $offerTypes = OfferType::all();
        return response()->json($offerTypes,200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function canalCommunication(){
        $canalCommunications = CanalCommunication::all();
        return response()->json($canalCommunications,200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllAgentCollect(){
        $collecteAgents = User::where('profile_id',2)->get();
        return response()->json($collecteAgents,200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllAgentDeposit(){
        $depositAgents = User::where('profile_id',3)->get();
        return response()->json($depositAgents,200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllRegion(){
        $regions = Region::all();
        return response()->json($regions,200);
    }

}
