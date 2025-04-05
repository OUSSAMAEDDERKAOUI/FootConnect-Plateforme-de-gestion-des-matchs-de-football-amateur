<?php 
namespace App\Services\RapportService;

use App\Repositories\RapportRepository\RapportRepository;

class RapportService
{
    protected $rapportRepo;

    public function __construct(RapportRepository $rapportRepo)
    {
        $this->rapportRepo = $rapportRepo;
    }

    public function getAll()
    {
        return $this->rapportRepo->getAll();
    }

    public function getById($id)
    {
        return $this->rapportRepo->findById($id);
    }

    public function store(array $data)
    {
        return $this->rapportRepo->create($data);
    }

    public function update($id, array $data)
    {
        return $this->rapportRepo->update($id, $data);
    }

    public function destroy($id)
    {
        return $this->rapportRepo->delete($id);
    }
}
