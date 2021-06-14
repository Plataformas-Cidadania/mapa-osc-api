<?php


namespace App\Repositories\Portal;

use App\Models\Portal\BarraTransparencia;
use Illuminate\Database\Eloquent\Model;

class BarratransparenciaRepositoryEloquent implements BarratransparenciaRepositoryInterface
{
    private $model;

    public function __construct(BarraTransparencia $_barra)
    {
        $this->model = $_barra;
    }

    public function getBarraPorOSC($id_osc)
    {
        $regs = $this->model->where('id_osc', $id_osc)->get();
        $teste = $regs[0];
        foreach ($teste as $atribs) {
            dd($teste);
        }
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        // TODO: Implement update() method.
    }

    public function destroy($id)
    {
        return $this->model->find($id)->delete();
    }
}
