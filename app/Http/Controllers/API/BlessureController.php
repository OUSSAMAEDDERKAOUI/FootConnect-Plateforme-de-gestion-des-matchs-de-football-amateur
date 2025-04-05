<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;

use App\Services\BlessureService\BlessureService;
use App\Http\Requests\BlessureRequest\StoreBlessureRequest;

class BlessureController extends Controller
{
    protected $blessureService;

    public function __construct(BlessureService $blessureService)
    {
        $this->blessureService = $blessureService;
    }

    public function index()
    {
        $blessures = $this->blessureService->getAllBlessures();
        return response()->json($blessures);
    }

    public function store(StoreBlessureRequest $request)
    {
        $data = $request->validated();
        $blessure = $this->blessureService->createBlessure($data);
        return response()->json($blessure, 201);
    }

    public function show($id)
    {
        $blessure = $this->blessureService->getBlessureById($id);
        if (!$blessure) {
            return response()->json(['message' => 'Blessure not found'], 404);
        }
        return response()->json($blessure);
    }

    public function update(StoreBlessureRequest $request, $id)
    {
        $data = $request->validated();
        $blessure = $this->blessureService->updateBlessure($id, $data);
        return response()->json($blessure);
    }

    public function destroy($id)
    {
        $this->blessureService->deleteBlessure($id);
        return response()->json(['message' => 'Blessure deleted successfully'], 204);
    }
}

