<?php
namespace App\Repositories\Transferegov;

use App\Models\Transferegov\EmpenhoDesembolso;

class EmpenhoDesembolsoRepositoryEloquent implements EmpenhoDesembolsoRepositoryInterface
{
    private $model;

    public function __construct(EmpenhoDesembolso $_empenho_esembolso)
    {
        $this->model = $_empenho_esembolso;
    }

    public function get($id_desembolso, $id_empenho)
    {
        return $this->model::where('id_desembolso', $id_desembolso)
                            ->where('id_empenho', $id_empenho)->get();
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id_desembolso, $id_empenho, array $data)
    {
        return $this->model::where('id_desembolso', $id_desembolso)
                             ->where('id_empenho', $id_empenho)->update($data);
    }

    public function destroy($id_desembolso, $id_empenho)
    {
        return $this->model->find('id_desembolso', $id_desembolso)
                            ->find('id_empenho', $id_empenho)->delete();
    }

    public function updateOrCreate(array $data)
    {
        return $this->model::updateOrCreate(
                    ['id_desembolso' => $data['id_desembolso'], 'id_empenho' => $data['id_empenho']],
                    $data
                );
    }
}