<?php


namespace App\Repositories\Portal;

use App\Models\Osc\Osc;
use Illuminate\Database\Eloquent\Model;

interface BuscaAvancadaRepositoryInterface
{
    public function __construct(Osc $_osc);

    public function buscarOSCs($type_result, $param = null, $busca);
}
