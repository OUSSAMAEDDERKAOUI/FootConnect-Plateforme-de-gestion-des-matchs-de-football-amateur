<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\JsonResponse;

use App\Http\Controllers\Controller;
use App\Services\ArbitreService\ArbitreService;
use App\Http\Requests\ArbitreRequest\StoreOrUpdateArbitreRequest;

class ArbitreController extends Controller
{
    protected $ArbitreService;

    public function __construct(ArbitreService $ArbitreService)
    {
        $this->ArbitreService = $ArbitreService;
    }

    public function index(): JsonResponse
    {
        return response()->json($this->ArbitreService->getAll());
    }

   

    public function show($id): JsonResponse
    {
        return response()->json($this->ArbitreService->getById($id));
    }

    // public function update(StoreOrUpdateArbitreRequest $request, $id): JsonResponse
    // {
    //     $Arbitre = $this->ArbitreService->update($id, $request->validated());
    //     return response()->json($Arbitre);
    // }

    public function destroy($id): JsonResponse
    {
       $Arbitre= $this->ArbitreService->delete($id);
       
        return response()->json([
            "status"=>"success",
            "message"=>'$Arbitre deleted successfully',
            "$Arbitre"=>$Arbitre
        ],204);
    }
}
