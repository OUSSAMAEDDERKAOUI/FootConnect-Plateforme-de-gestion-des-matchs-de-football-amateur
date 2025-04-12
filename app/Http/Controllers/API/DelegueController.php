<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\JsonResponse;

use App\Http\Controllers\Controller;
use App\Services\DelegueService\DelegueService;
use App\Http\Requests\DelegueRequest\StoreOrUpdateDelegueRequest;

class DelegueController extends Controller
{
    protected $DelegueService;

    public function __construct(DelegueService $DelegueService)
    {
        $this->DelegueService = $DelegueService;
    }

    public function index(): JsonResponse
    {
        return response()->json($this->DelegueService->getAll());
    }

   

    public function show($id): JsonResponse
    {
        return response()->json($this->DelegueService->getById($id));
    }

    // public function update(StoreOrUpdateDelegueRequest $request, $id): JsonResponse
    // {
    //     $Delegue = $this->DelegueService->update($id, $request->validated());
    //     return response()->json($Delegue);
    // }

    public function destroy($id): JsonResponse
    {
       $Delegue= $this->DelegueService->delete($id);
       
        return response()->json([
            "status"=>"success",
            "message"=>'$Delegue deleted successfully',
            "$Delegue"=>$Delegue
        ],204);
    }
}
