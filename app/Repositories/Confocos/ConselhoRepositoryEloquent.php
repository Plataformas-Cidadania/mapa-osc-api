<?php


namespace App\Repositories\Confocos;

use App\Models\Confocos\Conselho;
use App\Repositories\Confocos\ConselhoRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PHPUnit\Util\Json;
use function MongoDB\BSON\toJSON;
use function Sodium\add;

class ConselhoRepositoryEloquent implements ConselhoRepositoryInterface
{
    private $model;

    public function __construct(Conselho $_conselho)
    {
        $this->model = $_conselho;
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

    public function getNumeroTotalConselhos()
    {
        $total_conselhos_ativos = $this->model->where('bo_conselho_ativo', 1)->count();

        return $total_conselhos_ativos;
    }

    public function getListaConselhosPorNivelFederativo($cd_nivel_federativo, $limit)
    {
        $conselhos = $this->model->where('cd_nivel_federativo', $cd_nivel_federativo)->paginate($limit);

        return $conselhos;
    }

    public function getListaConselhosPorIds(array $ids)
    {
        $conselhos = $this->model->whereIn('id_conselho', $ids);

        return $conselhos;
    }
}
