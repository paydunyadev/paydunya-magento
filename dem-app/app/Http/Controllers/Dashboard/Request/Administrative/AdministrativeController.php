<?php

namespace App\Http\Controllers\Dashboard\Request\Administrative;

use Illuminate\Http\Request;
use App\Models\Administrative;
use App\Repository\PaymentRepository;
use App\Http\Controllers\Controller;

class AdministrativeController extends Controller
{
    /**
     * @var string[]
     */
    private $data_validation = [
        'firstName' => 'required|string',
        'lastName' => 'required|string',
        'recipient' => 'required|string',
        'libelleDistrick' => 'required|string',
        'numberDistrick' => 'required|string',
        'codePostal' => 'required|string',
        'contry' => 'required|string',
        'address' => 'required|string',
        'tel' => 'required|string',
        'email' => 'required|string',
        'placeExpedition' => 'required|string',
        'numberOfCopie' => 'required|string',
        'reason' => 'required|string',
        'reference' => 'required|string',
        'copieOfFolder' => 'required|file',
        'haveAlreadyGetThisDocPre' => 'required|boolean',
        'haveKeepFolder' => 'required|boolean',
        'region' => 'required|string',
        'commune' => 'required|string',
        'department' => 'required|string',
        'marital_statuse_id' => 'required|exists:marital_statuses,id',
        'type_administrative_id' => 'required|exists:type_administratives,id',
        'user_id' => 'required|exists:users,id',
    ];

    private $paymentRepository;

    /**
     * AdministrativeController constructor.
     * @param PaymentRepository $paymentRepository
     */
    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function store(Request $request){

        try {
            $validated = $request->validate($this->data_validation);
            $request_ = \App\Models\Request::create(['user_id'=>$request->input('user_id')]);
            $validated = Arr::add($validated, 'request_id',$request_->id);
            $administrative = Administrative::create($validated);
            return response()->json([$administrative,$this->paymentRepository->initPayment(2000)],200);

            }catch (\Exception $exception){
            //            return response()->json("une erreur est survenue sur le serveur veuillez contactez le support!");
                return response()->json($exception);
            }


    }

    /**
     * @param Administrative $administrative
     * @return mixed
     */
    public function show(Administrative  $administrative){
        return response()->json($administrative,200);
    }

    /**
     * @param Request $request
     * @param Administrative $administrative
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request,Administrative $administrative){

        try{
            $validated = $request->validated();
            $administrative->update($validated);
            return response()->json($administrative,200);
        }catch (\Exception $exception){
            //            return response()->json("une erreur est survenue sur le serveur veuillez contactez le support!");
            return response()->json($exception);
        }

    }

    /**
     * @param Administrative $administrative
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Administrative $administrative)
    {
        try{
            $administrative->delete();
            return response()->json('La demande a été supprimée !',200);
        }catch (\Exception $exception){
            //            return response()->json("une erreur est survenue sur le serveur veuillez contactez le support!");
            return response()->json($exception);
        }
    }
}
