<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\RapportService\RapportService;
use App\Http\Requests\RapportRequest\StoreRapportRequest;

class RapportController extends Controller
{
    protected $rapportService;

    public function __construct(RapportService $rapportService)
    {
        $this->rapportService = $rapportService;
    }

    public function index()
    {
        return response()->json($this->rapportService->getAll());
    }

    public function store(StoreRapportRequest $request)
    {
        $data = $request->validated();

        return response()->json($this->rapportService->store($data), 201);
    }

    public function show($id)
    {
        return response()->json($this->rapportService->getById($id));
    }

    public function update(StoreRapportRequest $request, $id)
    {
        $data = $request->validated();

        return response()->json($this->rapportService->update($id, $data));
    }

 
}
