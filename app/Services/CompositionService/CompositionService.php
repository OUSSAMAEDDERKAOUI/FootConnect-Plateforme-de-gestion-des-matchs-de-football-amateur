<?php
namespace App\Services\CompositionService;

use App\Repositories\CompositionRepository\CompositionRepositoryInterface;

class CompositionService
{
    protected $repository;

    public function __construct(CompositionRepositoryInterface $repository)
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

    public function create(array $data)
    {
        return $this->repository->create($data);
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
