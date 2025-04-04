<?php 
namespace App\Repositories\CompositionRepository;

use App\Models\Composition;

class CompositionRepository implements CompositionRepositoryInterface
{
    public function all()
    {
        return Composition::all();
    }

    public function find($id)
    {
        return Composition::findOrFail($id);
    }

    public function create(array $data)
    {
        return Composition::create($data);
    }

    public function update($id, array $data)
    {
        $composition = Composition::findOrFail($id);
        $composition->update($data);
        return $composition;
    }

    public function delete($id)
    {
        Composition::destroy($id);
    }
}
