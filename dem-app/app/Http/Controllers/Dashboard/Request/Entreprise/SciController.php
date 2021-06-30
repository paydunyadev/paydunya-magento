<?php

namespace App\Http\Controllers\Dashboard\Request\Entreprise;

use App\Models\Sci;
use App\Models\Entreprise;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\Administration;
use App\Http\Resources\SciResource;
use App\Http\Controllers\Controller;

class SciController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SciRequest  $request){

        try {
            $request->validate($this->data_validation);
            $proofSiegeSocial = null;
            if ($request->hasFile('proofSiegeSocial')) {
                $proofSiegeSocial = "proofSiegeSocial";
                $proofSiegeSocial = Storage::disk('s3')->put($proofSiegeSocial,$request->file('proofSiegeSocial'));
            }
            Arr::set($validated, 'proofSiegeSocial', env('END_POINT_BUCKET').$proofSiegeSocial);
            $request_ = \App\Models\Request::create(['user_id'=>auth()->user()->id]);
            Arr::set($validated, 'request_id', $request_->id);
            $entreprise = Entreprise::create($validated);
            Arr::set($validated, 'entreprise_id', $entreprise->id);

            InfoGroupeEntreprise::create($validated);
            $sci = Sci::create($validated);
            Arr::set($validated, 'sci_id', $sci->id);
            //creation administration members
            Administration::create($validated);

            return response()->json(new SciResource($sci),200);
        }catch (\Exception $exception){
            return response()->json($exception);
        }

    }

    /**
     * @param Sci $sci
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Sci $sci){
        return response()->json(new SciResource($sci),200);
    }

    /**
     * @param Request $request
     * @param Sci $sci
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(SciRequest $request,Sci $sci){

        try{
            $validated = $request->validated();
            $entreprise = $sci->entreprise;
            $entreprise->update($validated);
            $infoGroupeEntreprise = $entreprise->infoGroupeEntreprise;
            $infoGroupeEntreprise->update($validated);
            $sci->update($validated);
            $administration = $sci->administration;
            $administration->update($validated);
            return response()->json($sci,200);
        }catch (\Exception $exception){
            return response()->json($exception);
        }
    }

    /**
     * @param Sci $sci
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Sci $sci)
    {
        try{
            $sci->delete();
            return response()->json('La demande a été supprimée !',200);
        }catch (\Exception $exception){
            return response()->json($exception);
        }
    }
}
