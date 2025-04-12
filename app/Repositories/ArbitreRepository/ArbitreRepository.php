<?php
namespace App\Repositories\ArbitreRepository;

use App\Models\Arbitre;

class ArbitreRepository implements ArbitreRepositoryInterface
{
    public function all()
    {
        return Arbitre::with('User')->get();
    }

    public function find($id)
    {
        return Arbitre::findOrFail($id);
    }

    public function create(array $data)
    {
        return Arbitre::create($data);
    }

    public function update($id, array $data)
    {
        $Arbitre = Arbitre::findOrFail($id);
        $Arbitre->update($data);
        return $Arbitre;
    }

    public function delete($id)
    {
        Arbitre::destroy($id);
    }
}
