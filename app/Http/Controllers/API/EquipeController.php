<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;

use App\Http\Requests\EquipeRequest\StoreEquipeRequest;
use App\Services\EquipeService\EquipeService;

class EquipeController extends Controller
{
    protected $equipeService;

    public function __construct(EquipeService $equipeService)
    {
        $this->equipeService = $equipeService;
    }

    public function index()
    {
        $equipes = $this->equipeService->getAllEquipes();
        return response()->json($equipes);
    }

    public function store(StoreEquipeRequest $request)
    {
        $data = $request->validated();
        $equipe = $this->equipeService->createEquipe($data);
        return response()->json($equipe, 201);
    }

    public function show($id)
    {
        $equipe = $this->equipeService->getEquipeById($id);
        if (!$equipe) {
            return response()->json(['message' => 'equipes not found'], 404);
        }
        return response()->json($equipe);
    }

    public function update(StoreEquipeRequest $request, $id)
    {
        $data = $request->validated();
        $equipe = $this->equipeService->updateEquipe($id, $data);
        return response()->json($equipe);
    }

    public function destroy($id)
    {
        $this->equipeService->deleteEquipe($id);
        return response()->json(['message' => 'Equipe deleted successfully']);
    }
}

