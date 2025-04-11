<?php 

namespace App\Repositories\EquipeRepository;

use App\Models\Equipe;
use App\Repositories\EquipeRepository\EquipeRepositoryInterface;

class EquipeRepository implements EquipeRepositoryInterface
{
    protected $model;

    public function __construct(Equipe $Equipe)
    {
        $this->model = $Equipe;
    }

    public function all()
    {
        return $this->model->all() ;
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        if (isset($data['logo'])) {
            $data['logo'] = $data['logo']->store('logo_equipes', 'public');
        }
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $Equipe = $this->model->find($id);
        
        $Equipe->update($data);

        return $Equipe;
    }

    public function delete($id)
    {
        $Equipe = $this->model->find($id);
        return $Equipe->delete();
    }
}
