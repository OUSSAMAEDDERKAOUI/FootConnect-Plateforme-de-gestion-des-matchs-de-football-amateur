<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\JsonResponse;

use App\Http\Controllers\Controller;
use App\Services\ButeurService\ButeurService;
use App\Http\Requests\ButeurRequest\StoreOrUpdateButeurRequest;

class ButeurController extends Controller
{
    protected $buteurService;

    public function __construct(ButeurService $buteurService)
    {
        $this->buteurService = $buteurService;
    }

    public function index(): JsonResponse
    {
        return response()->json($this->buteurService->getAll());
    }

    public function store(StoreOrUpdateButeurRequest $request): JsonResponse
    {
        $buteur = $this->buteurService->create($request->validated());
        return response()->json($buteur, 201);
    }

    public function show($id): JsonResponse
    {
        return response()->json($this->buteurService->getById($id));
    }

    public function update(StoreOrUpdateButeurRequest $request, $id): JsonResponse
    {
        $buteur = $this->buteurService->update($id, $request->validated());
        return response()->json($buteur);
    }

    public function destroy($id): JsonResponse
    {
       $buteur= $this->buteurService->delete($id);
       
        return response()->json([
            "status"=>"success",
            "message"=>'$buteur deleted successfully',
            "$buteur"=>$buteur
        ],204);
    }
}
