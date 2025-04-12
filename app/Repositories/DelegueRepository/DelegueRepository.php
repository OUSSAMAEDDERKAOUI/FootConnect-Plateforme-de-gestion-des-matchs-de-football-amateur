<?php
namespace App\Repositories\DelegueRepository;

use App\Models\Delegue;

class DelegueRepository implements DelegueRepositoryInterface
{
    public function all()
    {
        return Delegue::with('User')->get();
    }

    public function find($id)
    {
        return Delegue::findOrFail($id);
    }

    public function create(array $data)
    {
        return Delegue::create($data);
    }

    public function update($id, array $data)
    {
        $Delegue = Delegue::findOrFail($id);
        $Delegue->update($data);
        return $Delegue;
    }

    public function delete($id)
    {
        Delegue::destroy($id);
    }
}
