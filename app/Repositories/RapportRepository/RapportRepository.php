<?php 
namespace App\Repositories\RapportRepository;

use App\Models\Rapport;
use App\Repositories\RapportRepository\RapportRepositoryInterface;

class RapportRepository implements RapportRepositoryInterface
{
    public function getAll()
    {
        return Rapport::all();
    }

    public function findById($id)
    {
        return Rapport::findOrFail($id);
    }

    public function create(array $data)
    {
        return Rapport::create($data);
    }

    public function update($id, array $data)
    {
        $rapport = Rapport::findOrFail($id);
        $rapport->update($data);
        return $rapport;
    }

    public function delete($id)
    {
        $rapport = Rapport::findOrFail($id);
        return $rapport->delete();
    }
}
