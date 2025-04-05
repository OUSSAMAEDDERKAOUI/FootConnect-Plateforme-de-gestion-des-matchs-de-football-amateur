<?php 
namespace App\Repositories\ChangementRepository;

use App\Models\ChangementJoueurMatch;
use App\Models\Game;
use App\Models\Joueur;
use App\Models\Equipe;

class ChangementRepository implements ChangementRepositoryInterface{
    
        public function all()
        {
            return ChangementJoueurMatch::all();
        }
    
        public function find($id)
        {
            return ChangementJoueurMatch::findOrFail($id);
        }
    
        public function create(array $data)
        {
            return ChangementJoueurMatch::create($data);
        }
    
        public function update($id, array $data)
        {
            $record = $this->find($id);
            $record->update($data);
            return $record;
        }
    
        public function delete($id)
        {
            return ChangementJoueurMatch::destroy($id);
        }
    }