<?php


namespace App\Repositories\Portal;

use App\Models\Portal\RepresentacaoConselho;
use Illuminate\Database\Eloquent\Model;

use App\Util\FormatacaoUtil;

class RepresentacaoConselhoRepositoryEloquent implements RepresentacaoConselhoRepositoryInterface
{
    private $model;

    public function __construct(RepresentacaoConselho $_representacao)
    {
        $this->model = $_representacao;
    }

    public function getAll()
    {
        return $this->model->with('osc')->with('usuario')->get();//->whereIn('id_representacao', [1, 250, 251]);//->orderBy('id_representacao', 'asc');
    }

    public function get($id)
    {
        return $this->model->with('usuario')->with('osc')->where('id_representacao', $id)->get();
    }

    public function getRepresetacaoPorConselhoAndUsuario($id_conselho, $id_usuario)
    {
        return $this->model->with('usuario')
            ->with('conselho')
            ->where('id_conselho', $id_conselho)
            ->where('id_usuario', $id_usuario)
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
