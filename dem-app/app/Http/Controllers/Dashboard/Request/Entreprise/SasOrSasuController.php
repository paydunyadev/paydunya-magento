<?php

namespace App\Http\Controllers\Dashboard\Request\Entreprise;

use App\Models\Partner;
use App\Models\SasOrSasu;
use App\Models\Entreprise;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\Administration;
use App\Models\StatutoryAuditor;
use App\Http\Controllers\Controller;
use App\Http\Requests\SasOrSasuRequest;
use App\Http\Resources\SasOrSasuResource;

class SasOrSasuController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SasOrSasuRequest  $request){

        try {
            $validated = $request->validated();
            $request_ = \App\Models\Request::create(['user_id'=>auth()->user()->id]);
            Arr::set($validated, 'request_id', $request_->id);
            $entreprise = Entreprise::create($validated);
            Arr::set($validated, 'entreprise_id', $entreprise->id);
            InfoGroupeEntreprise::create($validated);
            $sasOrSasu = SasOrSasu::create($validated);
            Arr::set($validated, 'sas_or_sasu_id', $sasOrSasu->id);
            //creation administration members
            Administration::create($validated);
            //creation commissaire aux compte
            StatutoryAuditor::create($validated);

            return response()->json(new SasOrSasuResource($sasOrSasu),200);
        }catch (\Exception $exception){
            return response()->json($exception);
        }

    }

    /**
     * @param SasOrSasu $sasOrSasu
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(SasOrSasu $sasOrSasu){
        return response()->json(new SasOrSasuResource($sasOrSasu),200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addPartner(PartnerRequest  $request){

        try {
            $validated = $request->validated();
            $partner = Partner::create($validated);
            return response()->json($partner,200);

        }catch (\Exception $exception){
            return response()->json($exception);
        }
    }

    /**
     * @param SasOrSasuRequest $request
     * @param SasOrSasu $sasOrSasu
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(SasOrSasuRequest $request,SasOrSasu $sasOrSasu){

        try{
            $validated = $request->validated();
            $entreprise = $sasOrSasu->entreprise;
            $entreprise->update($validated);
            $infoGroupeEntreprise = $entreprise->infoGroupeEntreprise;
            $infoGroupeEntreprise->update($validated);
            $sasOrSasu->update($validated);
            $administration = $sasOrSasu->administration;
            $administration->update($validated);
            $statutoryAuditor = $sasOrSasu->statutoryAuditor;
            $statutoryAuditor->update($validated);
            return response()->json($sasOrSasu,200);
        }catch (\Exception $exception){
            return response()->json($exception);
        }
    }

    /**
     * @param SasOrSasu $sarlSuarl
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(SasOrSasu $sarlSuarl)
    {
        try{
            $sarlSuarl->delete();
            return response()->json('La demande a été supprimée !',200);
        }catch (\Exception $exception){
            return response()->json($exception);
        }
    }
}
