<?php


namespace App\Repositories\Portal;

use App\Models\Portal\Termo;
use Illuminate\Database\Eloquent\Model;

class TermoRepositoryEloquent implements TermoRepositoryInterface
{
    private $model;

    public function __construct(Termo $termo)
    {
        $this->model = $termo;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function get($id)
    {
        return $this->model->find($id);
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        return $this->model->find($id)->update($data);
    }

    public function destroy($id)
    {
        return $this->model->find($id)->delete();
    }
}
