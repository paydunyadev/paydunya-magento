<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\DepositFile;
use Illuminate\Http\Request;

class AgentDepositConfigController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
        public function valideReceptionDepositFile(Request $request){
            try {
                $request->validate([
                    'deposit_file_id'=>'required|exists:deposit_files,id',
                ]);
                $depositFile = DepositFile::findOrFail($request->deposit_file_id);
                $depositFile->update(['isReceptedByDepositAgent'=>true]);
                return response()->json('Reception validée',200);
            }catch (\Exception $exception){
                return response()->json($exception);
            }
        }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
        public function valideRequestByDepositAgent(Request $request){
            try {
                $request->validate([
                    'request_id'=>'required|exists:requests,id',
                ]);
                $request_ = \App\Models\Request::findOrFail($request->request_id);
                $request_->update(['isValidByDepositAgent'=>true]);
                return response()->json('Demande validée',200);
            }catch (\Exception $exception){
                return response()->json($exception);
            }
        }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
        public function valideConformityDepositFile(Request $request){
            try {
                $request->validate([
                    'deposit_file_id'=>'required|exists:deposit_files,id',
                ]);
                $depositFile = DepositFile::findOrFail($request->deposit_file_id);
                $depositFile->update(['isConforme'=>true]);
                return response()->json('La conformitée du dossier validée ',200);
            }catch (\Exception $exception){
                return response()->json($exception);
            }
        }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
        public function nonValideConformityDepositFile(Request $request){
            try {
                $request->validate([
                    'deposit_file_id'=>'required|exists:deposit_files,id',
                ]);
                $depositFile = DepositFile::findOrFail($request->deposit_file_id);
                $depositFile->update(['isConforme'=>false]);
                return response()->json('La conformitée du dossier validée ',200);
            }catch (\Exception $exception){
                return response()->json($exception);
            }
        }
}
