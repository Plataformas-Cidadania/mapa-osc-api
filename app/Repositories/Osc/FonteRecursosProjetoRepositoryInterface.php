<?php


namespace App\Repositories\Osc;


use App\Models\Osc\FonteRecursosProjeto;
use Illuminate\Database\Eloquent\Model;

interface FonteRecursosProjetoRepositoryInterface
{
    public function __construct(FonteRecursosProjeto $_fonte);

    public function get($id);

    public function getFonteRecursosPorProjeto($_id_projeto);

    public function store(array $data);

    public function update($id, array $data);

    public function destroy($id);
}