<?php

namespace App\Http\Controllers\Dashboard\Request\Move\WaterSde;

use App\Models\Move;
use App\Models\WaterSde;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\SocialConnection;
use App\Http\Controllers\Controller;
use App\Http\Resources\SocialConnectionResource;

class SocialConnectionController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SocialConnectionRequest $request){

        try {
            $validated = $request->validated();
            $request_ = \App\Models\Request::create(['user_id'=>auth()->user()->id]);
            Arr::set($validated, 'request_id', $request_->id);
            $attachement = null;
            if ($request->hasFile('attachement')) {
                $attachement = "attachement";
                $attachement = Storage::disk('s3')->put($attachement,$request->file('attachement'));
            }
            Arr::set($validated, 'attachement', env('END_POINT_BUCKET').$attachement);
            $photoIdentityPiece = null;
            if ($request->hasFile('photoIdentityPiece')) {
                $photoIdentityPiece = "photoIdentityPiece";
                $photoIdentityPiece = Storage::disk('s3')->put($photoIdentityPiece,$request->file('photoIdentityPiece'));
            }
            Arr::set($validated, 'photoIdentityPiece', env('END_POINT_BUCKET').$photoIdentityPiece);
            $move = Move::create($validated);
            $validated = Arr::set($validated, 'move_id',$move->id);
            $waterSde = WaterSde::create($validated);
            $validated = Arr::set($validated, 'water_sde_id',$waterSde->id);
            $socialConnection = SocialConnection::create($validated);
            return response()->json(new SocialConnectionResource($socialConnection),200);

        }catch (\Exception $exception){
            return response()->json($exception);
        }


    }

    /**
     * @param SocialConnection $socialConnection
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(SocialConnection  $socialConnection){
        return response()->json(new SocialConnectionResource($socialConnection),200);
    }

    /**
     * @param Request $request
     * @param SocialConnection $socialConnection
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request,SocialConnection $socialConnection){

        try{
            $validated = $request->validated();
            $attachement = null;
            if ($request->hasFile('attachement')) {
                $attachement = "attachement";
                $attachement = Storage::disk('s3')->put($attachement,$request->file('attachement'));
            }
            Arr::set($validated, 'attachement', env('END_POINT_BUCKET').$attachement);
            $photoIdentityPiece = null;
            if ($request->hasFile('photoIdentityPiece')) {
                $photoIdentityPiece = "photoIdentityPiece";
                $photoIdentityPiece = Storage::disk('s3')->put($photoIdentityPiece,$request->file('photoIdentityPiece'));
            }
            Arr::set($validated, 'photoIdentityPiece', env('END_POINT_BUCKET').$photoIdentityPiece);
            $waterSde = $socialConnection->waterSde;
            $move = $waterSde->move;
            Storage::disk('s3')->delete($move->photoIdentityPiece);
            Storage::disk('s3')->delete($waterSde->attachement);
            $waterSde->update($validated);
            $move->update($validated);
            $socialConnection->update($validated);
            return response()->json(new SocialConnectionResource($socialConnection),200);
        }catch (\Exception $exception){
            return response()->json($exception);
        }
    }

    /**
     * @param SocialConnection $socialConnection
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(SocialConnection $socialConnection)
    {
        try{
            $socialConnection->delete();
            return response()->json('La demande a été supprimée !',200);
        }catch (\Exception $exception){
            return response()->json($exception);
        }
    }
}
