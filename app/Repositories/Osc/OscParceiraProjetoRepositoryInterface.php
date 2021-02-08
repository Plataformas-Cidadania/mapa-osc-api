<?php


namespace App\Repositories\Osc;


use App\Models\Osc\OscParceiraProjeto;
use Illuminate\Database\Eloquent\Model;

interface OscParceiraProjetoRepositoryInterface
{
    public function __construct(OscParceiraProjeto $_parceria);

    public function get($id);

    public function getParceriasPorProjeto($_id_projeto);

    public function store(array $data);

    public function update($id, array $data);

    public function destroy($id);
}