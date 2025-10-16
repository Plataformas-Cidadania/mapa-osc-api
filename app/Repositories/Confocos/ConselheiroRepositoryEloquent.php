<?php


namespace App\Repositories\Confocos;

use App\Models\Confocos\Conselheiro;
use App\Repositories\Confocos\ConselheiroRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PHPUnit\Util\Json;
use function MongoDB\BSON\toJSON;
use function Sodium\add;

class ConselheiroRepositoryEloquent implements ConselheiroRepositoryInterface
{
    private $model;

    public function __construct(Conselheiro $_conselheiro)
    {
        $this->model = $_conselheiro;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function update($id, array $data)
    {
        return $this->model->find($id)->update($data);
    }

    public function getPorId($id)
    {
        $conselho = $this->model->find($id);

        return $conselho;
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function destroy($id)
    {
        return $this->model->find($id)->delete();
    }

    public function getListaConselheirosPorConselho($id_conselho)
    {
        $conselheiros = $this->model->where('$id_conselho', $id_conselho);

        return $conselheiros;
    }
}
