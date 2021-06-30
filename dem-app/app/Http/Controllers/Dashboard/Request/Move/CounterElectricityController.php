<?php

namespace App\Http\Controllers\Dashboard\Request\Move;

use App\Models\Move;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\CounterElectricity;
use App\Http\Controllers\Controller;
use App\Http\Resources\CounterElectricityResource;

class CounterElectricityController extends Controller
{

    public function store(CounterElectricityRequest $request){

        try {
            $validated = $request->validated();;
            $request_ = \App\Models\Request::create(['user_id'=>auth()->user()->id]);
            $validated = Arr::set($validated, 'request_id',$request_->id);
            $photoIdentityPiece = null;
            if ($request->hasFile('photoIdentityPiece')) {
                $photoIdentityPiece = "photoIdentityPiece";
                $photoIdentityPiece = Storage::disk('s3')->put($photoIdentityPiece,$request->file('photoIdentityPiece'));
            }
            Arr::set($validated, 'photoIdentityPiece', env('END_POINT_BUCKET').$photoIdentityPiece);
            $move = Move::create($validated);
            $validated = Arr::set($validated, 'move_id',$move->id);
            $counterElectricity = CounterElectricity::create($validated);
            return response()->json(new CounterElectricityResource($counterElectricity),200);

        }catch (\Exception $exception){
            return response()->json($exception);
        }
    }

    /**
     * @param Administrative $administrative
     * @return mixed
     */
    public function show(CounterElectricity  $counterElectricity){
        return response()->json(new CounterElectricityResource($counterElectricity),200);
    }

    /**
     * @param Request $request
     * @param Canal $canal
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request,CounterElectricity $counterElectricity){

        try{
            $validated = $request->validated();
            $move = $counterElectricity->move;
            $photoIdentityPiece = null;
            if ($request->hasFile('photoIdentityPiece')) {
                $photoIdentityPiece = "photoIdentityPiece";
                $photoIdentityPiece = Storage::disk('s3')->put($photoIdentityPiece,$request->file('photoIdentityPiece'));
            }
            Arr::set($validated, 'photoIdentityPiece', env('END_POINT_BUCKET').$photoIdentityPiece);
            Storage::disk('s3')->delete($move->photoIdentityPiece);
            $move->update($validated);
            $counterElectricity->update($validated);
            return response()->json(new CounterElectricityResource($counterElectricity),200);
        }catch (\Exception $exception){
            return response()->json($exception);
        }
    }

    /**
     * @param CounterElectricity $counterElectricity
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(CounterElectricity $counterElectricity)
    {
        try{
            $counterElectricity->delete();
            return response()->json('La demande a été supprimée !',200);
        }catch (\Exception $exception){
            return response()->json($exception);
        }
    }
}
