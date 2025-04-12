<?php
namespace App\Services\DelegueService;

use App\Repositories\DelegueRepository\DelegueRepositoryInterface;

class DelegueService
{
    protected $repository;

    public function __construct(DelegueRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->all();
    }

    public function getById($id)
    {
        return $this->repository->find($id);
    }

    

    public function update($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}
