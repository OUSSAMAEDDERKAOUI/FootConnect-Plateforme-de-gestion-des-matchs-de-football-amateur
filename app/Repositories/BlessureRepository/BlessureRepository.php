<?php 

namespace App\Repositories\BlessureRepository;

use App\Models\Blessure;
use App\Repositories\BlessureRepository\BlessureRepositoryInterface;

class BlessureRepository implements BlessureRepositoryInterface
{
    protected $model;

    public function __construct(Blessure $blessure)
    {
        $this->model = $blessure;
    }

    public function all()
    {
        $blessures=Blessure::with(['joueur.user','game'])->get();
        return $blessures;

    }

    public function find($id)
    {
        $blessure=Blessure::with(['joueur.user','joueur.equipe','game'])->findOrFail($id);
        
        // return $this->model->find($id);
        return $blessure;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $blessure = $this->model->find($id);
        
        $blessure->update($data);

        return $blessure;
    }

    public function delete($id)
    {
        $blessure = $this->model->find($id);
        return $blessure->delete();
    }
}
