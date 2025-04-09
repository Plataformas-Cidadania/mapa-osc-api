<?php


namespace App\Repositories\Portal;

use App\Models\Portal\AssinaturaTermo;

class AssinaturaTermoRepositoryEloquent implements AssinaturaTermoRepositoryInterface
{
    private $model;

    public function __construct(AssinaturaTermo $_assinatura_termos)
    {
        $this->model = $_assinatura_termos;
    }

    public function getAll()
    {
        return $this->model->with('termo')->with('representacao')->get();
    }

    public function get($id)
    {
        return $this->model->find($id)->with('termo')->with('representacao');
    }

    public function getAllPorRepresentacao($id_representacao)
    {
        return $this->model
            ->with('representacao')
            ->with('termo')
            ->where('id_representacao', $id_representacao)->get();
    }

    public function getPorRepresentacaoAndTermo($id_representacao, $id_termo)
    {
        return $this->model
            ->with('representacao')
            ->with('termo')
            ->where('id_representacao', $id_representacao)
            ->where('id_termo', $id_termo)
            ->first();
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function destroy($id)
    {
        return $this->model->find($id)->delete();
    }
}
