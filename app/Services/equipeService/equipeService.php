<?php 

namespace App\Services\EquipeService;

use App\Repositories\EquipeRepository\EquipeRepositoryInterface;

class EquipeService
{
    protected $EquipeRepository;

    public function __construct(EquipeRepositoryInterface $EquipeRepository)
    {
        $this->EquipeRepository = $EquipeRepository;
    }

    public function getAllEquipes()
    {
        return $this->EquipeRepository->all();
    }

    public function getEquipeById($id)
    {
        return $this->EquipeRepository->find($id);
    }

    public function createEquipe($data)
    {
        return $this->EquipeRepository->create($data);
    }

    public function updateEquipe($id, $data)
    {
        return $this->EquipeRepository->update($id, $data);
    }

    public function deleteEquipe($id)
    {
        return $this->EquipeRepository->delete($id);
    }
}
