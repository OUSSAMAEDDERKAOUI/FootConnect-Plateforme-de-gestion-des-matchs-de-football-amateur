<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrUpdateCompositionRequest;
use App\Services\CompositionService\CompositionService;

class CompositionController extends Controller
{
    

    protected $compositionService;

    public function __construct(CompositionService $compositionService)
    {
        $this->compositionService = $compositionService;
    }

    public function index(): JsonResponse
    {
        return response()->json($this->compositionService->getAll());
    }

    public function store(StoreOrUpdateCompositionRequest $request): JsonResponse
    {
        $composition = $this->compositionService->create($request->validated());
        return response()->json($composition, 201);
    }

    public function show($id): JsonResponse
    {
        return response()->json($this->compositionService->getById($id));
    }

    public function update(StoreOrUpdateCompositionRequest $request, $id): JsonResponse
    {
        $composition = $this->compositionService->update($id, $request->validated());
        return response()->json($composition);
    }

    public function destroy($id): JsonResponse
    {
        $this->compositionService->delete($id);
        return response()->json(null, 204);
    }
}
