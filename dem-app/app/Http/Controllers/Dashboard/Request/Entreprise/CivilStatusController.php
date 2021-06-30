<?php

namespace App\Http\Controllers\Dashboard\Request\Entreprise;

use Illuminate\Support\Arr;
use App\Models\CivilStatus;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CivilStatusRequest;
use App\Http\Resources\CivilStatusResource;

class CivilStatusController extends Controller
{

    /**
     * @param CivilStatusRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CivilStatusRequest $request){
        try {
            $validated = $request->validated();
            $scanIdentityPiece = null;
            if ($request->hasFile('scanIdentityPiece')) {
                $scanIdentityPiece = "scanIdentityPiece";
                $scanIdentityPiece = Storage::disk('s3')->put($scanIdentityPiece,$request->file('scanIdentityPiece'));
            }
            Arr::set($validated, 'scanIdentityPiece', env('END_POINT_BUCKET').$scanIdentityPiece);
            $scanCertificatWendding = null;
            if ($request->hasFile('scanCertificatWendding')) {
                $scanCertificatWendding = "scanCertificatWendding";
                $scanCertificatWendding = Storage::disk('s3')->put($scanCertificatWendding,$request->file('scanCertificatWendding'));
            }
            Arr::set($validated, 'scanCertificatWendding', env('END_POINT_BUCKET').$scanCertificatWendding);
            $request_ = \App\Models\Request::findOrFail($request->request_id);
            $validated = Arr::set($validated, 'entreprise_id',$request_->entreprise->id);
            $civilStatus = CivilStatus::create($validated);
            return response()->json(new CivilStatusResource($civilStatus),200);
        }catch (\Exception $exception){
            return response()->json($exception);
        }

    }

    /**
     * @param CivilStatusRequest $request
     * @param CivilStatus $civilStatus
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CivilStatusRequest $request,CivilStatus $civilStatus){

        try{
            $validated = $request->validated();
            $scanIdentityPiece = null;
            if ($request->hasFile('scanIdentityPiece')) {
                $scanIdentityPiece = "scanIdentityPiece";
                $scanIdentityPiece = Storage::disk('s3')->put($scanIdentityPiece,$request->file('scanIdentityPiece'));
            }
            Arr::set($validated, 'scanIdentityPiece', env('END_POINT_BUCKET').$scanIdentityPiece);
            $scanCertificatWendding = null;
            if ($request->hasFile('scanCertificatWendding')) {
                $scanCertificatWendding = "scanCertificatWendding";
                $scanCertificatWendding = Storage::disk('s3')->put($scanCertificatWendding,$request->file('scanCertificatWendding'));
            }
            Arr::set($validated, 'scanCertificatWendding', env('END_POINT_BUCKET').$scanCertificatWendding);
            Storage::disk('s3')->delete($civilStatus->scanIdentityPiece);
            Storage::disk('s3')->delete($civilStatus->scanCertificatWendding);
            $civilStatus->update($validated);
            return response()->json(new CivilStatusResource($civilStatus),200);
        }catch (\Exception $exception){
            return response()->json($exception);
        }

    }
}
