<?php


namespace App\Repositories\Osc;


use App\Models\Osc\Recurso;
use Illuminate\Database\Eloquent\Model;

interface RecursosOSCRepositoryInterface
{
    public function __construct(Recurso $_recurso);

    public function getRecursosPorOSC($_id_osc);

    public function getAnoRecursosPorOSC($_id_osc);

    public function store(array $data);

    public function update($id, array $data);

    public function delete($id);
}