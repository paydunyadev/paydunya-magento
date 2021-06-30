<?php

namespace App\Http\Controllers\Dashboard\Request\Move\WifiOrange;

use App\Models\Move;
use App\Models\WifiOrange;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\ParticularCostomer;
use App\Http\Controllers\Controller;
use App\Http\Resources\ParticularCostomerResource;

class ParticularCostomerController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ParticularCostomerRequest $request){

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
            $wifiOrange = WifiOrange::create($validated);
            $validated = Arr::set($validated, 'wifi_orange_id',$wifiOrange->id);
            $particularCostomer = ParticularCostomer::create($validated);
            return response()->json(new ParticularCostomerResource($particularCostomer),200);

        }catch (\Exception $exception){
            return response()->json($exception);
        }


    }

    /**
     * @param Administrative $administrative
     * @return mixed
     */
    public function show(ParticularCostomer  $particularCostomer){
        return response()->json(new ParticularCostomerResource($particularCostomer),200);
    }

    /**
     * @param Request $request
     * @param ParticularCostomer $particularCostomer
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request,ParticularCostomer $particularCostomer){

        try{
            $validated = $request->validated();
            $wifiOrange = $particularCostomer->wifiOrange;
            $move = $wifiOrange->move;
            $photoIdentityPiece = null;
            if ($request->hasFile('photoIdentityPiece')) {
                $photoIdentityPiece = "photoIdentityPiece";
                $photoIdentityPiece = Storage::disk('s3')->put($photoIdentityPiece,$request->file('photoIdentityPiece'));
            }
            Arr::set($validated, 'photoIdentityPiece', env('END_POINT_BUCKET').$photoIdentityPiece);
            Storage::disk('s3')->delete($move->photoIdentityPiece);
            $wifiOrange->update($validated);
            $move->update($validated);
            $particularCostomer->update($validated);
            return response()->json(new ParticularCostomerResource($particularCostomer),200);
        }catch (\Exception $exception){
            return response()->json($exception);
        }
    }

    /**
     * @param ParticularCostomer $particularCostomer
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(ParticularCostomer $particularCostomer)
    {
        try{
            $particularCostomer->delete();
            return response()->json('La demande a été supprimée !',200);
        }catch (\Exception $exception){
            return response()->json($exception);
        }
    }
}
