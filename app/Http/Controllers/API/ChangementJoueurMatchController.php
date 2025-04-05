<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;


use App\Http\Controllers\Controller;
use App\Models\ChangementJoueurMatch;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Http\Requests\ChangementJoueurMatch\storeChangementJoueurMatch;
use App\Services\ChangementJoueurMatchService\ChangementJoueurMatchService;

class ChangementJoueurMatchController extends Controller
{
    protected $service;

    public function __construct(ChangementJoueurMatchService $service)
    {
        $this->service = $service;
    }

    public function index(): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => 'Liste des changements récupérée avec succès.',
            'data' => $this->service->getAll()
        ]);
    }

    public function show($id): JsonResponse
    {
        $instance = $this->service->getById($id);

        return response()->json([
            'status' => true,
            'message' => 'Détails du changement récupérés.',
            'data' => $instance
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $created = $this->service->create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Changement créé avec succès.',
            'data' => $created
        ], 201);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $updated = $this->service->update($id, $request->all());

        return response()->json([
            'status' => true,
            'message' => 'Changement mis à jour avec succès.',
            'data' => $updated
        ]);
    }

    public function destroy($id): JsonResponse
    {
        $this->service->delete($id);

        return response()->json([
            'status' => true,
            'message' => 'Changement supprimé avec succès.',
        ]);
    }
}