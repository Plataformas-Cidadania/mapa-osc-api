<?php
namespace App\Repositories\Transferegov;

use App\Models\Transferegov\Proponente;

class ProponenteRepositoryEloquent implements ProponenteRepositoryInterface
{
    private $model;

    public function __construct(Proponente $_proponente)
    {
        $this->model = $_proponente;
    }

    public function get($id_proponente, $identif_proponente)
    {
        return $this->model::where('id_proponente', $id_proponente)
                            ->where('identif_proponente', $identif_proponente)->get();
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id_proponente, $identif_proponente, array $data)
    {
        return $this->model::where('id_proponente', $id_proponente)
                             ->where('identif_proponente', $identif_proponente)->update($data);
    }

    public function destroy($id_proponente, $identif_proponente)
    {
        return $this->model->find('id_proponente', $id_proponente)
                            ->find('identif_proponente', $identif_proponente)->delete();
    }

    public function updateOrCreate(array $data)
    {
        return $this->model::updateOrCreate(
                    ['id_proponente' => $data['id_proponente'], 'identif_proponente' => $data['identif_proponente']],
                    $data
                );
    }
}