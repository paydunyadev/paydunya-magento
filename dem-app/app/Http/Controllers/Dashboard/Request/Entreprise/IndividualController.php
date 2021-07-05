<?php

namespace App\Http\Controllers\Dashboard\Request\Entreprise;

use Carbon\Carbon;
use App\Models\Individual;
use App\Models\Entreprise;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\IndividualRequest;
use App\Http\Resources\IndividualResource;


class IndividualController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(IndividualRequest  $request){

        try {
            $validated = $request->validated();;
            $request_ = \App\Models\Request::create(['user_id'=>auth()->user()->id]);
            Arr::set($validated, 'request_id', $request_->id);
            $entreprise = Entreprise::create($validated);
            $validated = Arr::set($validated, 'entreprise_id',$entreprise->id);
            $validated = Arr::set($validated, 'depositDate',Carbon::now());
            $validated = Arr::set($validated, 'isSgn',true);
            $individual = Individual::create($validated);
            return response()->json(new IndividualResource($individual),200);
        }catch (\Exception $exception){
            return response()->json($exception);
        }

    }

    /**
     * @param Individual $individual
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Individual  $individual){
        return response()->json(new IndividualResource($individual),200);
    }

    /**
     * @param Request $request
     * @param Individual $individual
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(IndividualRequest $request,Individual $individual){

        try{
            $validated = $request->validated();
            $entreprise= $individual->entreprise;
            $entreprise->update($validated);
            $individual->update($validated);
            return response()->json($individual,200);
        }catch (\Exception $exception){
            return response()->json($exception);
        }

    }

    /**
     * @param Individual $individual
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Individual $individual)
    {
        try{
            $individual->delete();
            return response()->json('La demande a été supprimée !',200);
        }catch (\Exception $exception){
            return response()->json($exception);
        }
    }
}
