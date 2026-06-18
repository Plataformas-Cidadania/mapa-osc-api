<?php
namespace App\Repositories\Transferegov;

use App\Models\Transferegov\ProgramaProposta;
use App\Repositories\Transferegov\ProgramaPropostaRepositoryInterface;

class ProgramaPropostaRepositoryEloquent implements ProgramaPropostaRepositoryInterface
{
    private $model;

    public function __construct(ProgramaProposta $_programa)
    {
        $this->model = $_programa;
    }

    public function get($id_programa, $id_proposta)
    {
        return $this->model::where('id_programa', $id_programa)
                                ->where('id_proposta', $id_proposta)
                            ->get();
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id_programa, $id_proposta, array $data)
    {
        return $this->model::where('id_programa', $id_programa)
                                ->where('id_proposta', $id_proposta)
                            ->update($data);
    }

    public function destroy($id)
    {
        return $this->model->find($id)->delete();
    }

    public function updateOrCreate(array $data)
    {
        return $this->model::updateOrCreate(
                    ['id_programa' => $data['id_programa'], 'id_proposta' => $data['id_proposta']],
                    $data
                );
    }
}