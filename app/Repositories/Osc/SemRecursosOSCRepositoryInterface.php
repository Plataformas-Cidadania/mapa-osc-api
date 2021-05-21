<?php


namespace App\Repositories\Osc;


use App\Models\Osc\SemRecurso;
use Illuminate\Database\Eloquent\Model;

interface SemRecursosOSCRepositoryInterface
{
    public function __construct(SemRecurso $_recurso);

    public function getAnosSemRecursosPorOSC($_id_osc, $ano);

    public function store(array $data);

    public function delete($id, array $oscAnoOrigem);
}