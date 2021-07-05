<?php

namespace App\Http\Controllers\Dashboard\Request\Entreprise;

use App\Models\Sa;
use App\Models\Partner;
use App\Models\Entreprise;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\Administration;
use App\Models\BoardOfDirector;
use App\Models\StatutoryAuditor;
use App\Http\Requests\SaRequest;
use App\Http\Resources\SaResource;
use App\Http\Controllers\Controller;
use App\Models\InfoGroupeEntreprise;

class SaController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SaRequest  $request){

        try {
            $validated = $request->validated();

            $request_ = \App\Models\Request::create(['user_id'=>auth()->user()->id]);
            Arr::set($validated, 'request_id', $request_->id);
            $entreprise = Entreprise::create($validated);
            //creation board of directors
            $boardOfDirector = BoardOfDirector::create($validated);
            Arr::set($validated, 'entreprise_id', $entreprise->id);
            Arr::set($validated, 'board_of_director_id', $boardOfDirector->id);
            InfoGroupeEntreprise::create($validated);
            $sa = Sa::create($validated);
            Arr::set($validated, 'sa_id', $sa->id);
            //creation administration members
            Administration::create($validated);
            //creation commissaire aux compte
            StatutoryAuditor::create($validated);
            return response()->json(new  SaResource($sa),200);
        }catch (\Exception $exception){
            return response()->json($exception);
        }

    }

    /**
     * @param Sa $sa
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Sa  $sa){
        return response()->json(new  SaResource($sa),200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addPartner(Request  $request){

        try {
            $validated = $request->validate([
                'firstName' => 'required|string',
                'lastName' => 'required|string',
                'profession' => 'required|string',
                'tel' => 'required|string',
                'email' => 'required|string',
                'sa_id' => 'required|exists:sas,id',
            ]);
            $partner = Partner::create($validated);
            return response()->json($partner,200);

        }catch (\Exception $exception){
            return response()->json($exception);
        }


    }

    /**
     * @param Request $request
     * @param Sa $sa
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request,Sa $sa){

        try{
            $validated = $request->validated();
            $entreprise = $sa->entreprise;
            $entreprise->update($validated);
            $infoGroupeEntreprise = $entreprise->infoGroupeEntreprise;
            $infoGroupeEntreprise->update($validated);
            $sa->update($validated);
            $administration = $sa->administration;
            $administration->update($validated);
            $statutoryAuditor = $sa->statutoryAuditor;
            $statutoryAuditor->update($validated);
            return response()->json($sa,200);
        }catch (\Exception $exception){
            return response()->json($exception);
        }

    }

    /**
     * @param Sa $sa
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Sa $sa)
    {
        try{
            $sa->delete();
            return response()->json('La demande a été supprimée !',200);
        }catch (\Exception $exception){
            return response()->json($exception);
        }
    }
}
