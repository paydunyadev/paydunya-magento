<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CostomerConfigController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addCanal(Request $request){
        try{
            $validated = $request->validate([
                'canal_communication_id'=>'required|exists:canal_communications,id',
                'request_id'=>'required|exists:requests,id',
            ]);
            $request_ = \App\Models\Request::where('request_id',$request->input('request_id'));
            $request_->update(['canal_communication_id'=> $request->input('canal_communication_id')]);
            return response()->json($request_,200);
        }catch (\Exception $exception){
            //            return response()->json("une erreur est survenue sur le serveur veuillez contactez le support!");
            return response()->json($exception);
        }

    }
}
