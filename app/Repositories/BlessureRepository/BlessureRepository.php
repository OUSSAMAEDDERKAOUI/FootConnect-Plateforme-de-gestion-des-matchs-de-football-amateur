<?php 

namespace App\Repositories\BlessureRepository;

use App\Models\Blessure;
use App\Models\Joueur;
use App\Repositories\BlessureRepository\BlessureRepositoryInterface;
use Spatie\LaravelIgnition\Recorders\DumpRecorder\Dump;

class BlessureRepository implements BlessureRepositoryInterface
{
    protected $model;

    public function __construct(Blessure $blessure)
    {
        $this->model = $blessure;
    }

    public function all()
    {
        $blessures=Blessure::with(['joueur.user','game.equipeDomicile','game.equipeExterieur'])
        ->orderBy('date_blessure','desc')
        ->get();
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
        $blessure =$this->model->create($data);
        $joueur_id=$blessure->joueur_id;
        $joueur=Joueur::findOrFail($joueur_id);
        $joueur->update([
            'statut'=>'blesse',
        ]);
        return $blessure;
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
