<?php

namespace App\Http\Controllers\Dashboard\Request\Move\WifiOrange;

use App\Models\Move;
use App\Models\WifiOrange;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\CostomerEntreprise;
use App\Http\Controllers\Controller;
use App\Http\Resources\CostomerEntrepriseResource;

class CostomerEntrepriseController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CostomerEntrepriseRequest $request){

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
            $costomerEntreprise = CostomerEntreprise::create($validated);
            return response()->json(new CostomerEntrepriseResource($costomerEntreprise),200);

        }catch (\Exception $exception){
            return response()->json($exception);
        }


    }

    /**
     * @param Administrative $administrative
     * @return mixed
     */
    public function show(CostomerEntreprise  $costomerEntreprise){
        return response()->json(new CostomerEntrepriseResource($costomerEntreprise),200);
    }

    /**
     * @param Request $request
     * @param CostomerEntreprise $costomerEntreprise
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request,CostomerEntreprise $costomerEntreprise){

        try{
            $validated = $request->validated();
            $wifiOrange = $costomerEntreprise->wifiOrange;
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
            $costomerEntreprise->update($validated);
            return response()->json(new CostomerEntrepriseResource($costomerEntreprise),200);
        }catch (\Exception $exception){
            return response()->json($exception);
        }
    }

    /**
     * @param CostomerEntreprise $costomerEntreprise
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(CostomerEntreprise $costomerEntreprise)
    {
        try{
            $costomerEntreprise->delete();
            return response()->json('La demande a été supprimée !',200);
        }catch (\Exception $exception){
            return response()->json($exception);
        }
    }
}
