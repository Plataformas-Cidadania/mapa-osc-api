<?php


namespace App\Repositories\Osc;


use App\Models\Osc\TipoParceriaProjeto;
use Illuminate\Database\Eloquent\Model;

interface TipoParceriaProjetoRepositoryInterface
{
    public function __construct(TipoParceriaProjeto $_parceria);

    public function get($id);

    public function getTipoParceriasPorProjeto($_id_projeto);

    public function store(array $data);

    public function update($id, array $data);

    public function destroy($id);
}