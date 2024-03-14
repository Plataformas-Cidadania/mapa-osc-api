<?php


namespace App\Repositories\Portal;

use App\Models\Portal\BarraTransparencia;
use Illuminate\Database\Eloquent\Model;

interface BarratransparenciaRepositoryInterface
{
    public function __construct(BarraTransparencia $_barra);

    public function getBarraPorOSC($id_osc);

    public function getBarraPorOscComCalculo($id_osc);

    public function store(array $data);

    public function update($id, array $data);

    public function destroy($id);
}
