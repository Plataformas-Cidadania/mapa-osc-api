<?php


namespace App\Repositories\Osc;


use App\Models\Osc\FinanciadorProjeto;
use Illuminate\Database\Eloquent\Model;

interface FinanciadorProjetoRepositoryInterface
{
    public function __construct(FinanciadorProjeto $financiadorProjeto);

    public function get($id);

    public function getFinanciadoresPorProjeto($id_projeto);

    public function store(array $data);

    public function update($id, array $data);

    public function destroy($id);
}