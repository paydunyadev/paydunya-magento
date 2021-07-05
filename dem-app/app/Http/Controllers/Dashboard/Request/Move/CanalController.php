<?php

namespace App\Http\Controllers\Dashboard\Request\Move;

use App\Models\Move;
use App\Models\Canal;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CanalResource;

class CanalController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CanalRequest $request){

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
            $canal = Canal::create($validated);
            return response()->json(new CanalResource($canal),200);

        }catch (\Exception $exception){
            return response()->json($exception);
        }


    }

    /**
     * @param Administrative $administrative
     * @return mixed
     */
    public function show(Canal  $canal){
        return response()->json(new CanalResource($canal),200);
    }

    /**
     * @param Request $request
     * @param Canal $canal
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request,Canal $canal){

        try{
            $validated = $request->validated();
            $move = $canal->move;
            $photoIdentityPiece = null;
            if ($request->hasFile('photoIdentityPiece')) {
                $photoIdentityPiece = "photoIdentityPiece";
                $photoIdentityPiece = Storage::disk('s3')->put($photoIdentityPiece,$request->file('photoIdentityPiece'));
            }
            Arr::set($validated, 'photoIdentityPiece', env('END_POINT_BUCKET').$photoIdentityPiece);
            Storage::disk('s3')->delete($move->photoIdentityPiece);
            $move->update($validated);
            $canal->update($validated);
            return response()->json(new CanalResource($canal),200);
        }catch (\Exception $exception){
            return response()->json($exception);
        }
    }

    /**
     * @param Canal $canal
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Canal $canal)
    {
        try{
            $canal->delete();
            return response()->json('La demande a été supprimée !',200);
        }catch (\Exception $exception){
            return response()->json($exception);
        }
    }
}
