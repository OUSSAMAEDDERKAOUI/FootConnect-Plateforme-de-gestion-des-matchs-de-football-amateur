<?php
namespace App\Repositories\ButeurRepository;

use App\Models\Buteur;

class ButeurRepository implements ButeurRepositoryInterface
{
    public function all()
    {
        return Buteur::all();
    }

    public function find($id)
    {
        return Buteur::findOrFail($id);
    }

    public function create(array $data)
    {
        return Buteur::create($data);
    }

    public function update($id, array $data)
    {
        $buteur = Buteur::findOrFail($id);
        $buteur->update($data);
        return $buteur;
    }

    public function delete($id)
    {
        Buteur::destroy($id);
    }
}
