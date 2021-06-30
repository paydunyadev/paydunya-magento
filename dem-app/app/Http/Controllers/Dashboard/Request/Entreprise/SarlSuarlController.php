<?php

namespace App\Http\Controllers\Dashboard\Request\Entreprise;

use App\Models\SarlSuarl;
use App\Models\Entreprise;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\Administration;
use App\Models\StatutoryAuditor;
use App\Http\Controllers\Controller;
use App\Http\Requests\SarlSuarlRequest;
use App\Http\Resources\SarlSuarlResource;

class SarlSuarlController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SarlSuarlRequest  $request){

        try {
            $validated = $request->validated();
            $request_ = \App\Models\Request::create(['user_id'=>auth()->user()->id]);
            Arr::set($validated, 'request_id', $request_->id);
            $entreprise = Entreprise::create($validated);
            Arr::set($validated, 'entreprise_id', $entreprise->id);
            InfoGroupeEntreprise::create($validated);
            $sarlSuarl = SarlSuarl::create($validated);
            Arr::set($validated, 'sarl_suarl_id', $sarlSuarl->id);
            //creation administration members
            Administration::create($validated);
            //creation commissaire aux compte
            StatutoryAuditor::create($validated);
            return response()->json(new SarlSuarlResource($sarlSuarl),200);
        }catch (\Exception $exception){
            return response()->json($exception);
        }

    }

    /**
     * @param SarlSuarl $sarlSuarl
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(SarlSuarl  $sarlSuarl){
        return response()->json(new SarlSuarlResource($sarlSuarl),200);
    }

    /**
     * @param Request $request
     * @param SarlSuarl $sarlSuarl
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(SarlSuarlRequest $request,SarlSuarl $sarlSuarl){

        try{
            $validated = $request->validated();
            $entreprise = $sarlSuarl->entreprise;
            $entreprise->update($validated);
            $infoGroupeEntreprise = $entreprise->infoGroupeEntreprise;
            $infoGroupeEntreprise->update($validated);
            $sarlSuarl->update($validated);
            $administration = $sarlSuarl->administration;
            $administration->update($validated);
            $statutoryAuditor = $sarlSuarl->statutoryAuditor;
            $statutoryAuditor->update($validated);
            return response()->json($sarlSuarl,200);
        }catch (\Exception $exception){
            return response()->json($exception);
        }
    }

    /**
     * @param SarlSuarl $sarlSuarl
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(SarlSuarl $sarlSuarl)
    {
        try{
            $sarlSuarl->delete();
            return response()->json('La demande a été supprimée !',200);
        }catch (\Exception $exception){
            return response()->json($exception);
        }
    }
}
