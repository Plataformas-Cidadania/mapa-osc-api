<?php


namespace App\Repositories\Osc;

use App\Models\Osc\AreaAtuacaoRepresentante;
use Illuminate\Database\Eloquent\Model;

interface AreaAtuacaoRepresentanteRepositoryInterface
{
    public function __construct(AreaAtuacaoRepresentante $_area_atuacao_rep);

    public function get($id);

    public function getAreasAtuacaoRepPorOSC($_id_osc);

    public function store(array $data);

    public function update($id, array $data);

    public function destroy($id);
}