<?php
namespace App\Repositories\Transferegov;

use App\Models\Transferegov\Programa;
use App\Repositories\Transferegov\ProgramaRepositoryInterface;

class ProgramaRepositoryEloquent implements ProgramaRepositoryInterface
{
    private $model;

    public function __construct(Programa $_programa)
    {
        $this->model = $_programa;
    }

    public function get($id_programa, $modalidade_programa, $natureza_juridica_programa, $uf_programa)
    {
        //var_dump($id_programa, $modalidade_programa, $natureza_juridica_programa, $uf_programa);die;
        return $this->model::where('id_programa', $id_programa)
                                ->where('modalidade_programa', $modalidade_programa)
                                ->where('natureza_juridica_programa', $natureza_juridica_programa)
                                ->where('uf_programa', $uf_programa)
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

    public function update($id_programa, $modalidade_programa, $natureza_juridica_programa, $uf_programa, array $data)
    {
        return $this->model::where('id_programa', $id_programa)
                                ->where('modalidade_programa', $modalidade_programa)
                                ->where('natureza_juridica_programa', $natureza_juridica_programa)
                                ->where('uf_programa', $uf_programa)
                            ->update($data);
    }

    public function destroy($id)
    {
        return $this->model->find($id)->delete();
    }

    public function updateOrCreate(array $data)
    {
        return $this->model::updateOrCreate(
                    ['id_programa' => $data['id_programa'], 'modalidade_programa' => $data['modalidade_programa'], 'natureza_juridica_programa' => $data['natureza_juridica_programa'], 'uf_programa' => $data['uf_programa']],
                    $data
                );
    }
}