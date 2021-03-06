<?php


namespace App\Repositories\Osc;

use App\Models\Osc\LocalizacaoProjeto;
use App\Repositories\Osc\LocalizacaoProjetoRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class LocalizacaoProjetoRepositoryEloquent implements LocalizacaoProjetoRepositoryInterface
{
    private $model;

    public function __construct(LocalizacaoProjeto $localizacaoProjeto)
    {
        $this->model = $localizacaoProjeto;
    }

    public function get($id)
    {
        $_parceria = $this->model->find($id);

        return $_parceria;
    }

    public function getLocalizacoesPorProjeto($id_projeto)
    {
        $_parcerias = $this->model->where('id_projeto', $id_projeto)->get();

        return $_parcerias;
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