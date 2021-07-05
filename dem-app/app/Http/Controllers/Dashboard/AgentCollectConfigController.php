<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\DepositFile;
use App\Models\JobDeposit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ConfirmationReceptionRequest;
use App\Notifications\RequestIsNotCorrectNotification;
use App\Notifications\ConfirmationReceptionRequestNotification;

class AgentCollectConfigController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function isReceptedByCollectAgent(Request $request){
        try{
            $request->validate([
                'request_id'=>'required|exists:requests,id',
            ]);
            $request_ = \App\Models\Request::where('request_id',$request->input('request_id'));
            $request_->update(['isReceptedByCollectAgent'=> true]);
            if($request_->canalCommunication->id == 1){
                $user = $request_->user;
                Notification::send($user, new ConfirmationReceptionRequestNotification());
                return response()->json('Reception validée et le mail sur les conditions de la prise en charge de la demande à été envoyé',200);
            }else{
                if ($request_->canalCommunication->id == 2){
                    return response()->json("Reception validée merci d'informer  le client sur les conditions de la prise en charge de sa demande Par téléphone ",200);
                }else{
                    return response()->json("Reception validée merci d'informer  le client sur les conditions de la prise en charge de sa demande Par whatsapp ",200);
                }
            }
        }catch (\Exception $exception){
            return response()->json($exception);
        }

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function isNotCorrect(Request $request){

        try{
            $request->validate([
                'request_id'=>'required|exists:requests,id',
                'url_update'=>'required|string',
            ]);
            $request_ = \App\Models\Request::where('request_id',$request->input('request_id'));
            $user = $request_->user;
            Notification::send($user, new RequestIsNotCorrectNotification($request->input('url_update')));
            return response()->json('mail envoyé au client pour completer sa demande');
        }catch (\Exception $exception){
            return response()->json($exception);
        }

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addDepositDate(Request $request){
        try{
            $validated = $request->validate([
                'request_id'=>'required|exists:requests,id',
                'user_id'=>'required|exists:users,id',
                'dateDeposit'=>'required|date',
            ]);
            JobDeposit::create($validated);
            return response()->json('mail envoyé au client pour completer sa demande');
        }catch (\Exception $exception){
            return response()->json($exception);
        }

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function affectationOfFolderDeposit(Request $request){
        try{
            $request->validate([
                'job_deposit_id'=>'required|exists:job_deposits,id',
                'user_id'=>'required|exists:users,id',
            ]);
            $jobDeposit = JobDeposit::find($request->input('job_deposit_id'));
            $jobDeposit->update(['user_id',$request->input('user_id')]);
            return response()->json('Dossier affecté !');
        }catch (\Exception $exception){
            return response()->json($exception);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addDetailRequest(Request $request){
        try{
            $request->validate([
                'job_deposit_id'=>'required|exists:job_deposits,id',
                'duration'=>'required|exists:users,id',
                'numberpath'=>'required|exists:users,id',
            ]);
            $jobDeposit = JobDeposit::findOrFail($request->input('job_deposit_id'));
            $jobDeposit->update([
                'duration'=>$request->input('duration'),
                'numberpath'=>$request->input('numberpath'),
            ]);
            return response()->json('Mise à jour éffectuée!');
        }catch (\Exception $exception){
            return response()->json($exception);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addDepositFile(Request $request){
        try{
            $validated = $request->validate([
                'name'=>'required|string',
                'region_id'=>'required|exists:regions,id',
            ]);
            $depositFile = DepositFile::create($validated);
            return response()->json($depositFile,200);
        }catch (\Exception $exception){
            return response()->json($exception);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addRequestToDepositFile(Request $request){
        try{
            $request->validate([
                'deposit_file_id'=>'required|exists:deposit_files,id',
                'request_id'=>'required|exists:requests,id',
            ]);
            $request_ = \App\Models\Request::where('request_id',$request->input('request_id'));
            $request_->update(['deposit_file_id'=>$request->input('deposit_file_id')]);
            return response()->json('Dossier ajouté à la fiche de dépôt!',200);
        }catch (\Exception $exception){
            return response()->json($exception);
        }
    }
}
