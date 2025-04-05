<?php 

namespace App\Services\BlessureService;

use App\Repositories\BlessureRepository\BlessureRepositoryInterface;

class BlessureService
{
    protected $blessureRepository;

    public function __construct(BlessureRepositoryInterface $blessureRepository)
    {
        $this->blessureRepository = $blessureRepository;
    }

    public function getAllBlessures()
    {
        return $this->blessureRepository->all();
    }

    public function getBlessureById($id)
    {
        return $this->blessureRepository->find($id);
    }

    public function createBlessure($data)
    {
        return $this->blessureRepository->create($data);
    }

    public function updateBlessure($id, $data)
    {
        return $this->blessureRepository->update($id, $data);
    }

    public function deleteBlessure($id)
    {
        return $this->blessureRepository->delete($id);
    }
}
