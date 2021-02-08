<?php


namespace App\Repositories\Osc;


use App\Models\Osc\ObjetivoProjeto;
use Illuminate\Database\Eloquent\Model;

interface ObjetivoProjetoRepositoryInterface
{
    public function __construct(ObjetivoProjeto $_objetivo);

    public function get($id);

    public function getObjetivosPorProjeto($_id_projeto);

    public function store(array $data);

    public function update($id, array $data);

    public function destroy($id);
}