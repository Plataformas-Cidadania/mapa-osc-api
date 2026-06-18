<?php
namespace App\Repositories\Transferegov;

use App\Models\Transferegov\Pagamento;

class PagamentoRepositoryEloquent implements PagamentoRepositoryInterface
{
    private $model;

    public function __construct(Pagamento $_pagamento)
    {
        $this->model = $_pagamento;
    }

    public function get($nr_mov_fin, $nr_convenio)
    {
        return $this->model::where('nr_mov_fin', $nr_mov_fin)
                            ->where('nr_convenio', $nr_convenio)->get();
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function update($nr_mov_fin, $nr_convenio, array $data)
    {
        return $this->model::where('nr_mov_fin', $nr_mov_fin)
                            ->where('nr_convenio', $nr_convenio)->update($data);
    }

    public function destroy($nr_mov_fin, $nr_convenio)
    {
        return $this->model->find('nr_mov_fin', $nr_mov_fin)
                            ->find('nr_convenio', $nr_convenio)->delete();
    }

    public function updateOrCreate(array $data)
    {
        return $this->model::updateOrCreate(
                    ['nr_mov_fin' => $data['nr_mov_fin'], 'nr_convenio' => $data['nr_convenio']],
                    $data
                );
    }
}